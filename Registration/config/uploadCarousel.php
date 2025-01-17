<?php
SESSION_START();
require_once 'dbcon.php';
$target_dir = "../images/carousel/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    header('Location: ../Admin/admin.php');
    $_SESSION['message'] = "File is not an image";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    header('Location: ../Admin/admin.php');
    $_SESSION['message'] = "File is already existed";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    header('Location: ../Admin/admin.php');
    $_SESSION['message'] = "File is too large";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $image_name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $sql = "INSERT INTO carousel (carousel_name)
    VALUES ('$image_name')";

    if (mysqli_query($conn, $sql)) {
    header('Location: ../Admin/admin.php');
    $_SESSION['message'] = "File uploaded successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>