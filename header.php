<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
</head>
<style>
    .navbar{
background-color: rgb(35, 71, 87);
}
.nav-link{
    color: white !important;
}
a{
  text-decoration: none;
  color: black;
}
.sections{
  padding: 4px;
}
</style>
<body>
<div class="container-fluid">

<div class="row justify-content-center align-items-center">
            <div class="col-2">
            <img src="Images\logo.png" alt=""/>
            </div>
            <div class="col-8 text-end">
            <h1>SCHOOL MANAGEMENT SYSTEM</h1>
            </div>
</div>
</div>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ABOUT US</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ACADEMICS
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">COURSES</a></li>
            <li><a class="dropdown-item" href="#">ELIGIBILITY CRITERIA</a></li>
            <li><a class="dropdown-item main-menu" href="#" role="button" data-bs-toggle="dropdown">
                    FACILITIES  <i class="fa-solid fa-caret-down sub-icon"></i>
                </a>
         <ul class="sub-menu">
            <li><a class="sub-item" href="#">COLLEGE CANTEEN</a></li>
            <li><a class="sub-item" href="#">LIBRARY</a></li>
            <li><a class="sub-item" href="#">SPORTS AND GAMES</a></li> 
        </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link">STUDENT CORNER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">NEWS & EVENTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">PHOTO GALLERY</a>
        </li>
      </ul>
      <?php
      session_start();
if(isset($_SESSION['enroll'])){
  if($_SESSION['status'] == 3){
    echo '<a href= "admin_dashboard.php"><button type="btn btn-primary my-2" class="btn btn-primary">DASHBOARD</button></a>';
  }
 else{
  echo '<a href= "student_dashboard.php"><button type="btn btn-primary my-2" class="btn btn-primary">DASHBOARD</button></a>';
 }
}
else{
      echo '<ul class="breadcrumb">
      <li class="breadcrumb-item">
          <a class="link-light" aria-current="page" href="register.php">REGISTER</a>
        </li>
        <li class="breadcrumb-item">
          <a class="link-light" aria-current="page" href="login.php">LOGIN</a>
        </li>
      </ul>';
}
?>
    </div>
  </div>
</nav>
</body>
</html>