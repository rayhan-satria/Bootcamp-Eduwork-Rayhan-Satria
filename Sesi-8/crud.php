<?php

require 'koneksi_db.php'; // include the database connection file


// example CRUD operations using the PDO connection ($pdo)
// create
$sql = "INSERT INTO users (name, email) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['Jane Deo', 'jane@example.com']);

// read
$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();

// update
$sql = "UPDATE users SET email = ? WHERE name = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['Jin Du', 'jin@example.com']);

// delete
$sql = "DELETE FROM users WHERE name ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['Jane Deo']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
</head>
<body>
    <h1>Users</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                Name: <?php echo htmlspecialchars($users['name']); ?><br>
                Email: <?php echo htmlspecialchars($users['email']); ?><br>
                Address: <?php echo htmlspecialchars($users['address']); ?><br>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>