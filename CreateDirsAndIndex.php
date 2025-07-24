<?php

$guides = [
    "Getting Started" => [
        "Installation" => [
            "Install TYPO3 with Composer",
            "Install TYPO3 without Composer",
            "Set up TYPO3 with DDEV",
            "Upgrade an Existing TYPO3 Installation",
        ],
        "Basic Configuration" => [
            "First-time Backend Setup",
            "Create Your First Pages",
            "Set Up a Site Configuration",
            "Implement Site Sets (v13+)",
        ],
        "Content Creation" => [
            "Create and Organize Pages",
            "Add Various Content Elements",
            "Work with the Rich Text Editor",
            "Manage Media Assets",
        ],
        "Site Packages" => [
            "Create a Basic Site Package",
            "Use the Bootstrap Package",
            "Customize Templates",
            "Implement Your Design",
        ],
    ],
    "Building Websites" => [
        "Content Management" => [
            "Set Up Page Types",
            "Create Custom Content Elements",
            "Configure the Backend Layout",
            "Manage Backend User Permissions",
        ],
        "Multilingual Websites" => [
            "Set Up Multiple Languages",
            "Translate Content",
            "Manage Language Fallbacks",
            "Work with Translation Services",
        ],
        "Extensions" => [
            "Find and Install Extensions",
            "Configure Common Extensions",
            "Customize Extension Templates",
            "Troubleshoot Extension Issues",
        ],
        "Frontend Development" => [
            "Understand Fluid Templates",
            "Create Responsive Layouts",
            "Implement Frontend User Registration",
            "Add Custom JavaScript and CSS",
        ],
    ],
    "Advanced Implementation" => [
        "Extension Development" => [
            "Create a Basic Extension",
            "Develop with Extbase and Fluid",
            "Build Non-Extbase Extensions",
            "Create Extension APIs",
        ],
        "System Integration" => [
            "Connect to External Services",
            "Implement Single Sign-On",
            "Set Up REST APIs",
            "Integrate with Third-party Systems",
        ],
        "Performance Optimization" => [
            "Configure Caching",
            "Set Up a CDN",
            "Database Optimization",
            "Implement Static Site Generation",
        ],
        "Deployment and DevOps" => [
            "Set Up CICD Pipelines",
            "Implement Git Workflows",
            "Containerization with Docker",
            "Kubernetes Deployment",
        ],
    ],
    "Maintenance and Security" => [
        "Regular Maintenance" => [
            "Backup and Restore Procedures",
            "Update TYPO3 Core",
            "Update Extensions",
            "Database Maintenance Tasks",
        ],
        "Security" => [
            "Implement Security Best Practices",
            "Set Up HTTPS",
            "Manage User Authentication",
            "Security Incident Response",
        ],
        "Monitoring" => [
            "Set Up Application Monitoring",
            "Configure Log Management",
            "Implement Alerts",
            "Performance Monitoring",
        ],
        "Troubleshooting" => [
            "Debug Common Issues",
            "Use the Admin Panel",
            "Work with Exception Logs",
            "Get Community Support",
        ],
    ],
];

$processor = function (string|array $value, string $path, \Closure $processor) {
    $i = 0;

    foreach ($value as $key => $item) {
        $i++;

        if (is_string($item)) {
            $upperCamelCaseItem = $i . '0' . str_replace(' ', '', ucwords($item));

            mkdir($path . '/' . $upperCamelCaseItem, 0777, true);

            file_put_contents(
                $path . '/' . $upperCamelCaseItem . '/Index.md',
                '# ' . $item . "\n\n" . '*No content yet.*' . "\n"
            );

            echo $path . '/' . $upperCamelCaseItem . "\n";
        } else {
            $upperCamelCaseKey = $i . '0' . str_replace(' ', '', ucwords($key));

            $processor($item, $path . '/' . $upperCamelCaseKey, $processor);

            file_put_contents(
                $path . '/' . $upperCamelCaseKey . '/Index.md',
                '# ' . $key . "\n\n" . '*No content yet.*' . "\n"
            );
        }
    }
};

$processor($guides, getcwd() . '/Documentation', $processor);
