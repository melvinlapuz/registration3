<?php
require_once 'dbcon.php';

$sql = "DELETE FROM carousel WHERE id";

if ($conn->query($sql) === TRUE) {
    
  header('Location: ../Admin/admin');
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>