<?php
include "config.php";
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
    header("Location: ../index.php");
    exit;
  }
$query = "SELECT j.job_id, j.recruiter_id, j.job_title, j.job_description, j.qualifications, j.job_location, u.user_name AS recruiter_name 
          FROM jobposting j
          JOIN user u ON j.recruiter_id = u.user_id";
$stmt = $conn->prepare($query);
$stmt->execute();
$result=$stmt->get_result();
$jobs = $result->fetch_all(MYSQLI_ASSOC);

echo '<table class="user-table">';
        echo '<tr><th>JOB ID</th><th>RECRUITER ID</th><th>JOB TITLE</th><th>QUALIFICATIONS</th><th>JOB LOCATION</th><th>ACTIONS</th></tr>';
        foreach ($jobs as $job) {
            echo '<tr>';
            echo '<td>' . $job['job_id'] . '</td>';
            echo '<td>' . $job['recruiter_id'] . '</td>';
            echo '<td>' . $job['job_title'] . '</td>';
            //echo '<td rowspan="2">' . $job['job_description'] . '</td>';
            echo '<td>' . $job['qualifications'] . '</td>';
            echo '<td>' . $job['job_location'] . '</td>';
            echo '<td class="user-actions">';
            echo '<form  class="edit-form" action="jobs_edit.php" method="POST">';
            echo '<input type="hidden" name="job_id" value="' . $job['job_id']  . '">';
            echo '<input type="hidden" name="recruiter_id" value="' . $job['recruiter_id'] . '">';
            echo '<input type="hidden" name="recruiter_name" value="' . $job['recruiter_name'] . '">';
            echo '<input type="hidden" name="job_title" value="' . $job['job_title'] . '">';
            echo '<input type="hidden" name="job_description" value="' . $job['job_description'] . '">';
            echo '<input type="hidden" name="job_qualifications" value="' . $job['qualifications'] . '">';
            echo '<input type="hidden" name="job_location" value="' . $job['job_location'] . '">';
            echo '<button type="submit" class="edit-button">Edit</button>';
            echo '</form>';        
            echo '<form class="delete-form" action="jobs_deleteaction.php" method="POST">';
            echo '<input type="hidden" name="job_id" value="' . $job['job_id']  . '">';
            echo '<button type="submit" class="delete-button">Delete</button>';
            echo '</form>';  
            echo '</td>';
            echo '</tr>';
            //echo '<tr></tr>';
        }
        echo '</table>';
?>
