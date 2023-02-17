<?php
include 'header.php';
require 'conn.php';
if(empty($_SESSION['enroll'])){
  header('location:login.php');
}
?>
<style>
.container {
    margin: 10px 32px;
    position: relative;
    width: 50%;
    max-width: 80%;
}
.submit {
    position: absolute;
    top: 0px;
    left: -20px;
    border-radius: 0px !important;
    border: 3px solid cadetblue;
}

input{
  width: 40% !important;
  border-radius: 0px !important;
}
.searchbar{
  font-size: 20px;
}
</style>
<script>
$(document).ready(function(){
  $("#submit").click(function() {
 
 var date = $("#date").val();

 if(date==''){
     alert("Please fill the field.");
     return false;
 }

 $.ajax({
     type: "POST",
     url: "attendance_records_script.php",
     data: {
         date: date
     },
     success: function(data) {
         $('#texts').html(data);
         $('.attendance-table, .dates').css("display", "none");
     },
     error: function(xhr, status, error) {
      
         console.error(xhr);
     }
 });
  
});
});
</script>
<div class="container">
<form>
  <input type="text" class="form-control" value="" id="date" name = "date" placeholder="yyyy-mm-dd"/>
  <button id="submit" type="button" class="btn-submit submit"><i class="bi bi-search searchbar"></i></button>
</form>
</div>
<div id="texts"></div>
<?php
$sql2 = "SELECT date FROM student_attendance GROUP BY date";
$result2 = mysqli_query($conn, $sql2);
$count2 = mysqli_num_rows($result2);
while($row2 = mysqli_fetch_assoc($result2)){
  echo '<b class="dates">'.$row2['date'].'</b>';

$sql = "SELECT student_attendance.date, student.enrollment_no, users.fname, users.lname, student_attendance.PA
FROM student_attendance
INNER JOIN student ON student_attendance.stud_user_id = student.user_id 
INNER JOIN users ON student.user_id = users.id
GROUP BY student_attendance.date, student_attendance.PA, student.enrollment_no, users.fname, users.lname ";
$result = mysqli_query($conn, $sql);
echo '<table class="table table-primary attendance-table">
          <thead>
          <tr>
          <th scope="col">Enrollment No</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Attendance Status</th>
          </tr>
          </thead>';
        while($row = mysqli_fetch_assoc($result)){
          if($row['date'] == $row2['date']){
          echo '<tbody>
          <tr>
          <td>'.$row['enrollment_no'].'</td> 
          <td>'.$row['fname'].'</td> 
          <td>'.$row['lname'].'</td> 
          <td>'.$row['PA'].'</td>
          </tr>
          <tbody>';
          }
    }
    echo '</table>'; 
  }
  
?>
