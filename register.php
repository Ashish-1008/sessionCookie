<?php include 'connection.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Register</h2>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userName = $connection->real_escape_string($_POST['username']);
            $email = $connection->real_escape_string($_POST['email']);
            $password = $connection->real_escape_string($_POST['password']);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); 

            // Insert data into database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$userName', '$email', '$hashedPassword')";
            if ($connection->query($sql) === TRUE) {
                echo '<div class="alert alert-success text-center">Registration successful! Redirecting to login...</div>';
                header("Refresh: 1; url=login.php");
                exit();
            } else {
                echo '<div class="alert alert-danger text-center">Error: ' . $connection->error . '</div>';
            }

            $connection->close();
        }
        ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
