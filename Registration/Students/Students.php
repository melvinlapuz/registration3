<?php 
SESSION_START();
require_once '../config/dbcon.php';
include '../plugin.php';
if ($_SESSION['status'] == "login"){
?>




<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php"><i class="fa-duotone fa-solid fa-lock"></i> Welcome </a>
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



<div class="container m-5">
    <h1> HI STUDENT</h1>
</div>

<br><br>

<div class="container">

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $sql = "SELECT * FROM carousel";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      $counter = 0;
      while($row = $result->fetch_assoc()) {
       ?>
       <div class="carousel-item active <?php if ($counter == 0) {echo "active";}?>" >
      <img src="../images/carousel/<?=$row['carousel_name']?>" class="d-block w-100" alt="...">
      </div>
       <?php
      }
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</div>
<?php
}else{
    $_SESSION['error'] = "INVALID PAGE";
    Header('Location: ../index.php');
}


?>