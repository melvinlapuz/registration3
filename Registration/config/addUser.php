<?php
SESSION_START();
require_once 'dbcon.php';
if (strpos($_POST['Email'],'@student.com') || strpos($_POST['Email'],'@admin.com')){
    $Email = str_replace('@admin.com', '@student.com', $_POST['Email']);
}else{
    $Email = $_POST['Email'].'@student.com';
}

$Fullname = $_POST['Fullname'];
$Age = $_POST['Age'];
$Password = $_POST['Password']; 

$sql = "INSERT INTO users (Fullname, Age, Email, Password, status)
VALUES ('$Fullname','$Age','$Email', '$Password', 'PENDING')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Wait for Admin approval";
        Header('Location: ../index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();
?>