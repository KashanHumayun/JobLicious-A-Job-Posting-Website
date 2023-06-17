<?php
include "includes/common.php";
include "includes/config.php";

$active = "jobs";

// Check if the user is logged in and is a job seeker
if ((!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] !== true)) && ($_SESSION['user_role'] !== 'job_seeker')) {
    header("Location: index.php");
    exit;
}
$check=null;
// Handle the CV upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $recruiter_id = $_POST['recruiter_id'];

    // Check if a file was uploaded successfully
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdfFile']['tmp_name'];
        $fileName = $_FILES['pdfFile']['name'];
        $fileSize = $_FILES['pdfFile']['size'];
        $fileType = $_FILES['pdfFile']['type'];

        // Specify the folder to save the uploaded CV files
        $uploadDir = 'cv_files/';

        // Generate a unique file name
        $uniqueFileName = uniqid() . '_' . $fileName;

        // Build the file path
        $filePath = $uploadDir . $uniqueFileName;

        // Move the uploaded file to the desired destination
        move_uploaded_file($fileTmpPath, $filePath);

        // Insert the file details into the "resume" table// Replace with your database credentials
        $stmt = $conn->prepare("INSERT INTO `resume` ( `job_seeker`, `file_name`, `file_path`) VALUES ( ?, ?, ?)");
        $stmt->bind_param('iss', $_SESSION['user_id'], $fileName, $filePath);
        $stmt->execute();
        // Get the last inserted resume_id
        $resume_id = $stmt->insert_id;
        $submission_date = date('Y-m-d'); // Get the current date

        // Insert the job application details into the "jobapplication" table
        $stmt = $conn->prepare("INSERT INTO `jobapplication` (`application_id`, `job_id`, `job_seeker_id`, `resume_id`, `application_status`, `submission_date`) VALUES (NULL, ?, ?, ?, 'pending', ?)");
        $stmt->bind_param('iiss', $job_id, $_SESSION['user_id'], $resume_id,$submission_date);
        $stmt->execute();
        // Display a success message
        $check=true;
        echo " Your application submitted successfully!";
    } 
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
    if($check!=true){
  ?>

<main id="register-container">
    <h2>
        Upload CV
    </h2>

    <form action="upload-cv.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="pdfFile" accept=".pdf">
      <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
      <input type="hidden" name="recruiter_id" value="<?php echo $recruiter_id; ?>">
      <input type="submit" value="Upload CV (PDF)">
    </form>
  </main>

  <?php
    }
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>

</body>
</html>
