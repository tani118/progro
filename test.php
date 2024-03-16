<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Repositories</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add custom CSS */
    .card {
      width: 100%; /* Extend each card to the entire width */
      margin-bottom: 20px; /* Add some spacing between cards */
    }
    .custom-checkbox {
      transform: scale(1.5); /* Increase the size of the checkbox */
    }
    .repo-name {
      display: inline-block;
      margin-left: 10px; /* Add margin to separate checkbox and repository name */
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Repository Information</h1>
  <form action="process_selection.php" method="post"> <!-- Form for selecting repositories -->
    <?php
    $ch = curl_init();
    if(isset() = 'POST'){
$lang = $_POST['language'];
$skill = $_POST['skill'];
$skillLevel = $_POST['skillLevel'];
$threshStarBeginner = 5000;
    // Define search criteria for repositories written in C++ with stars between 500 and 1000$threshStarBeginner = 5000;
$threshStarIntermediate = 10000;
if ($skillLevel == "b") {
    $search_criteria = 'language:' . $lang . ' topic:' . $skill . ' stars:1..' . $threshStarBeginner ;
} elseif ($skillLevel == "i") {
    $search_criteria = 'language:' . $lang . ' topic:' . $skill . ' stars:1..' . $threshStarIntermediate;
} elseif ($skillLevel == "a") {
    $search_criteria = 'language:' . $lang . ' topic:' . $skill . ' stars:' . ($threshStarIntermediate + 1);
}
    }

    $url = 'https://api.github.com/search/repositories?q=' . urlencode($search_criteria);

    // Set options for follow redirects and return transfer
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set headers for authentication and user-agent
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: PHP',
        'Authorization: token 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',
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
        $user_input = array();
        // Output the repository information

        foreach ($repositories as $repo) {
            $desc = ucwords($repo['description']);
            $fname = ucwords($repo['full_name']);
            $repoUrl = $repo['html_url']; // URL of the GitHub repository
            $repoId = $repo['id']; // Unique ID of the repository
            echo '<div class="card mb-3">'; // Modified to remove grid classes and add margin bottom
            echo '<div class="card-body">';
            echo '<input type="checkbox" class="custom-checkbox" name="selected_repos[]" value="' . $repoId . '">'; // Checkbox to select the repository
            echo '<span class="repo-name">' . $fname . '</span>'; // Repository name
            echo '<p class="card-text">' . $desc . '</p>'; // Description
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    <button type="submit" class="btn btn-primary">Submit</button> <!-- Submit button -->
  </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>