<?php
session_start();
require 'conn.php';
$enroll = $_POST['enrollment_no'];
$pass = $_POST['password'];

//$verify = password_verify($pass, $hash); to verify the password
$sql1 ="SELECT users.id, users.statuss, student.enrollment_no, users.pass, users.fname
FROM users
INNER JOIN student
ON student.user_id = users.id AND student.enrollment_no = '$enroll' AND users.pass = '$pass'";

$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
$count1 = mysqli_num_rows($result1);
if($count1 == 1){
    if($row1['statuss'] == 3){
        $_SESSION['enroll'] = $row1['enrollment_no'];
        $_SESSION['userid'] = $row1['id'];
        $_SESSION['name'] = $row1['fname'];
        $_SESSION['status'] = $row1['statuss'];
        header('location:admin_dashboard.php');
       }else{
        $_SESSION['enroll'] = $row1['enrollment_no'];
        $_SESSION['userid'] = $row1['id'];
        $_SESSION['name'] = $row1['fname']; 
        $_SESSION['status'] = $row1['statuss'];
       header('location:student_dashboard.php');
       }
}
else{
$_SESSION['loginmessage'] = "wrong enrollment no or password";
header('location:login.php');
}
$conn->close();
?>