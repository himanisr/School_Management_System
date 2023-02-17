<?php
include 'header.php';
 if(empty($_SESSION['enroll']) && empty($_SESSION['password'])){
  header('location:login.php');
}

if(isset($_SESSION['feesmsg1'])){
  echo "<script>alert('$_SESSION[feesmsg1]')</script>";
  unset($_SESSION['feesmsg1']);
}
if(isset($_SESSION['feesmsg2'])){
  echo "<script>alert('$_SESSION[feesmsg2]')</script>";
  unset($_SESSION['feesmsg2']);
}
require 'conn.php';
      $sql= "SELECT amount FROM users WHERE id= $_SESSION[userid]";
       $result= mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
?>
<script>
    $(document).ready(function(){
    if($('#amount').val() <= 0){
      $('#submit_fees').attr('disabled','disabled');
      $('#submit_fees').css('background-color','grey');
      $('#text').text("you have no dues");
    }
  });
</script>
<style>
  

</style>
<body>
  <div class="row">
    <div class="d-flex flex-column justify-content-center">
      <form method="post" action="feespayment.php" style="text-align: center">
        <label for ="amount">Amount</label>
        <input type="text" name="amount" class= "form-control" id="amount" value="<?php echo $row['amount']; ?>" readonly><br>
        <input type="submit" id = "submit_fees" name="id" class="btn btn-primary border-0" value="SUBMIT"><br>
        <span id="text"></span>
        </form><br>
        <a href="logout.php"><button class="btn btn-primary">LOGOUT</button></a>
        </div>
        </div>
</body>

<?php
    include 'footer.php';
    if(empty($_SESSION['enroll']) && empty($_SESSION['password'])){
      header('location:login.php');
  }
  ?>