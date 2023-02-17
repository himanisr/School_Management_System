<?php
  include 'header.php';
  include 'conn.php';
  if(empty($_SESSION['enroll'])){
    header('location:login.php');
}
  if(isset($_SESSION['message1'])){
    echo "<script>alert('($_SESSION[message1])')</script>";
    unset($_SESSION['message1']);
  }
  if(isset($_SESSION['attendancemsg'])){
    echo "<script>alert('($_SESSION[attendancemsg])')</script>";
    unset($_SESSION['attendancemsg']);
  }
$sql1 = "SELECT fname, lname, email, pass, addr, gender, dob, contact FROM users WHERE id = '$_SESSION[userid]'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
?>
<div class="container-fluid">
    <div class="row">
    <div class="col-4">
       <div class="row container-div">
   <div class="circle">
        <img class="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"/>
        <form method= "post" action="update_image.php" enctype="multipart/form-data">
        <i class="bi bi-camera-fill icon-btn" ></i>
        <input class="file-upload" type="file" name= "image" accept="image/*"/>
        <input class="img-submit upload-button" type="submit" name="submit" value="upload"/>
        </form>
    </div>
      
     </div>
     <div class="row">
        <div class="col-12 section-container">
            <div class="sections"><a href="attendance.php">ATTENDANCE</a></div>
            <div class="sections"><a href="attendance_records.php">ATTENDANCE RECORDS</a></div>
            <div class="sections"><a href="pending_requests.php">PENDING REQUESTS</a></div>
            <div class="sections"><a href="pending_fees.php">PENDING FEES</a></div>
            <a href="logout.php" ><button class="btn btn-primary" id="logout">LOGOUT</button></a>
        </div>
        </div>   
        
    </div>
        <div class="col-8 text-right">
        <h1 class="text-center">Welcome <?php echo $_SESSION['name']; ?></h2>
        <form name="my_form" action="student_profile_update.php" method="post">
            <input type="hidden" name="id"  id="id" value="'.$row['id'].'"/><br>
            <label for="enrollment" class="form-label">Enrollment Number</label>
            <input type="text" name= "enrollment_no" class="form-control" id="enrollment" value="<?php echo $_SESSION['enroll'];?>" readonly><br>
            <label for="name">NAME</label>
            <input type="text" name="Name" placeholder="Enter Name" id="name" class="form-control" value="<?php echo $row['fname'].' '.$row['lname'];?>" readonly/><br>
             <label for="name">Contact</label>
             <input type="text" name="Contact" placeholder="Enter Contact Number" class="form-control" value="<?php echo $row['contact'];?>" id="contact" onkeyup="validate_form();"/><br>
             <p id="contact-error" class="error"></p>
             <label for="name">Password</label>
             <input type="text" name="Password" placeholder="Enter Password" class="form-control" value="<?php echo $row['pass'];?>" id="password" onkeyup="validate_form();"/><br>
             <p id="pass-error" class="error"></p>
             <label for="name">Email</label>
             <input type="email" name="Email" placeholder="Enter Email" id="email" class="form-control" value="<?php echo $row['email'];?>" onkeyup="validate_form();"/><br>
             <p id="email-error" class="error"></p>
             <label for="name">Address</label>
             <textarea name="Address" cols="30" rows="4" placeholder="Enter Address" class="form-control" id="address" onkeyup="validate_form();"><?php echo $row['addr'];?></textarea><br>
             <p id="address-error" class="error"></p>
             <input type="submit" class= "btn btn-primary my-2" id="submit_btn" value="UPDATE" name="submit" disabled>
         </form>     
       </div>
    </div>
   </div>
   <?php
  include 'footer.php';
  ?>
<!---- asignment functionality is missing------->

   
<style>

.section-container{
    padding: 5px;
    text-align: center;
}
.sections{
    border: 1px solid black;
    margin: 5px;
    text-align: center;
}

.profile-pic{
    position: relative;
    left: 25%;
    width: 200px;
    max-height: 200px;
    border-radius: 50%;
    max-width: 100%;
    height: auto;
}
.bi-camera-fill{
    font-size: 40px;
    color: black;
    position: relative;
    left: 45%;
}
.file-upload{
    position: relative;
    left: 30%;
    display: none;
}

#logout{
    margin: 10px;
}
.upload-button{   
    display: none;
}
.error{
    color: red;
}

</style>

  
    