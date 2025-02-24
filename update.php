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

// Check if an ID is provided
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    // Fetch the existing data
    $sql = "SELECT * FROM submissions WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission
    $id = intval($_POST["id"]);
    $name_surname = $conn->real_escape_string($_POST["name_surname"]);
    $topic = $conn->real_escape_string($_POST["topic"]);
    $content = $conn->real_escape_string($_POST["content"]);

    $sql = "UPDATE submissions SET name_surname = '$name_surname', topic = '$topic', content = '$content' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Data updated successfully. <a href='display.php'>View Data</a></p>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    exit();
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="display.php">Display Data</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Update Data</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">

            <label for="name">Name - Surname:</label>
            <input type="text" id="name" name="name_surname" value="<?php echo $data["name_surname"]; ?>" required>

            <label for="topic">Topic:</label>
            <input type="text" id="topic" name="topic" value="<?php echo $data["topic"]; ?>" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" required><?php echo $data["content"]; ?></textarea>

            <button type="submit">Update</button>
        </form>
    </main>
</body>
</html>
