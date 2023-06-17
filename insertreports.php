<?php
include "includes/common.php";
include "includes/config.php";

$_SESSION['update_error'] ="";
$active="jobs";
//session_destroy();
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] === 'admin')) {
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
        REPORTS
    </h2>
    <?php
   
        include "includes/adminheader.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user_id = $_SESSION['user_id'] ;
            $report_txt = $_POST['report_txt'] ;
            
            $query = "INSERT INTO report (userId, report_txt) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('is', $user_id, $report_txt);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['update_error'] ="Report submitted Successfully!";
            } 

            $stmt->close();
            $conn->close();
            
        }
        echo '<p id="register-error">' . $_SESSION['update_error'] . '</p>';
        echo '<main id="register-container">';
            echo '<form action="insertreports.php" method="POST">';
            echo '<label class="registerlabel" for="report_txt">Report Description:</label>';
            echo '<textarea class="register-class" name="report_txt" rows="5" cols="50"  placeholder="Write description here!"></textarea>';
            echo '<input type="submit" value="Submit" id="submitButton">';
            echo '</form>';
            echo '</main>';
           
  ?>
  <?php
        if (isset($_SESSION['update_error'])) {
            unset($_SESSION['update_error']);
        }
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