<?php
include 'header.php';
require 'conn.php';
?>
<style>
   table {
    border-collapse: separate !important;
    text-align: center;
    margin: 10px 0px;
}
</style>
<div class="d-flex p-2"><b>DATE:</b><span class="date"></span></div>
<?php

$sql1 = "SELECT date FROM student_attendance WHERE date = CURDATE()";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$today = date("Y-m-d");
//echo $today;
if(!empty($row1['date'])){
if($row1['date'] == $today){
  echo "<script>alert('($_SESSION[attendancemsg])');</script>";
  header('location:admin_dashboard.php');
}
}
$sql = "SELECT student.enrollment_no, users.fname, users.lname, users.id FROM student 
INNER JOIN
users ON users.id = student.user_id and users.statuss = 1";
$result = mysqli_query($conn, $sql);
echo '<div class="container-fluid">
        <div class="row my-2">
            <div class="col-12 text-center">
            <table id="customers" class= "table">
  <tr>
    <th>Enrollment No</th>
    <th>Name</th>
    <th>Present</th>
    <th>Absent</th>
  </tr>';
  echo '<form method="post" action="attendance_script.php">';
  $flags = 1;
while($row= mysqli_fetch_assoc($result)){
 echo '<tr>
    <td>'.$row['enrollment_no'].'</td>
    <td>'.$row['fname'].' '.$row['lname'].'</td>
    <td><label for="present" class="form-check-label">Present<input type="radio" name="pa'.$flags.'" value="present" class="form-check-input"/></label></td>
    <td><label for="absent" class="form-check-label">Absent<input type="radio" name="pa'.$flags.'" value="absent" class="form-check-input"/></label></td>
    <td> <input type="hidden" name= "user_id'.$flags.'" class="form-control" id="user_id'.$flags.'" value="'.$row['id'].'"/></td>
  </tr>';
  $flags++; 
}

$count = mysqli_num_rows($result);
echo '</table>
<input type="submit" id="sub-btn" class="btn btn-danger" disabled>
            </div>
        </div>
    </div>';
echo '</form>';
$_SESSION['flags'] = $flags;
include 'footer.php';
?>
<script>
  $(document).ready(function(){
    var date = new Date();
    var dd = date.getDate(); 
    var mm = date.getMonth() + 1; 
    var yyyy = date.getFullYear(); 
    var newDate = dd + "-" + mm + "-" +yyyy; 
   
    $(".date").text("-  "+newDate);
   $('.form-check-input').on('change', function(){
    let flag = 0;
      for(let i = 1; i< <?php echo $flags;?>; i++){
      if($('input[name="pa'+i+'"]:checked').length == 0){   
        flag++;
      }
    }
    if(flag == 0){
    $('#sub-btn').removeAttr("disabled");
    $('#sub-btn').css('background-color', 'green');
  }
  else{
    $('#sub-btn').attr("disabled", "disabled");
    $('#sub-btn').css('background-color', 'red');
  }
    });

    /*functionality missing-
     To show error for every student who's attendance is not checked
   */

});  
</script>