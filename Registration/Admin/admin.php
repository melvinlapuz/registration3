<?php 
SESSION_START();
require_once '../config/dbcon.php';
include '../plugin.php';
if ($_SESSION['status'] == "login"){
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php"><i class="fa-duotone fa-solid fa-lock"></i> Welcome Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
        </li>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="fa-regular fa-user"></i> Account</a>
          
          <ul class="dropdown-menu">
            <form method="POST" action="../index.php">
           <input type="submit" class=" ms-2 btn btn-danger" value="Logout" style="color: black;">
            </form>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Table bootstrap -->
<div class="container mt-3">
  <br><h2><i class="fa-regular fa-id-card"></i> ACCOUNTS</h2><br>    
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Fullname</th>
      <th scope="col">Age</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $sql = "SELECT * From users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $counter = $row['ID'] + 1;
          if ($row['Email'] != "admin@admin.com"){
            if ($row['status'] != "ENROLLED"){
    ?>
    <form action="../config/enrollStudents.php" method="POST">
    <tr>
    <input type="hidden" name="ID" value="<?=$row['ID']?>">
      <td>#<?=$row['ID']?></td>
      <td><?=$row['Fullname']?></td>
      <td><?=$row['Age']?></td>
      <td><?=$row['Email']?></td>
      <td>**********</td>
      <th scope="col"><?=$row['status']?></th>
      <td> <button type="submit" class="btn btn-primary">ENROLL</button></td>
      </form>

    </tr>
    
    <?php
        }
      }
     }  
    }
    ?>
  </tbody>
</table>
</div>

<div class="container mt-3">
<br><h2><i class="fa-regular fa-id-card"></i>  UPLOADS</h2><br>   

<form action="../config/uploadCarousel.php" method="post" enctype="multipart/form-data">
  Select an image to upload:
  <input type="file" class="form-control mt-2" name="fileToUpload" id="fileToUpload">
  <br>
  <div style="color: green;">
  <?php 
  if (isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
  ?>
  </div>
  <input type="submit" class="btn btn-primary" style="float: right;" value="Upload Image" name="submit">
</form>

</div>
<!-- Table bootstrap -->


<?php
}else{
    $_SESSION['error'] = "INVALID PAGE";
    Header('Location: ../index.php');
}


?>