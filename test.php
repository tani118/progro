<?php

// Initialize cURL session
$ch = curl_init();

// Define search criteria for repositories written in C++ with stars between 500 and 1000
$search_criteria = 'language:cpp stars:500..1000'; 

// Set the URL for GitHub API search endpoint
$url = 'https://api.github.com/search/repositories?q=' . urlencode($search_criteria);

// Set options for follow redirects and return transfer
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set headers for authentication and user-agent
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: PHP',
    'Authorization: token _____',
]);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode the JSON response body into an associative array
$data = json_decode($response, true);

// Check if the response contains 'items'
if (isset($data['items'])) {
    $repositories = $data['items'];

    // Output the repository information
    foreach ($repositories as $repo) {
        echo 'Repository Name: ' . $repo['full_name'] . '<br>';
        echo 'Stars: ' . $repo['stargazers_count'] . '<br>';
        echo 'URL: ' . $repo['html_url'] . '<br>';
        echo 'Description: ' . $repo['description'] . '<br>';
        echo '<hr>';
    }
} else {
    echo "No repositories found matching the search criteria.";
}

?>
