#!/bin/bash

# Create output directory
mkdir -p api_docs

# Start documentation file
cat > api_docs/models_documentation.md << EOL
# Maxoptra API Models Documentation

Generated on: $(date)

This documentation describes the data models used in the Maxoptra API.

## Table of Contents

EOL

# Initialize variables
current_model=""
in_model=false
in_properties=false
json_content=""
json_indent=0
current_prop_name=""
current_prop_type=""
current_prop_desc=""
current_prop_constraints=""
models=()

# First pass: collect model names for table of contents
while IFS= read -r line; do
    if [[ -n "$line" ]] && ! [[ "$line" =~ ^[[:space:]] ]] && ! [[ "$line" =~ ^{ ]] && ! [[ "$line" =~ ^[a-z] ]]; then
        if [[ "$line" =~ ^[A-Z][A-Za-z]+ ]] && ! [[ "$line" =~ ^Example: ]] && ! [[ "$line" =~ ^Allowed ]] && ! [[ "$line" =~ ^Default ]]; then
            # Skip if this is a description line
            read -r next_line
            if [[ "$next_line" =~ ^{ ]] || [[ "$next_line" =~ ^[A-Z][a-z].* ]]; then
                # Skip if this is a duplicate model name
                if [[ ! " ${models[@]} " =~ " ${line} " ]]; then
                    models+=("$line")
                fi
            fi
        fi
    fi
done < schemas.txt

# Add table of contents
for model in "${models[@]}"; do
    # Convert model name to anchor link
    anchor=$(echo "$model" | tr '[:upper:]' '[:lower:]' | sed 's/ /-/g')
    echo "- [$model](#${anchor})" >> api_docs/models_documentation.md
done

echo -e "\n---\n" >> api_docs/models_documentation.md

# Second pass: process content
while IFS= read -r line; do
    # Skip empty lines at the start
    if [[ -z "$line" ]] && ! [[ "$in_model" ]]; then
        continue
    fi

    # Check for model name and description
    if [[ -n "$line" ]] && ! [[ "$line" =~ ^[[:space:]] ]] && ! [[ "$line" =~ ^{ ]] && ! [[ "$line" =~ ^[a-z] ]]; then
        if [[ "$line" =~ ^[A-Z][A-Za-z]+ ]] && ! [[ "$line" =~ ^Example: ]] && ! [[ "$line" =~ ^Allowed ]] && ! [[ "$line" =~ ^Default ]]; then
            # Write out any pending property
            if [[ -n "$current_prop_name" ]]; then
                echo "| \`$current_prop_name\` | \`$current_prop_type\` | ${current_prop_desc:-} | ${current_prop_constraints:-None} |" >> api_docs/models_documentation.md
                current_prop_name=""
                current_prop_type=""
                current_prop_desc=""
                current_prop_constraints=""
            fi

            # Get next line for description
            read -r next_line

            # Only process if this is a model (has description or schema)
            if [[ "$next_line" =~ ^{ ]] || [[ "$next_line" =~ ^[A-Z][a-z].* ]]; then
                # Skip if this is a duplicate model
                if [[ ! " ${models[@]} " =~ " ${line} " ]]; then
                    continue
                fi

                current_model="$line"
                in_model=true
                in_properties=false

                # Convert model name to anchor link
                anchor=$(echo "$current_model" | tr '[:upper:]' '[:lower:]' | sed 's/ /-/g')
                echo -e "\n<a name=\"${anchor}\"></a>\n## $current_model\n" >> api_docs/models_documentation.md

                if [[ -n "$next_line" ]] && ! [[ "$next_line" =~ ^{ ]]; then
                    echo -e "$next_line\n" >> api_docs/models_documentation.md
                fi
            fi
            continue
        fi
    fi

    # Check for JSON start
    if [[ "$line" == "{" ]]; then
        echo -e "### Schema\n" >> api_docs/models_documentation.md
        echo -e "| Property | Type | Description | Constraints |" >> api_docs/models_documentation.md
        echo -e "|----------|------|-------------|-------------|" >> api_docs/models_documentation.md
        in_properties=true
        continue
    fi

    # Process properties
    if [[ "$in_properties" == true ]] && [[ -n "$line" ]]; then
        # Skip closing brace
        if [[ "$line" == "}" ]]; then
            # Write out any pending property
            if [[ -n "$current_prop_name" ]]; then
                echo "| \`$current_prop_name\` | \`$current_prop_type\` | ${current_prop_desc:-} | ${current_prop_constraints:-None} |" >> api_docs/models_documentation.md
                current_prop_name=""
                current_prop_type=""
                current_prop_desc=""
                current_prop_constraints=""
            fi
            in_properties=false
            continue
        fi

        # Check if this is a property line (starts with a letter and has a type)
        if [[ "$line" =~ ^[a-zA-Z][a-zA-Z0-9_]+ ]]; then
            # Write out any pending property
            if [[ -n "$current_prop_name" ]]; then
                echo "| \`$current_prop_name\` | \`$current_prop_type\` | ${current_prop_desc:-} | ${current_prop_constraints:-None} |" >> api_docs/models_documentation.md
            fi

            # Parse property line
            read -r name type rest <<< "$line"

            # Skip if this is not a property line
            if [[ "$type" == "Parameters" ]] || [[ "$name" == "Request" ]] || [[ "$name" == "Response" ]] || [[ "$name" == "Example:" ]] || [[ "$name" == "Allowed" ]] || [[ "$name" == "Default" ]] || [[ "$name" == "Multiple" ]]; then
                continue
            fi

            current_prop_name="$name"
            current_prop_type="$type"
            current_prop_desc=""
            current_prop_constraints=""

            # Process type-specific constraints
            case "$type" in
                "string")
                    if [[ "$rest" =~ \<.*\> ]]; then
                        current_prop_type="string (${rest#*<})"
                    fi
                    ;;
                "array")
                    if [[ "$rest" =~ \[.*\] ]]; then
                        current_prop_type="array[${rest#*[}${rest%]*}]"
                    fi
                    ;;
            esac

            # Check for required flag
            if [[ "$rest" =~ required ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Required"
            fi

            # Check for read-only flag
            if [[ "$rest" =~ read-only ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Read-only"
            fi

            continue
        fi

        # Process additional property information
        if [[ -n "$current_prop_name" ]]; then
            if [[ "$line" =~ ^Example: ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Example: ${line#*Example: }"
            elif [[ "$line" =~ ^Match ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Pattern: ${line#*pattern: }"
            elif [[ "$line" =~ ^Allowed ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Allowed values: ${line#*values: }"
            elif [[ "$line" =~ ^Default ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Default: ${line#*Default: }"
            elif [[ "$line" =~ ^\>= ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Min: ${line#*>= }"
            elif [[ "$line" =~ ^\<= ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Max: ${line#*<= }"
            elif [[ "$line" =~ ^Multiple ]]; then
                [[ -n "$current_prop_constraints" ]] && current_prop_constraints+=", "
                current_prop_constraints+="Multiple of: ${line#*of: }"
            elif [[ ! "$line" =~ ^[[:space:]] ]] && [[ ! "$line" =~ ^[A-Z] ]] && [[ ! "$line" =~ ^Example: ]] && [[ ! "$line" =~ ^Match ]] && [[ ! "$line" =~ ^Allowed ]] && [[ ! "$line" =~ ^Default ]] && [[ ! "$line" =~ ^\>= ]] && [[ ! "$line" =~ ^\<= ]] && [[ ! "$line" =~ ^Multiple ]]; then
                # This is likely a description
                [[ -n "$current_prop_desc" ]] && current_prop_desc+=" "
                current_prop_desc+="$line"
            fi
        fi
    fi
done < schemas.txt

# Write out any pending property at the end
if [[ -n "$current_prop_name" ]]; then
    echo "| \`$current_prop_name\` | \`$current_prop_type\` | ${current_prop_desc:-} | ${current_prop_constraints:-None} |" >> api_docs/models_documentation.md
fi

echo "Schema documentation has been generated in api_docs/models_documentation.md"
