<?php
    include "includes/common.php";
    include "includes/config.php";

    if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'recruiter' || $_SESSION['user_role'] !== 'Recruiter')) {
        header("Location: ../index.php");
        exit;
    }
    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $value=$_POST['value'];
        $application_id=$_POST['application_id'];
        if($value==="accept"){

            $query = "UPDATE jobapplication SET application_status = 'accepted' WHERE application_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $application_id); // Assuming you have the application ID stored in the $application_id variable
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                header("Location: applicants.php");
                echo "Application status updated to 'accepted'.";
            } else {
                echo "Failed to update application status.";
            }

            $stmt->close();

        }
        elseif($value==="reject"){
            $query = "UPDATE jobapplication SET application_status = 'rejected' WHERE application_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $application_id); // Assuming you have the application ID stored in the $application_id variable
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                header("Location: applicants.php");
                echo "Application status updated to 'accepted'.";
            } else {
                echo "Failed to update application status.";
            }

            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBLICIOUS | Create a Job Offer</title>
    <script src="javascript/javascript.js"></script>
    <?php
        include "includes/metatags.php";
    ?>
</head>
<body>
<script src="javascript/javascript.js"></script>

    <?php
        include "includes/adminheader.php";
        include "includes/aside.php";

        $sql = "SELECT * FROM jobapplication";
        $result = mysqli_query($conn, $sql);
    ?>
    <h1>
        Applications!      
    </h1>
    <?php
// Assuming you have already established a database connection

$query = "SELECT ja.*, jp.job_title, u.user_name, r.file_name, r.file_path
FROM jobapplication AS ja
INNER JOIN jobposting AS jp ON ja.job_id = jp.job_id
INNER JOIN user AS u ON jp.recruiter_id = u.user_id
INNER JOIN resume AS r ON ja.resume_id = r.resume_id
WHERE jp.recruiter_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Check if any applications were found
if ($result->num_rows > 0) {
// Loop through each application and display its details
while ($row = $result->fetch_assoc()) {
// Retrieve application details
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

        echo '<button class="apply-now"><span class="applybtnText"><a class="ankr" href="' . $file_path . '" download>Download CV</a></span></button>';

        echo '<form method="POST" action="applicants.php">';
        echo '<input type="text" name="application_id" hidden value="'.$application_id.'">';

        echo '<input type="text" name="value" hidden value="reject">';
        echo '<button type="SUBMIT"class="rejectBtn"><span class="applybtnText">REJECT</span></button>';
        echo '</form>';
        echo '<form method="POST" action="applicants.php">';
        echo '<input type="text" name="value" hidden value="accept">';
        echo '<input type="text" name="application_id" hidden value="'.$application_id.'">';
        echo '<button type="SUBMIT"class="acceptBtn"><span class="applybtnText">ACCEPT</span></button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "No applications found.";
}

// Close the database connection
mysqli_close($conn);
?>
    <?php
        include "includes/aside.php"; 

        include "includes/footer.php";
    ?>
</body>
</html>

