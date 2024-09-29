<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = trim($_POST['username']);
      $password = $_POST['password'];
      $remember = isset($_POST['remember']);

      $users = json_decode(file_get_contents('users.json'), true);

      foreach ($users as $user) {
          if ($user['username'] === $username && password_verify($password, $user['password'])) {
              $_SESSION['username'] = $username;
              if ($remember) {
                // 60* 60 * 24 * 7 = 7 days
                // 60* 60 * 24 = 1 days
                  setcookie('username', $username, time() + (60 * 60 * 24 * 7), "/");
              }
              header("Location: step1.php");
              exit();
          }
      }
      $error = "Invalid username or password.";
  }

  $usernameCookie = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<form method="POST" action="">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($usernameCookie); ?>" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label><br>
    <button type="submit">Login</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
<a href="register.php">Don't have an account? Register</a>
</body>
</html>
