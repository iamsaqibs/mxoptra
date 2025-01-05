const axios = require('axios');
const fs = require('fs/promises');
const path = require('path');

// Base URL for the API
const BASE_URL = 'https://maxoptra.stoplight.io/api/v1';
const PROJECT_ID = 'api-v6-documentation';

async function fetchDocumentation() {
    try {
        // Create output directory
        await fs.mkdir('api_docs', { recursive: true });

        // Start documentation file
        let documentation = '# Maxoptra API Documentation\n\n';
        documentation += `Generated on: ${new Date().toLocaleString()}\n\n`;

        // Fetch API nodes
        console.log('Fetching API nodes...');
        const response = await axios.get(`${BASE_URL}/projects/${PROJECT_ID}/nodes`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        const nodes = response.data;

        // Save raw nodes data
        await fs.writeFile('api_docs/nodes.json', JSON.stringify(nodes, null, 2));

        // Process HTTP operations
        const httpOperations = nodes.nodes.filter(node => node.type === 'http_operation');

        // Group operations by tag
        const groupedOperations = {};

        for (const operation of httpOperations) {
            const tag = operation.tags?.[0] || 'Other';
            if (!groupedOperations[tag]) {
                groupedOperations[tag] = [];
            }
            groupedOperations[tag].push(operation);
        }

        // Generate documentation for each group
        for (const [tag, operations] of Object.entries(groupedOperations)) {
            documentation += `# ${tag}\n\n`;

            for (const operation of operations) {
                documentation += `## ${operation.name || 'Unnamed Operation'}\n\n`;

                if (operation.method && operation.uri) {
                    documentation += `### ${operation.method.toUpperCase()} ${operation.uri}\n\n`;
                }

                if (operation.description) {
                    documentation += `**Description:** ${operation.description}\n\n`;
                }

                if (operation.parameters && operation.parameters.length > 0) {
                    documentation += '**Parameters:**\n\n';
                    for (const param of operation.parameters) {
                        documentation += `- \`${param.name}\` (${param.in}) - ${param.description || 'No description'} ${param.required ? '(Required)' : '(Optional)'}\n`;
                    }
                    documentation += '\n';
                }

                if (operation.requestBody) {
                    documentation += '**Request Body:**\n\n';
                    if (operation.requestBody.content && operation.requestBody.content['application/json']) {
                        const schema = operation.requestBody.content['application/json'].schema;
                        documentation += '```json\n';
                        documentation += JSON.stringify(schema, null, 2);
                        documentation += '\n```\n\n';
                    }
                }

                if (operation.responses) {
                    documentation += '**Responses:**\n\n';
                    for (const [code, response] of Object.entries(operation.responses)) {
                        documentation += `- ${code}: ${response.description || 'No description'}\n`;
                        if (response.content && response.content['application/json']) {
                            const schema = response.content['application/json'].schema;
                            documentation += '\n```json\n';
                            documentation += JSON.stringify(schema, null, 2);
                            documentation += '\n```\n';
                        }
                    }
                    documentation += '\n';
                }

                documentation += '---\n\n';
            }
        }

        // Process models
        const models = nodes.nodes.filter(node => node.type === 'model');

        if (models.length > 0) {
            documentation += '# Models\n\n';

            for (const model of models) {
                documentation += `## ${model.name}\n\n`;

                if (model.description) {
                    documentation += `${model.description}\n\n`;
                }

                if (model.data && model.data.properties) {
                    documentation += '**Properties:**\n\n';
                    for (const [propName, propDetails] of Object.entries(model.data.properties)) {
                        documentation += `- \`${propName}\` (${propDetails.type}) - ${propDetails.description || 'No description'}\n`;
                    }
                    documentation += '\n';
                }

                documentation += '---\n\n';
            }
        }

        // Save documentation
        await fs.writeFile('api_docs/api_documentation.md', documentation);
        console.log('Documentation has been generated in api_docs/api_documentation.md');

    } catch (error) {
        console.error('Error fetching documentation:', error.message);
        if (error.response) {
            console.error('Response data:', error.response.data);
        }
    }
}

fetchDocumentation().catch(console.error);
