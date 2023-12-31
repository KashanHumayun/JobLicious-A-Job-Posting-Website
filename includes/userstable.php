<?php
include "config.php";
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
    header("Location: ../index.php");
    exit;
  }
$query = "SELECT user_id, user_name, user_email, user_ph_no,user_role FROM user where user_id!=?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']); 
$stmt->execute();
$result=$stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

echo '<table class="user-table">';
echo '<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>User Role</th>
        <th>Actions</th>
      </tr>';
foreach ($users as $user) {
    echo '<tr>';
    echo '<td >' . $user['user_id'] . '</td>';
    echo '<td >' . $user['user_name'] . '</td>';
    echo '<td >' . $user['user_email'] . '</td>';
    echo '<td >' . $user['user_ph_no'] . '</td>';
    echo '<td >' . $user['user_role'] . '</td>';
    echo '<td class="user-actions">';
    echo '<form action="users_edit.php" method="POST" class="edit-form">';
    echo '<input type="hidden" name="id" value="' . $user['user_id'] . '">';
    echo '<input type="hidden" name="name" value="' . $user['user_name'] . '">';
    echo '<input type="hidden" name="email" value="' . $user['user_email'] . '">';
    echo '<input type="hidden" name="role" value="' . $user['user_role'] . '">';
    echo '<input type="hidden" name="phone" value="' . $user['user_ph_no'] . '">';
    echo '<button type="submit" class="edit-button">Edit</button>';
    echo '</form>';        
    echo '<form action="users_deleteaction.php" method="POST" class="delete-form">';
    echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
    echo '<button type="submit" class="delete-button">Delete</button>';
    echo '</form>'; 
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

?>
