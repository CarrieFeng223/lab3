<?php
  session_start();

  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_SESSION['work_exp'] = $_POST;
      header("Location: review.php");
      exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step 3: Work Experience</title>
</head>
<body>
  <form method="POST" action="">
      <h2>Step 3: Work Experience</h2>
      Previous Job Title:
      <input type="text" name="job_title" placeholder="Previous Job Title" required><br>
      Company Name:
      <input type="text" name="company_name" placeholder="Company Name" required><br>
      Years of Experience:
      <input type="number" name="years_of_experience" placeholder="Years of Experience" required><br>
      Key Responsibilities:
      <textarea name="responsibilities" placeholder="Key Responsibilities" required></textarea><br>
      <button type="submit">Next</button>
  </form>
</body>
</html>