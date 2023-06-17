<?php
  include "includes/common.php";
  //session_destroy();
  if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
  }
  $_SESSION["searchtext"]="";
  $active="about";
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
    include "includes/aboutpage.php";
  ?>
  
  <?php
    include "includes/aside.php";
    include "includes/footer.php";
  ?>
</body>
</html>