<!DOCTYPE html>
<html>
<head>
    <title>Collaborators Finder</title>
</head>
<body>
    <h2>Find Collaborators</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Repository Name: <input type="text" name="repo_name"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $repo_name = $_POST['repo_name'];

        // Query to find collaborators for the given repository
        $sql = "SELECT username FROM user_project WHERE reponame = '$repo_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Collaborators for repository '$repo_name':</h3>";
            while($row = $result->fetch_assoc()) {
                $username = $row["username"];
                exec("python mail.py");
                // Check if colab variable is true for this user
                $colab_sql = "SELECT * FROM user_project WHERE username = '$username' AND reponame = '$repo_name' AND colab = 1";
                $colab_result = $conn->query($colab_sql);

                if ($colab_result->num_rows > 0) {
                    echo "$username (Collaborator)<br>";
                } else {
                    echo "$username<br>";
                }
            }
        } else {
            echo "No collaborators found for repository '$repo_name'";
        }
    }

    // Close connection
    $conn->close();
    ?>

</body>
</html>