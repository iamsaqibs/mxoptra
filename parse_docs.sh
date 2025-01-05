#!/bin/bash

# Create output directory
mkdir -p api_docs

# Start documentation file
cat > api_docs/api_documentation.md << EOL
# Maxoptra API Documentation

Generated on: $(date)

This documentation describes the Maxoptra API endpoints for managing locations, drivers, orders, and other resources.

## Table of Contents

EOL

# Initialize variables
current_section=""
in_parameters=false
in_request=false
in_response=false
in_body=false
in_json=false
json_content=""
json_indent=0
current_param_desc=""
param_desc_indent=0
response_desc=""
last_response_code=""
sections=()
current_param_name=""
current_param_type=""
current_param_constraints=""

# First pass: collect section names for table of contents
while IFS= read -r line; do
    if [[ "$line" =~ ^(Get|Create|Update|Delete|Partially).* ]] && ! [[ "$line" =~ ^Example ]]; then
        sections+=("$line")
    fi
done < docs.txt

# Add table of contents
for section in "${sections[@]}"; do
    # Convert section name to anchor link
    anchor=$(echo "$section" | tr '[:upper:]' '[:lower:]' | sed 's/ /-/g')
    echo "- [$section](#${anchor})" >> api_docs/api_documentation.md
done

echo -e "\n---\n" >> api_docs/api_documentation.md

