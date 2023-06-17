<?php
  include "includes/common.php";
  $active="home";
  //session_destroy();
  if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
  }
  $_SESSION["searchtext"]="";
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

  if ($_SESSION['user_role'] === 'admin') {
    include "includes/adminhomemain.php";
  } 
  // database issue, accounts that were created before this issue got fixed have recruiter's user typesaved with a capital 'R'.
  else if ($_SESSION['user_role'] === "Recruiter" || $_SESSION['user_role'] === "recruiter") {    
    include "includes/recruiter-home-main.php"; 
  }
  else if($_SESSION['user_role'] === "job_seeker"|| $_SESSION['user_role'] === "Job Seeker") {    
    include "includes/seeker-home.php";
   
  }

  else {
    print("{$_SESSION["user_role"]}");
    include "includes/header.php";
  }
  ?>
  
  <?php
    include "includes/aside.php";
    include "includes/footer.php";

  ?>
</body>
</html>