<?php
  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $applications = [];
      if (file_exists('applications.json')) {
          $applications = json_decode(file_get_contents('applications.json'), true);
      }
      $applications[] = [
          'username' => $_SESSION['username'],
          'personal_info' => $_SESSION['personal_info'],
          'education_info' => $_SESSION['education_info'],
          'work_exp' => $_SESSION['work_exp']
      ];
      file_put_contents('applications.json', json_encode($applications));
      // Clear session data
      session_destroy();
      echo "<h2>Application Submitted!</h2>";
      echo "<p>A confirmation email has been sent.</p>";
      echo "<a href='logout.php'>Logout</a><br>";
      exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Application</title>
</head>
<body>
  <h2>Review Your Application</h2>
  <p><strong>Full Name:</strong> <?php echo htmlspecialchars($_SESSION['personal_info']['fullName']); ?></p>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['personal_info']['email']); ?></p>
  <p><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['personal_info']['phone']); ?></p>
  <p><strong>Degree:</strong> <?php echo htmlspecialchars($_SESSION['education_info']['degree']); ?></p>
  <p><strong>Field of Study:</strong> <?php echo htmlspecialchars($_SESSION['education_info']['field_of_study']); ?></p>
  <p><strong>Institution:</strong> <?php echo htmlspecialchars($_SESSION['education_info']['institution']); ?></p>
  <p><strong>Year of Graduation:</strong> <?php echo htmlspecialchars($_SESSION['education_info']['year_of_graduation']); ?></p>
  <p><strong>Job Title:</strong> <?php echo htmlspecialchars($_SESSION['work_exp']['job_title']); ?></p>
  <p><strong>Company Name:</strong> <?php echo htmlspecialchars($_SESSION['work_exp']['company_name']); ?></p>
  <p><strong>Years of Experience:</strong> <?php echo htmlspecialchars($_SESSION['work_exp']['years_of_experience']); ?></p>
  <p><strong>Responsibilities:</strong> <?php echo nl2br(htmlspecialchars($_SESSION['work_exp']['responsibilities'])); ?></p>

  <form method="POST" action="">
      <button type="submit">Submit Application</button>
  </form>
  <a href="step1.php">Edit Information TO Step1</a><br>
  <a href="step2.php">Edit Information TO Step2</a><br>
  <a href="step3.php">Edit Information TO Step3</a>
</body>
</html>