# Second pass: process content
while IFS= read -r line; do
    # Skip empty lines at the start of sections
    if [[ -z "$line" ]] && [[ -z "$current_section" ]]; then
        continue
    fi

    # Check for JSON start
    if [[ "$line" == "{" ]]; then
        in_json=true
        json_content="{\n"
        json_indent=2
        continue
    fi

    # Process JSON content
    if [[ "$in_json" == true ]]; then
        # Check for JSON end
        if [[ "$line" == "}" ]]; then
            in_json=false
            json_content+="}"
            echo -e "\n\`\`\`json${json_content}\n\`\`\`\n" >> api_docs/api_documentation.md
            json_content=""
            json_indent=0
            continue
        fi
        # Add line to JSON content with proper indentation
        if [[ -n "$line" ]]; then
            json_content+="$(printf '%*s' $json_indent '')$line\n"
        fi
        continue
    fi

    # Check for main endpoint sections
    if [[ "$line" =~ ^(Get|Create|Update|Delete|Partially).* ]] && ! [[ "$line" =~ ^Example ]]; then
        current_section="$line"
        # Convert section name to anchor link
        anchor=$(echo "$line" | tr '[:upper:]' '[:lower:]' | sed 's/ /-/g')
        echo -e "\n<a name=\"${anchor}\"></a>\n## $line" >> api_docs/api_documentation.md
        continue
    fi

    # Check for HTTP method
    if [[ "$line" =~ ^(GET|POST|PUT|PATCH|DELETE)$ ]]; then
        echo -e "\n### Method\n\`$line\`" >> api_docs/api_documentation.md
        continue
    fi

    # Check for URL
    if [[ "$line" =~ ^https:// ]]; then
        echo -e "\n### URL\n\`$line\`" >> api_docs/api_documentation.md
        continue
    fi

    # Check for description (lines that start with capital letter but aren't section headers)
    if [[ "$line" =~ ^[A-Z][a-z].* ]] && ! [[ "$line" =~ ^(Request|Response|Body|Query|Path|Parameters|Example|Token|Send|Live|Server|Match|Default|The|When) ]]; then
        if [[ "$line" =~ required$ ]]; then
            # This is a parameter requirement, add to constraints
            current_param_constraints+=" (Required)"
            continue
        fi
        if [[ "$line" =~ ^Example: ]]; then
            # This is an example, add to current parameter description
            if [[ -n "$current_param_desc" ]]; then
                current_param_desc+=" (${line})"
            fi
        else
            # Skip duplicate descriptions
            if ! grep -q "^### Description\n$line$" api_docs/api_documentation.md; then
                echo -e "\n### Description\n$line" >> api_docs/api_documentation.md
            fi
        fi
        continue
    fi

    # Handle parameters section
    if [[ "$line" == "Query Parameters" ]] || [[ "$line" == "Path Parameters" ]]; then
        echo -e "\n### ${line}" >> api_docs/api_documentation.md
        in_parameters=true
        parameter_count=0
        continue
    fi

    # Process parameters
    if [[ "$in_parameters" == true ]] && [[ "$line" =~ ^[a-zA-Z] ]]; then
        # Split the line into parts
        read -r name type rest <<< "$line"

        # Skip if this is a section header
        if [[ "$type" == "Parameters" ]] || [[ "$name" == "Request" ]] || [[ "$name" == "Response" ]]; then
            continue
        fi

        # If this is a new parameter
        if [[ -n "$name" ]] && [[ -n "$type" ]]; then
            # If we have a previous parameter to write out
            if [[ -n "$current_param_name" ]]; then
                ((parameter_count++))
                if [[ "$parameter_count" == 1 ]]; then
                    echo -e "\n| Name | Type | Description | Constraints |\n|------|------|-------------|-------------|\n" >> api_docs/api_documentation.md
                fi
                echo "| \`$current_param_name\` | \`$current_param_type\` | ${current_param_desc:-} | ${current_param_constraints:-None} |" >> api_docs/api_documentation.md
            fi

            # Start new parameter
            current_param_name="$name"
            current_param_type="$type"
            current_param_desc="$rest"
            current_param_constraints=""

            # Check for parameter constraints
            if [[ "$line" =~ ">= " ]]; then
                current_param_constraints+="Min: ${line#*>= }"
            fi
            if [[ "$line" =~ "<= " ]]; then
                [[ -n "$current_param_constraints" ]] && current_param_constraints+=", "
                current_param_constraints+="Max: ${line#*<= }"
            fi
            if [[ "$rest" =~ required ]]; then
                [[ -n "$current_param_constraints" ]] && current_param_constraints+=", "
                current_param_constraints+="Required"
            fi
        else
            # This is additional information for the current parameter
            if [[ "$line" =~ ^Example: ]]; then
                [[ -n "$current_param_constraints" ]] && current_param_constraints+=", "
                current_param_constraints+="Example: ${line#*Example: }"
            elif [[ "$line" =~ ^Match ]]; then
                [[ -n "$current_param_constraints" ]] && current_param_constraints+=", "
                current_param_constraints+="Pattern: ${line#*pattern: }"
            fi
        fi
        continue
    fi

    # Handle request/response sections
    if [[ "$line" == "Request" ]]; then
        # Write out any pending parameter
        if [[ -n "$current_param_name" ]]; then
            ((parameter_count++))
            if [[ "$parameter_count" == 1 ]]; then
                echo -e "\n| Name | Type | Description | Constraints |\n|------|------|-------------|-------------|\n" >> api_docs/api_documentation.md
            fi
            echo "| \`$current_param_name\` | \`$current_param_type\` | ${current_param_desc:-} | ${current_param_constraints:-None} |" >> api_docs/api_documentation.md
            current_param_name=""
            current_param_type=""
            current_param_desc=""
            current_param_constraints=""
        fi

        in_request=true
        in_response=false
        in_parameters=false
        echo -e "\n### Request" >> api_docs/api_documentation.md
        continue
    fi

    if [[ "$line" == "Responses" ]]; then
        # Write out any pending parameter
        if [[ -n "$current_param_name" ]]; then
            ((parameter_count++))
            if [[ "$parameter_count" == 1 ]]; then
                echo -e "\n| Name | Type | Description | Constraints |\n|------|------|-------------|-------------|\n" >> api_docs/api_documentation.md
            fi
            echo "| \`$current_param_name\` | \`$current_param_type\` | ${current_param_desc:-} | ${current_param_constraints:-None} |" >> api_docs/api_documentation.md
            current_param_name=""
            current_param_type=""
            current_param_desc=""
            current_param_constraints=""
        fi

        in_request=false
        in_response=true
        in_parameters=false
        echo -e "\n### Responses\n" >> api_docs/api_documentation.md
        echo -e "| Code | Description |" >> api_docs/api_documentation.md
        echo -e "|------|-------------|" >> api_docs/api_documentation.md
        continue
    fi

    # Process response codes
    if [[ "$in_response" == true ]] && [[ "$line" =~ ^[0-9]{3}$ ]]; then
        last_response_code="$line"
        # Read the next line for description
        read -r next_line
        if [[ -n "$next_line" ]] && ! [[ "$next_line" =~ ^[0-9]{3}$ ]]; then
            echo "| \`$line\` | $next_line |" >> api_docs/api_documentation.md
        else
            echo "| \`$line\` | - |" >> api_docs/api_documentation.md
            # If next line is another code, we need to "unread" it
            if [[ "$next_line" =~ ^[0-9]{3}$ ]]; then
                line="$next_line"
            fi
        fi
        continue
    fi

    # Handle body sections
    if [[ "$line" == "Body" ]]; then
        in_body=true
        echo -e "\n#### Body" >> api_docs/api_documentation.md
        continue
    fi

    # Handle application/json content type
    if [[ "$line" == "application/json" ]]; then
        echo -e "\nContent Type: \`application/json\`" >> api_docs/api_documentation.md
        continue
    fi

    # Reset sections on empty lines
    if [[ -z "$line" ]]; then
        if [[ "$in_json" == false ]]; then
            in_parameters=false
            in_body=false
            current_param_desc=""
            param_desc_indent=0
            response_desc=""
        fi
        continue
    fi

done < docs.txt

# Write out any pending parameter at the end
if [[ -n "$current_param_name" ]]; then
    ((parameter_count++))
    if [[ "$parameter_count" == 1 ]]; then
        echo -e "\n| Name | Type | Description | Constraints |\n|------|------|-------------|-------------|\n" >> api_docs/api_documentation.md
    fi
    echo "| \`$current_param_name\` | \`$current_param_type\` | ${current_param_desc:-} | ${current_param_constraints:-None} |" >> api_docs/api_documentation.md
fi

echo "Documentation has been generated in api_docs/api_documentation.md"
