<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Repository Review</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #4B99BC;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    h1 {
      margin-bottom: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    label, textarea, input[type="submit"] {
      margin-bottom: 10px;
    }
    input[type="text"], textarea {
      padding: 10px;
      width: 80%;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
    p {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Repository Review</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="repo_name">Repository Name:</label>
      <input type="text" id="repo_name" name="repo_name" required>
      <label>Skill Level:</label>
      <input type="radio" id="beginner" name="skill_level" value="beginner" checked>
      <label for="beginner">Beginner</label>
      <input type="radio" id="intermediate" name="skill_level" value="intermediate">
      <label for="intermediate">Intermediate</label>
      <input type="radio" id="advanced" name="skill_level" value="advanced">
      <label for="advanced">Advanced</label>
      <label for="review">Short Review:</label>
      <textarea id="review" name="review" rows="4" cols="50" required></textarea>
      <input type="submit" value="Submit">
    </form>
    <?php
// Execute the Python script to get the output
$output = exec("python feedback_ai.py");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input and sanitize data
    $repo_name = htmlspecialchars($_POST["repo_name"]);
    $skill_level = htmlspecialchars($_POST["skill_level"]);
    $review = htmlspecialchars($_POST["review"]);

    // Insert data into database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ids";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO repository_reviews(repo_name, skill_level, review, priority) VALUES ('$repo_name', '$skill_level', '$review', '$output')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Review successfully submitted.</p>";

        // Write review to a text file
        $file = fopen("reviews.txt", "w");
        if ($file) {
            fwrite($file, $review);
            fclose($file);
            echo "<p>Review written to reviews.txt file.</p>";
        } else {
            echo "<p>Error writing review to file.</p>";
        }
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
}
?>
  </div>
</body>
</html>
