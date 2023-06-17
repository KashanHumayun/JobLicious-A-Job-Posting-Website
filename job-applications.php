<?php
include "includes/common.php";
include "includes/config.php";
$active="applications";
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
        Your Applications
    </h2>
    <?php
// Assuming you have already established a database connection

$query = "SELECT ja.*, jp.job_title, u.user_name, r.file_name, r.file_path
          FROM jobapplication AS ja
          INNER JOIN jobposting AS jp ON ja.job_id = jp.job_id
          INNER JOIN user AS u ON jp.recruiter_id = u.user_id
          INNER JOIN resume AS r ON ja.resume_id = r.resume_id";
$result = mysqli_query($conn, $query);

// Check if any applications were found
if (mysqli_num_rows($result) > 0) {
    // Loop through each application and display its details
    while ($row = mysqli_fetch_assoc($result)) {
        $application_id = $row['application_id'];
        $job_id = $row['job_id'];
        $job_seeker_id = $row['job_seeker_id'];
        $resume_id = $row['resume_id'];
        $application_status = $row['application_status'];
        $submission_date = $row['submission_date'];
        $job_title = $row['job_title'];
        $recruiter_name = $row['user_name'];
        $file_name = $row['file_name'];
        $file_path = $row['file_path'];

        echo '<div class="job-entry">';
       
        echo '<div class="job-field"><span class="job-headings">Resume ID: </span> ' . $resume_id . '</div>';

        echo '<div class="job-field"><span class="job-headings">Application Status: </span> ' .  $application_status  . '</div>';

        echo '<div class="job-field"><span class="job-headings">Submission Date: </span> ' .  $submission_date   . '</div>';

        echo '<div class="job-field"><span class="job-headings">Job Title: </span> ' .  $job_title   . '</div>';

        echo '<div class="job-field"><span class="job-headings">Recruiter Name: </span> ' .  $recruiter_name   . '</div>';

        echo '<a class="apply-now" href="' . $file_path . '" download>Download CV</a>';

        echo '</div>';
    }
} else {
    echo "No applications found.";
}

// Close the database connection
mysqli_close($conn);
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