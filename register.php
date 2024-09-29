<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $users = json_decode(file_get_contents('users.json'), true) ?: [];
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $error = "Username already exists.";
                break;
            }
        }

        if (!isset($error)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $users[] = ['username' => $username, 'email' => $email, 'password' => $hashedPassword];
            file_put_contents('users.json', json_encode($users));
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<form method="POST" action="">
    <h2>Register</h2>
    username:
    <input type="text" name="username" placeholder="Username" required><br>
    password:
    <input type="password" name="password" placeholder="Password" required><br>
    email:
    <input type="email" name="email" placeholder="Email" required><br>
    <button type="submit">Register</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
<a href="login.php">Already have an account? Login</a>
</body>
</html>
