#!/bin/bash

# Create output directory
mkdir -p docs_output

# Array of URLs to crawl
urls=(
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/5334e238f091a-get-a-list-of-customer-locations"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/4a28530426e33-create-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/141d04048d751-get-customer-location-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/164d731dd52f6-partially-update-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/3d449ef15548c-delete-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/8969dec6d7803-update-a-customer-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/aaad7e81a4107-get-a-list-of-distribution-centres"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/89b934ed3d9c9-get-a-list-of-drivers"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/07a55783241fc-create-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/dba241260812e-get-driver-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c3a639a8adc21-partially-update-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/b6ee1abc767b5-delete-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c2eeb1b6d8a96-update-a-driver"
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
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/0a022af8f5944-get-vehicle-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/ceaee8c7876b8-update-an-existing-vehicle"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c5502e0b1822e-partially-update-a-vehicle"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/e3cefd44ebe97-delete-a-vehicle"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/9ce82c6821727-get-a-list-of-vehicles"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/54d124796da12-create-a-vehicle"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/440a1192c930a-get-schedule-for-a-distribution-centre"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/0066b14ca5b3e-unallocate-all-scheduled-orders-for-dc"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/9a206d2534342-import-schedules-for-a-distribution-centre"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/019890bbba515-get-schedule-for-a-vehicle"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/5e6864c216ffd-get-schedule-for-a-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/4353da9509bf6-unallocate-order"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/a7037f38467cd-unallocate-run"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/yq61xu8r4qgcd-create-a-subscription"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/apmjxulwytjls-get-a-list-of-subscriptions"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/jekflt9xnwn8j-get-a-subscription"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/i5prykvvqobpy-delete-a-subscription"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/t7plz0tv5vsdm-patch-a-subscription"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/fkrahhrdjwbgu-get-subscription-communication-log"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/7fddd1f34e00a-lock-a-run"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/8b0172bacf75b-unlock-a-run"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/139dc37c6721e-send-a-run-details-to-driver"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/dg57a8tzsteui-get-loading-info-for-run"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/a088756334fe2-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/74d9ba728c247-time-window"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/6c4487eaea520-attachment"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/413d3a8363650-order-item"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/a845f31258abb-order-status"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/813e59bd47897-geo-position"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/b32c171b5443d-location-summary"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/ad6f1e9e15e9f-location-update"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c4606424634fe-warning"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/615ec9114034a-error"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/c0d07f25ecd8c-order-execution-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/e15ab694730ad-order-items-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/6024879cb28ca-order-attachments-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/15bd0c64ba564-pod-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/e4ab7af7b91d1-order-tracking-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/5cb6d68664940-vehicle-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/2014193ff0ff2-driver-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/7f9f87228c9f8-driver-availability-day"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/1b0d4e4e3bcd2-driver-summary"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/9e4d08b4f4393-order-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/a80a568052e0d-vehicle-summary"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/ee334900f4154-geo-location"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/15f25c0e40094-order-summary"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/78538f1620507-paging-links"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/37a49c13f5c48-error-response"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/dce5e86c25f1d-dc-summary"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/b84570d85ab2f-allocation"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/9f5d17aac0342-run"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/84c9b0dda9ff6-schedule"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/d68e18b6396f2-shift"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/e1d5a40de23b3-json-patch-command"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/43ea174c266c4-schedule-import"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/a7ac68f209164-schedule-import-record"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/9a96d7bx17dmi-widget-tracking-details"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/h0bd62hxian4f-subscription-request"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/pzjogr20mw5y8-subscription"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/sguvy6kqqg4c1-subscription-event-enum"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/odypz05y4a6pb-subscription-request-log"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/hobpug6j1i3n0-schedule-updated-callback"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/4wlrhs3m9ya38-order-status-updated-callback"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/92t2yr4dh1j81-loading-status"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/o1y69htvh79nn-order-item-loading-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/27vn8ezm6fgw1-order-loading-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/cern78nl6fi3p-run-loading-info"
    "https://maxoptra.stoplight.io/docs/api-v6-documentation/iom9rqvdqqd99-order-loading-status-short"
)

# Function to clean filename
clean_filename() {
    echo "$1" | sed 's/[^a-zA-Z0-9]/_/g'
}

# Create a combined output file
echo "# Maxoptra API Documentation" > docs_output/combined_docs.md

# Crawl each URL
for url in "${urls[@]}"; do
    echo "Crawling $url..."

    # Extract the endpoint name from URL
    endpoint=$(echo "$url" | awk -F'/' '{print $NF}')
    clean_name=$(clean_filename "$endpoint")

    # Use curl to fetch the content and save it
    curl -L -s "$url" > "docs_output/${clean_name}.html"

    # Extract relevant content (this might need adjustment based on the actual HTML structure)
    # For now, we'll try to extract text content and append to our combined file
    echo -e "\n\n## $endpoint\n" >> docs_output/combined_docs.md
    echo "Source: $url" >> docs_output/combined_docs.md

    # Try to extract meaningful content from the HTML
    # This is a basic extraction - might need refinement based on the actual HTML structure
    lynx -dump -nolist "docs_output/${clean_name}.html" | \
        sed -n '/API Documentation/,$p' | \
        grep -v "Create a Workspace" | \
        grep -v "Like what you see?" >> docs_output/combined_docs.md

    # Add a separator
    echo -e "\n---\n" >> docs_output/combined_docs.md

    # Sleep briefly to be nice to the server
    sleep 2
done

echo "Documentation has been saved to docs_output/combined_docs.md"
echo "Individual HTML files are saved in the docs_output directory"
