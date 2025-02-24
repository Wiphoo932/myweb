<?php
// Database connection
$host = "sql108.infinityfree.com";
$username = "if0_38334131";
$password = "I46313367i";
$dbname = "if0_38334131_myiot";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name_surname = $conn->real_escape_string($_POST["name_surname"]);
    $topic = $conn->real_escape_string($_POST["topic"]);
    $content = $conn->real_escape_string($_POST["content"]);

    $sql = "INSERT INTO submissions (name_surname, topic, content) VALUES ('$name_surname', '$topic', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Data submitted successfully. <a href='display.php'>View Data</a></p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
