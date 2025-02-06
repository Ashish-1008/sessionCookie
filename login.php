<!-- login.php -->
<!DOCTYPE html>
<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    echo $email;

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connection->query($sql);
    echo("REJHJKLJ$result->num_rows");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            header("Location: home.php");
            exit();
        } else {
            echo '<div class="alert alert-danger text-center">Invalid password. Please try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center">No account found with this email. Please register.</div>';
    }
    $connection->close();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php';?>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>