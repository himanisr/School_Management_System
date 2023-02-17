<?php
session_start();
require 'conn.php';
for($i=1; $i< $_SESSION['flags']; $i++){
    $arr[] = array('status' => $_POST['pa'.$i.''], 'u_id' =>$_POST['user_id'.$i.'']);
    $pa[] = $_POST['pa'.$i.''];
    $id[] = $_POST['user_id'.$i.''];
}

foreach($arr as $a){
    $sql2 = "INSERT INTO student_attendance(date, stud_user_id, PA) VALUES(CURDATE(), '$a[u_id]', '$a[status]')";
    $result2 = mysqli_query($conn, $sql2);
}
 $_SESSION['attendancemsg'] = "your attendance is submitted";
 header('location: attendance.php');

?>