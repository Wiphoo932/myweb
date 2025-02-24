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

// Retrieve data
$sql = "SELECT id, name_surname, topic, content FROM submissions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
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
        <h1>Submitted Data</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name - Surname</th>
                    <th>Topic</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["name_surname"]; ?></td>
                            <td><?php echo $row["topic"]; ?></td>
                            <td><?php echo $row["content"]; ?></td>
                            <td><a href="update.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
