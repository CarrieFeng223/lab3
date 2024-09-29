<?php
  session_start();

  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_SESSION['education_info'] = $_POST;
      header("Location: step3.php");
      exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step 2: Educational Background</title>
</head>
<body>
  <form method="POST" action="">
      <h2>Step 2: Educational Background</h2>
      Highest Degree Obtained:
      <input type="text" name="degree" placeholder="Highest Degree Obtained" required><br>
      Field of Study:
      <input type="text" name="field_of_study" placeholder="Field of Study" required><br>
      Name of Institution:
      <input type="text" name="institution" placeholder="Name of Institution" required><br>
      Year of Graduation:
      <input type="number" name="year_of_graduation" placeholder="Year of Graduation" required><br>
      <button type="submit">Next</button>
  </form>
</body>
</html>
