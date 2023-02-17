<?php
include 'header.php';
require 'conn.php';
if(empty($_SESSION['enroll']) && empty($_SESSION['password'])){
    header('location:login.php');
}
$fees = $_POST['amount'];

$sql1 = "SELECT amount FROM users WHERE id = $_SESSION[userid]";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($result1);
    $amount_due = $row1['amount'] - $fees;
    $amount_paid = $fees;
    $sql2="UPDATE users SET amount = '$amount_due' WHERE id = $_SESSION[userid]";
    if(mysqli_query($conn,$sql2)){
        $sql2 = "INSERT INTO student_transactions(user_id, transaction_date, fees_paid, fees_due) VALUES('$_SESSION[userid]', NOW() ,'$amount_paid', $amount_due)";
        $result2 = mysqli_query($conn,$sql2);
        $_SESSION['feesmsg1'] = "your fees has been submitted";
        header('location:student_pending_fees.php');
       
    }
    else{
        $_SESSION['feesmsg2'] = "your fees can not be submitted please try again later";
    }
?>

