<?php
SESSION_START();
require_once 'dbcon.php';
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$sql = "SELECT * FROM users WHERE Email = '$Email' AND Password = '$Password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  if(strpos($Email, '@admin')){
    $_SESSION['status'] = "login";
    Header('Location: ../Admin/admin.php');
  }else{

    $sql = "SELECT * FROM users WHERE Email='$Email'";
    $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $status = $row['status'];
              $_SESSION['Email'] = $row['Email'];
            }
          } else {
            echo "0 results";
          }

          if ($status == "PENDING"){
            $_SESSION['message'] = "You must wait for the admin approval to login";
            Header('Location: ../index.php');
          }else{
           
            $_SESSION['status'] = "login";
            Header('Location: ../Students/Students.php');
          }
          $conn->close();
             
            }
   
}else {
  $_SESSION['error'] = "INVALID USERNAME OR PASSWORD";
  Header('Location: ../index.php');
}
$conn->close();
?>