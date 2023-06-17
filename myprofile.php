<?php
include "includes/common.php";
$active="myprofile";
// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
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
    if ($_SESSION['user_role'] === 'admin') {
        include "includes/adminheader.php";
        include "includes/myprofileinclude.php";
      }
      else if ($_SESSION['user_role'] === 'recruiter' || $_SESSION['user_role'] === 'Recruiter') {
        include "includes/adminheader.php";
        include "includes/myprofileinclude.php";
      } 
      else if ($_SESSION['user_role'] === 'job_seeker') {
        include "includes/adminheader.php";
        include "includes/myprofileinclude.php";
      }
      else {
        include "includes/header.php";
      }
  ?>
  <?php
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>
</body>
</html>