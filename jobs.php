<?php
include "includes/common.php";
$active="jobs";
//session_destroy();
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
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
  ?>
  <main>
    <h2 class="table-heading">
        Jobs
    </h2>
    <?php 
        include "includes/jobstable.php";
    ?>
  </main>
  <?php
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>

</body>
</html>