<?php
session_start();
if(empty($_SESSION['enroll'])){
    header('location:login.php');
}
require 'conn.php';
$date = $_POST['date'];
$sql1 = "SELECT student_attendance.date, student.enrollment_no, users.fname, users.lname, student_attendance.PA
FROM student_attendance
INNER JOIN student ON student_attendance.stud_user_id = student.user_id AND student_attendance.date = '$date'
INNER JOIN users ON student.user_id = users.id";
 $result1 = mysqli_query($conn,$sql1);
 echo '<b>'.$date.'</b>';
 echo '<table class="table table-primary">
 <thead>
 <tr>
 <th scope="col">Enrollment No</th>
 <th scope="col">First Name</th>
 <th scope="col">Last Name</th>
 <th scope="col">Attendance Status</th>
 </tr>
 </thead>';
while($row = mysqli_fetch_assoc($result1)){
 echo '<tbody>
 <tr>
 <td>'.$row['enrollment_no'].'</td> 
 <td>'.$row['fname'].'</td> 
 <td>'.$row['lname'].'</td> 
 <td>'.$row['PA'].'</td>
 </tr>
 <tbody>';
}
echo '</table>';
$conn->close();
?>