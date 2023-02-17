<?php
session_start();
if(empty($_SESSION['enroll'])){
    header('location:login.php');
}
require 'conn.php';
$p = intval($_GET['p']);
$sql1="SELECT * FROM users WHERE id = $p";
$result1 = mysqli_query($conn,$sql1);
while($row1 = mysqli_fetch_array($result1)){
    $sql4 = "UPDATE users SET statuss=2 WHERE id= $p";
    $result4 = mysqli_query($conn,$sql4);
    echo "user is rejected";
}
$conn->close();
?>