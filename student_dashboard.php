<?php
require 'conn.php';
include 'header.php';
if(empty($_SESSION['enroll'])){
    header('location:login.php');
}
if(isset($_SESSION['statusMsg'])){
    echo "<script>alert('$_SESSION[statusMsg]')</script>";
    unset($_SESSION['statusMsg']);
}
if(isset($_SESSION['msg'])){
    echo "<script>alert('$_SESSION[msg]')</script>";
    unset($_SESSION['msg']);
}

$sql1 = "SELECT fname, lname, email, pass, addr, gender, dob, contact FROM users WHERE id = '$_SESSION[userid]'";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);
  
$sql2= "SELECT images FROM student_images WHERE user_id = '$_SESSION[userid]'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

?>
    <script>
        $(document).ready(function(){
  $(".icon-btn").on('click',function(){
    $(".file-upload").click();
  });

  $(".file-upload").on('change', function(input){
    $(".upload-button").click();
    console.log(input);
    if (input.files && input.files[0]){
        var reader = new FileReader();
      reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  });
 });

        function validate_form(){
            let flag = 0;
       
        if(document.getElementById("contact").value ==""){
            document.getElementById("contact-error").innerHTML = "please provide Your contact number";
            flag++;
        }else if(document.getElementById("contact").value.length !== 10){
            document.getElementById("contact-error").innerHTML = "please provide 10 digit contact number";
            flag++;
        }else{
            document.getElementById("contact-error").innerHTML = "";
        }
       if(document.my_form.Password.value ==""){
            document.getElementById("pass-error").innerHTML = "please provide Your passord";
            flag++;
        }else if(document.getElementById("password").value.length < 4){
            document.getElementById("pass-error").innerHTML = "Password must be more than 4 characters";
            flag++;
        }else if(document.getElementById("password").value.length >= 10){
            document.getElementById("pass-error").innerHTML = "Password must be less than 10 characters";
            flag++; 
        }
        else{
            document.getElementById("pass-error").innerHTML = "";
        }
        if(document.my_form.Email.value ==""){
            document.getElementById("email-error").innerHTML = "please provide Your email";
            flag++;
        }else{
            document.getElementById("email-error").innerHTML = "";
        }
        if(document.my_form.Address.value ==""){
            document.getElementById("address-error").innerHTML = "please provide Your address";
            flag++;
        }else{
            document.getElementById("address-error").innerHTML = "";
        }
        
        if(flag == 0){
            document.getElementById("submit_btn").removeAttribute("disabled");
            $('#submit_btn').css('background-color', 'green');
            
        }else{
            document.getElementById("submit_btn").setAttribute("disabled", "true");
        }
       
    }
    

</script>
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

   <div class="container-fluid">
    <div class="row justify-content-center mt-2">
        <div class="col-4">
       <div class="row container-div">
   <div class="circle">
        <?php
        if($count2 = mysqli_num_rows($result2)){?>
        <img class="profile-pic" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['images']); ?>" /> 
        <?php }
        else{ ?>
        <img class="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"/>
        <?php }?>
        <form method= "post" action="update_image.php" enctype="multipart/form-data">
        <i class="bi bi-camera-fill icon-btn" ></i>
        <input class="file-upload" type="file" name= "image" accept="image/*"/>
        <input class="img-submit upload-button" type="submit" name="submit" value="upload"/>
        </form>
    </div>
      
     </div>
     <div class="row">
        <div class="col-12 section-container">
            <div class="sections"><a href="student_attendance.php">ATTENDANCE</a></div>
            <div class="sections"><a href="student_pending_fees.php">PENDING FEES</a></div>
            <div class="sections"><a href="student_fee_transaction.php">FEES TRANSACTIONS</div>
            <a href="logout.php" ><button class="btn btn-primary" id="logout">LOGOUT</button></a>
        </div>
        </div>   
        
    </div>
        <div class="col-8">
        <h1 class="text-center">Welcome <?php echo $_SESSION['name']; ?></h2>
        <form name="my_form" action="student_profile_update.php" method="post">
            <input type="hidden" name="id"  id="id" value="'.$row['id'].'"/><br>
            <label for="enrollment" class="form-label">Enrollment Number</label>
            <input type="text" name= "enrollment_no" class="form-control" id="enrollment" value="<?php echo $_SESSION['enroll'];?>" readonly><br>
            <label for="name">NAME</label>
            <input type="text" name="Name" placeholder="Enter Name" id="name" class="form-control" value="<?php echo $row['fname']." ".$row['lname'];?>" readonly/><br>
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
    $conn->close();
   include 'footer.php';
   ?>