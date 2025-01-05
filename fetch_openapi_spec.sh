#!/bin/bash

# Create output directory
mkdir -p api_docs

# Array of documentation URLs
declare -a URLS=(
    # Customer Locations
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/5334e238f091a-get-a-list-of-customer-locations"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/4a28530426e33-create-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/141d04048d751-get-customer-location-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/164d731dd52f6-partially-update-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/3d449ef15548c-delete-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/8969dec6d7803-update-a-customer-location"

    # Distribution Centers
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/aaad7e81a4107-get-a-list-of-distribution-centres"

    # Drivers
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/89b934ed3d9c9-get-a-list-of-drivers"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/07a55783241fc-create-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/dba241260812e-get-driver-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c3a639a8adc21-partially-update-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/b6ee1abc767b5-delete-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c2eeb1b6d8a96-update-a-driver"

    # Orders
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/feb44a813b9f3-get-execution-details-of-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/cbe2bf2962bef-get-order-items-for-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/1693332116fb2-get-attachments-for-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/08e4d31af62c7-get-pod-details-for-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/921e7f759b863-get-tracking-info-for-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/9545b31c641de-get-a-list-of-orders"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/af0a8f59ced14-create-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/20166272cd5ee-get-order-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/778192d3b32ad-update-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/2edd175d8cbdc-partially-update-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/39ca57e0158e5-delete-an-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/b1rnsgyit1ht1-get-widget-info-for-order-by-reference"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/nbjiyawpfetsp-get-loading-state-of-an-order"
)

# Create documentation file
echo "# Maxoptra API Documentation" > api_docs/api_documentation.md
echo "\nGenerated on: $(date)\n" >> api_docs/api_documentation.md

# Function to clean filename
clean_filename() {
    echo "$1" | sed 's/[^a-zA-Z0-9]/_/g'
}

# Function to extract endpoint name from URL
get_endpoint_name() {
    local url=$1
    echo "$url" | awk -F'/' '{print $NF}' | sed 's/-/ /g' | sed 's/[0-9a-f]\{24\}//' | sed 's/^[- ]*//'
}

# Process each URL
for url in "${URLS[@]}"; do
    echo "Processing $url..."

    # Get endpoint name
    endpoint_name=$(get_endpoint_name "$url")
    clean_name=$(clean_filename "$endpoint_name")

    # Fetch the page
    curl -L -s "$url" > "api_docs/${clean_name}.html"

    # Extract content using lynx
    echo -e "\n## ${endpoint_name}\n" >> api_docs/api_documentation.md
    echo "Source: $url" >> api_docs/api_documentation.md

    lynx -dump -nolist "api_docs/${clean_name}.html" | \
        sed -n '/API Documentation/,$p' | \
        grep -v "Create a Workspace" | \
        grep -v "Like what you see?" >> api_docs/api_documentation.md

    echo -e "\n---\n" >> api_docs/api_documentation.md

    # Clean up HTML file
    rm "api_docs/${clean_name}.html"

    # Be nice to the server
    sleep 1
done

echo "Documentation has been generated in api_docs/api_documentation.md"
