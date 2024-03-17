<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ids";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Open the text file priority.txt in read mode
$file = fopen("priority.txt", "r");

if ($file) {
    // Read the integer value from the file
    $output=exec("python feeback_ai.py");
    $priority = intval(fread($file, filesize("priority.txt")),$output);

    // Update the priority column in the repository_reviews table
    $sql = "UPDATE repository_reviews SET priority = $priority";

    if ($conn->query($sql) === TRUE) {
        echo "Priority updated successfully";
    } else {
        echo "Error updating priority: " . $conn->error;
    }

    // Close the file
    fclose($file);
} else {
    echo "Error opening file";
}

// Close the database connection
$conn->close();
?>
