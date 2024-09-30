<?php
require_once 'dbcon.php';

$id = $_POST['ID'];

$sql = "UPDATE users SET status='ENROLLED' WHERE ID='$id'";  

if ($conn->query($sql) === TRUE) {
    Header('Location: ../Admin/admin.php');
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

?>