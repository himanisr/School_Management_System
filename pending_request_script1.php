
<?php
session_start();
if(empty($_SESSION['enroll'])){
    header('location:login.php');
}
require 'conn.php';
$q = intval($_GET['q']);
$sql1="SELECT * FROM users WHERE id = $q";
$result1 = mysqli_query($conn,$sql1);

while($row1 = mysqli_fetch_array($result1)){
   $sql2 = "SELECT LEFT(fname,4) as fnames from users WHERE id=$q";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);

    $sql3 = "SELECT LEFT(dob,4) as dobs from users WHERE id=$q";
    $result3 = mysqli_query($conn,$sql3);
    $row3 = mysqli_fetch_array($result3);

    $password = strtolower($row2['fnames'])."@".$row3['dobs'];  //generating password
    //$enc_password = password_hash($password, PASSWORD_DEFAULT);          //encrypting password
    //echo $enc_password;

    $sql7 = "SELECT fees FROM applied_course WHERE course_name = '$row1[applied_course]'";  //updating fees coloumn
    $result7 = mysqli_query($conn,$sql7);
    $row7 = mysqli_fetch_assoc($result7);

    $sql4 = "UPDATE users SET pass='$password', statuss=1, amount='$row7[fees]'  WHERE id= $q";
    $result4 = mysqli_query($conn,$sql4);
     
    $sql5 = "SELECT * FROM student WHERE user_id = $q";
    $result5 = mysqli_query($conn,$sql5);
    $row5 = mysqli_fetch_assoc($result3);
    $enroll1= sprintf('%08d', $q);  //making enrollment number an 8 digit number
    $enroll2 = "STD".$enroll1;      //adding string "STD" to it

    $sql6 = "INSERT INTO student(enrollment_no, user_id) VALUES('$enroll2', '$q')";
    $result6 = mysqli_query($conn,$sql6);

    echo "user with id \n".$q."\n is now enrolled";
}
//mail sending function is yet to do;

$conn->close();
?>