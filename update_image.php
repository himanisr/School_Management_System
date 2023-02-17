<?php
session_start();
require 'conn.php';

// If file upload form is submitted 
$status = $statusMsg = ''; 

if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])){ 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif','JPG', 'PNG', 'JPEG', 'GIF'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            
           
            $sql1 = "SELECT images FROM student_images WHERE user_id = $_SESSION[userid]";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
            $count1 = mysqli_num_rows($result1);
            $sql = "INSERT INTO student_images(user_id, images) VALUES('$_SESSION[userid]','$imgContent')";   
            if($count1 == 1){
               
                // update image content into database 
                $sql2 = "UPDATE student_images SET images = '$imgContent' WHERE user_id = $_SESSION[userid]";
                if(mysqli_query($conn, $sql2)){ 
                    $status = 'success'; 
                    $_SESSION['statusMsg'] = "File uploaded successfully."; 
                    header('location:student_dashboard.php');
                }else{ 
                    $_SESSION['statusMsg'] = "File upload failed, please try again."; 
                    header('location:student_dashboard.php');
                }  
            }
            // Insert image content into database
            else if(($count1 == 0) && mysqli_query($conn, $sql)){ 
                $status = 'success'; 
                $_SESSION['statusMsg'] = "File uploaded successfully."; 
               header('location:student_dashboard.php');
            }
            else{ 
                $_SESSION['statusMsg'] = "File upload failed, please try again."; 
               header('location:student_dashboard.php');
            }  
        }else{ 
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload."; 
                header('location:student_dashboard.php'); 
        } 
    }else{ 
        $_SESSION['statusMsg'] = "'Please select an image file to upload."; 
                header('location:student_dashboard.php');
    } 
} 
?>