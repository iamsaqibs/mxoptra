#!/usr/bin/env python3

import os
import re
import json
from datetime import datetime
from typing import Dict, List, Optional, Set, Tuple

class SchemaParser:
    def __init__(self):
        self.models: Dict[str, dict] = {}
        self.current_model: Optional[str] = None
        self.current_model_desc: Optional[str] = None
        self.current_prop_name: Optional[str] = None
        self.current_prop_type: Optional[str] = None
        self.current_prop_desc: Optional[str] = None
        self.current_prop_constraints: List[str] = []
        self.in_properties = False
        self.seen_models: Set[str] = set()
        self.json_buffer = []
        self.in_json = False

    def clean_json_example(self, text: str) -> str:
        """Clean and format a JSON example string."""
        # Remove any trailing commas before closing brackets
        text = re.sub(r',(\s*[}\]])', r'\1', text)
        # Try to parse and re-format as JSON
        try:
            data = json.loads(text)
            return json.dumps(data, indent=2)
        except json.JSONDecodeError:
            return text

    def parse_property_line(self, line: str) -> Optional[Tuple[str, str, str]]:
        """Parse a property line into name, type, and rest."""
        # Skip certain lines
        if any(line.startswith(x) for x in ('Example:', 'Match', 'Allowed', 'Default', '>=', '<=', 'Multiple')):
            return None

        # Try to match property definition patterns
        patterns = [
            # Standard property definition: name type [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+([a-zA-Z][a-zA-Z0-9_]*(?:\[\])?|<[^>]+>)(?:\s+(.*))?$',
            # Property with complex type: name string<format> [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+([a-zA-Z][a-zA-Z0-9_]*<[^>]+>)(?:\s+(.*))?$',
            # Property with array type: name array[type] [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+array\[([^\]]+)\](?:\s+(.*))?$',
            # Property with object type: name object [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+object(?:\s+(.*))?$',
            # Property with number type and format: name number<format> [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+number<([^>]+)>(?:\s+(.*))?$',
            # Property with string type and format: name string<format> [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+string<([^>]+)>(?:\s+(.*))?$',
            # Property with boolean type: name boolean [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+boolean(?:\s+(.*))?$',
            # Property with integer type: name integer [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+integer(?:\s+(.*))?$',
            # Property with number type: name number [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+number(?:\s+(.*))?$',
            # Property with string type: name string [description]
            r'^([a-zA-Z][a-zA-Z0-9_]*)\s+string(?:\s+(.*))?$'
        ]

        for pattern in patterns:
            match = re.match(pattern, line)
            if match:
                name = match.group(1)
                type_info = match.group(2) if len(match.groups()) > 1 else 'object'
                rest = match.group(3) if len(match.groups()) > 2 and match.group(3) else ''

                # Skip if this looks like a special line
                if name in ('Request', 'Response', 'Parameters'):
                    return None

                # Clean up type info
                if type_info == 'array[':
                    type_info = 'array'
                elif '<' in type_info:
                    base_type, format_type = type_info.split('<', 1)
                    format_type = format_type.rstrip('>')
                    type_info = f'{base_type} ({format_type})'

                return name, type_info, rest

        return None

    def parse_line(self, line: str, next_line: Optional[str] = None) -> None:
        line = line.strip()
        if not line:
            return

        # Check for model name and description
        if re.match(r'^[A-Z][A-Za-z]+$', line) and not line.startswith(('Example:', 'Allowed', 'Default', 'Multiple')):
            if next_line and (next_line.strip().startswith('{') or re.match(r'^[A-Z][a-z]', next_line.strip())):
                if line not in self.seen_models:
                    self.seen_models.add(line)
                    self.current_model = line
                    self.current_model_desc = next_line.strip() if not next_line.strip().startswith('{') else None
                    self.in_properties = False
                    if self.current_model not in self.models:
                        self.models[self.current_model] = {
                            'description': self.current_model_desc,
                            'properties': {}
                        }

        # Check for JSON start
        elif line == '{':
            self.in_properties = True
            self.current_prop_name = None
            self.current_prop_type = None
            self.current_prop_desc = None
            self.current_prop_constraints = []
            self.json_buffer = []
            self.in_json = False

        # Process properties
        elif self.in_properties and line != '}':
            # Check if this is a property line
            parsed = self.parse_property_line(line)
            if parsed:
                # If we were collecting JSON, process it
                if self.json_buffer and self.current_prop_name:
                    json_example = self.clean_json_example('\n'.join(self.json_buffer))
                    if self.current_model and self.current_prop_name:
                        prop = self.models[self.current_model]['properties'].get(self.current_prop_name)
                        if prop:
                            prop['constraints'].append(f'Example:\n```json\n{json_example}\n```')
                    self.json_buffer = []
                    self.in_json = False

                name, type_info, rest = parsed

                # Process the property
                self.current_prop_name = name
                self.current_prop_type = type_info
                self.current_prop_desc = rest
                self.current_prop_constraints = []

                # Check for required flag
                if 'required' in rest.lower():
                    self.current_prop_constraints.append('Required')

                # Check for read-only flag
                if 'read-only' in rest.lower():
                    self.current_prop_constraints.append('Read-only')

                # Add the property to the model
                if self.current_model and self.current_prop_name:
                    self.models[self.current_model]['properties'][self.current_prop_name] = {
                        'type': self.current_prop_type,
                        'description': self.current_prop_desc,
                        'constraints': self.current_prop_constraints.copy()
                    }

            # Process additional property information
            elif self.current_prop_name and self.current_model:
                prop = self.models[self.current_model]['properties'].get(self.current_prop_name)
                if prop:
                    if line.startswith('Example:'):
                        self.in_json = True
                        self.json_buffer = []
                    elif line.startswith('Match'):
                        prop['constraints'].append(f'Pattern: {line[line.find("pattern:") + 8:].strip()}')
                    elif line.startswith('Allowed'):
                        prop['constraints'].append(f'Allowed values: {line[line.find("values:") + 7:].strip()}')
                    elif line.startswith('Default:'):
                        prop['constraints'].append(f'Default: {line[8:].strip()}')
                    elif line.startswith('>='):
                        prop['constraints'].append(f'Min: {line[2:].strip()}')
                    elif line.startswith('<='):
                        prop['constraints'].append(f'Max: {line[2:].strip()}')
                    elif line.startswith('Multiple'):
                        prop['constraints'].append(f'Multiple of: {line[line.find("of:") + 3:].strip()}')
                    elif self.in_json:
                        self.json_buffer.append(line)
                    elif not any(line.startswith(x) for x in ('Example:', 'Match', 'Allowed', 'Default', '>=', '<=', 'Multiple')):
                        # This is likely a description
                        if prop['description']:
                            prop['description'] += ' '
                        prop['description'] += line

    def generate_markdown(self) -> str:
        output = [
            '# Maxoptra API Models Documentation\n',
            f'Generated on: {datetime.now()}\n',
            'This documentation describes the data models used in the Maxoptra API.\n',
            '## Table of Contents\n'
        ]

        # Add table of contents
        for model in sorted(self.models.keys()):
            if model.startswith(('Example:', 'Allowed', 'Default', 'Multiple')):
                continue
            anchor = model.lower().replace(' ', '-')
            output.append(f'- [{model}](#{anchor})\n')

        output.append('\n---\n')

        # Add model documentation
        for model in sorted(self.models.keys()):
            if model.startswith(('Example:', 'Allowed', 'Default', 'Multiple')):
                continue
            data = self.models[model]
            anchor = model.lower().replace(' ', '-')
            output.extend([
                f'\n<a name="{anchor}"></a>',
                f'## {model}\n'
            ])

            if data['description']:
                output.append(f'{data["description"]}\n')

            if data['properties']:
                output.extend([
                    '### Schema\n',
                    '| Property | Type | Description | Constraints |',
                    '|----------|------|-------------|-------------|'
                ])

                for prop_name, prop_data in sorted(data['properties'].items()):
                    constraints = '\n'.join(prop_data['constraints']) if prop_data['constraints'] else 'None'
                    output.append(
                        f'| `{prop_name}` | `{prop_data["type"]}` | {prop_data["description"] or ""} | {constraints} |'
                    )

                output.append('\n')

        return '\n'.join(output)

def main():
    parser = SchemaParser()

    # Create output directory
    os.makedirs('api_docs', exist_ok=True)

    # Read and parse the schemas file
    with open('schemas.txt', 'r') as f:
        lines = f.readlines()
        for i, line in enumerate(lines):
            next_line = lines[i + 1] if i + 1 < len(lines) else None
            parser.parse_line(line, next_line)

    # Generate and write the documentation
    markdown = parser.generate_markdown()
    with open('api_docs/models_documentation.md', 'w') as f:
        f.write(markdown)

    print("Schema documentation has been generated in api_docs/models_documentation.md")

if __name__ == '__main__':
    main()
