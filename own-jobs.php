<?php
    include "includes/common.php";
    if($_SESSION['user_role']!=='recruiter'){
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBLICIOUS | My Jobs</title>
    <script src="javascript/javascript.js"></script>
    <?php
        include "includes/metatags.php";

        include "includes/config.php"
    ?>
</head>
<body>
<script src="javascript/javascript.js"></script>

    <?php
        include "includes/adminheader.php";
        include "includes/aside.php";

        $recruiter_id = $_SESSION['user_id']; // Assuming you have the recruiter ID stored in a session variable
        $sql = "SELECT job_id, job_title, job_description, qualifications, job_location FROM jobposting WHERE recruiter_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $recruiter_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    ?>
    <h1>Your Jobs</h1>
    
        <table class="user-table">
            <tr>
                <th>
                    ID 
                </th>
                <th>
                    Title
                </th>
                <th>
                    Location
                </th>
                <th>
                    Qualifications
                </th>
                <th>
                    Delete
                </th>
            </tr>
            <?php
            if ($result) {
                if (mysqli_num_rows($result) > 0)
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                        <td><?php echo $row['job_id']?></td>
                        <td><?php echo $row['job_title']?></td>
                        <td><?php echo $row['job_location']?></td>
                        <td><?php echo $row['qualifications']?></td>
                        <td>
                            <form method="POST" action="jobs_deleteaction.php">
                                <input type="text" name="job_id" hidden value="<?php echo $row['job_id']?>">
                                <button type="submit" class="delete-button">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
            } else {
                header("includes/main.php");
            }
        ?>
        </table>
</body>
</html>