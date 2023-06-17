<?php
include "includes/common.php";
$active="myprofile";
// Check if the user is not logged in
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'job_seeker')) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>JobLicious</title>
  <?php
    include "includes/metatags.php";
  ?>
</head>
<body>
<script src="javascript/javascript.js"></script>

  <?php
    
        include "includes/adminheader.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $job_id = $_POST['job_id'];
        }
            
  ?>
  <?php
        // Check if email already exists
        if (isset($_SESSION['update_error'])) {
            echo '<p id="register-error">' . $_SESSION['update_error'] . '</p>';
            unset($_SESSION['update_error']);
        }
    ?>
   <main id="register-container">
<form action="includes/user_editprofileaction.php" method="POST" id="registrationForm">

</form>
</main>
  
  <?php
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>
</body>
</html>