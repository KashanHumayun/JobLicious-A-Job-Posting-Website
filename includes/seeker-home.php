<?php
include "config.php";

    if ((!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] !== true)) && ($_SESSION['user_role'] !== 'job_seeker')) {
        header("Location: ../index.php");
        exit;
    } 
?>
<h2 class="jobseekerhome" >Jobs</h2>
    
<main class="job-entry"> 
    
    <?php
        $query = "SELECT j.job_id, j.recruiter_id, r.user_name, j.job_title, j.job_description, j.qualifications, j.job_location
        FROM jobposting j
        JOIN user r ON j.recruiter_id = r.user_id;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $jobs = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($jobs as $job) { 
            echo '<div class="job-entry">';
            echo '<div class="job-details">';
            echo '<div class="job-title"> <h2>' . $job['job_title'] . '</h2></div>';
            echo '<div class="job-field">'. $job['job_description'] . '</div>';
            echo '<div class="job-field"><span class="job-headings">Qualifications:</span> ' . $job['qualifications'] . '</div>';
            echo '<div class="job-field"><span class="job-headings">Locations:</span>' . $job['job_location'] . '</div>';
            echo '<div class="job-field"><span class="job-headings">Recruiter:</span> '. $job['user_name'] . '</div>';

            echo '</div>';
            echo '<form action="upload-cv.php" method="POST" >';
            echo '<input type="hidden" name="job_id" value="' . $job['job_id'] . '">';
            echo '<input type="hidden" name="recruiter_id" value="' . $job['recruiter_id'] . '">';
            echo '<button class="apply-now"><span class="applybtnText">Apply</span></button>';
            echo '</form>';        
            echo '</div>';
        }
    ?>

</main>
