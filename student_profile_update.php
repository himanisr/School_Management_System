<?php
require 'conn.php';
session_start();

        $password =  $_POST['Password'];
        $contact = $_POST['Contact'];
        $email = $_POST['Email'];
        $address = $_POST['Address'];

        $sql = "UPDATE users
        SET contact = '$contact', pass = '$password', addr = '$address', email = '$email'
        WHERE id = $_SESSION[userid]";
       
        if(mysqli_query($conn,$sql)){
            echo "iff part";
            $_SESSION['msg'] = "Updated successfully";
            header('location:student_dashboard.php');
        } else{
            echo "else part";
            echo $sql. mysqli_error($conn);
            $_SESSION['msg'] = "Data is not updated";
            header('location:student_dashboard.php');
        }
?>