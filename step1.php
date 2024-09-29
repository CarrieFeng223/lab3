<?php
  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_SESSION['personal_info'] = $_POST;
      header("Location: step2.php");
      exit();
  }

  $storedEmail = isset($_SESSION['personal_info']['email']) ? $_SESSION['personal_info']['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step 1: Personal Information</title>
</head>
<body>
  <form method="POST" action="">
      <h2>Step 1: Personal Information</h2>
      Full Name:
      <input type="text" name="fullName" placeholder="Full Name" required><br>
      Email Address:
      <input type="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($storedEmail); ?>" required><br>
      Phone Number:
      <input type="tel" name="phone" placeholder="Phone Number" required><br>
      <button type="submit">Next</button>
  </form>
</body>
</html>