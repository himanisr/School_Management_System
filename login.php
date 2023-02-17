<?php
  include 'header.php';
if(isset($_SESSION['registermessage2'])){
    echo "<script>alert('($_SESSION[registermessage2])')</script>";  
    unset($_SESSION['registermessage2']);
}
if(isset($_SESSION['enroll'])){ 
   header('location:student_dashboard.php');
}
?>

<style>
input[type="submit"] {
    border: none;
    border-radius: 5px;
    width: 50%;
    height: 50px;
    color: black;
    background-color: #7eafc3;
    margin: 10px 0px;
}
</style>
<script>
  $(document).ready(function(){
  $('#enrollment, #password').keyup(function(){
    let flag= 0;
  if($('#enrollment').val() == ""){
  $('#enroll-error').text("Please fill enrollment number");
    flag++;
  }
  else{
    $('#enroll-error').text("");
  }
  /*if($('#enrollment').val().length != 10){
    $('#enroll-error').text("Enrollment number should be 10 digit long");
    flag++;
  }
  else{
    $('#enroll-error').text("");
  }*/
  if($('#password').val() == ""){
    $('#pass-error').text("Please fill password");
  flag++;
  }
  else{
    $('#pass-error').text("");
  }
  if(flag==0){
    $('#sub-btn').removeAttr('disabled');
    $('#sub-btn').css('background-color', 'green');
    $('#error-note').text("");
  }
  else{
   
    $('#sub-btn').attr('disabled', 'disabled');
    $('#error-note').text("please fill mendatory details");
    $('#sub-btn').css('background-color', '#7eafc3');
  }
  });
  });
</script>
  
    <div class="continer-fluid">
        <div class="row  align-items-center justify-content-center">
            <div class="col-xl-10 col-12 pt-4 text-center"><h3>Login Form</h3></div>     
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-10">
        <form class="" action="login-script.php" method="post">
  <div class="mb-3">
    <label for="enrollment" class="form-label">Enrollment Number</label>
    <input type="text" name= "enrollment_no" class="form-control" id="enrollment">
    <p id="enroll-error"></p>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name= "password" class="form-control" id="password">
    <p id="pass-error"></p>
  </div>
 <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input me-2" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>-->
  <input type="submit" id="sub-btn" disabled>
       </form>
         </div>
        </div>
    </div>
  <?php
  include 'footer.php';
  ?>
