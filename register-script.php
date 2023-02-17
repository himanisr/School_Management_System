<?php
require 'conn.php';

        $fname =  $_POST['FNAME'];
        $lname =  $_POST['LNAME'];
        $contact = $_POST['CONTACT'];
        $email = $_POST['EMAIL'];
        $address = $_POST['ADDRESS'];
        $gender =  $_POST['GENDER'];
        $appl_course =  $_POST['APPLIED_COURSE'];
        $dob =  $_POST['DOB'];
        $course =  $_POST['COURSE'];
        $board =  $_POST['BOARD'];
        $clg =  $_POST['CLG'];
        $total =  $_POST['TOTAL'];
        $obt =  $_POST['OBT'];
        $perc =  $_POST['PERC'];
        
        $sql1 = "SELECT email FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql1);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result); 
            if($count == 1 ){
                $_SESSION['registermessage1'] = "User already registered with this email ID";
               header('location:register.php');   
            }else{
                $sql2 = "INSERT INTO users (fname, lname, email, pass, addr, gender, applied_course, dob, contact, course, board, clg, total, obt, perc, statuss, amount) VALUES ('$fname', '$lname', '$email', '$password', '$address', '$gender', '$appl_course', '$dob', '$contact', '$course', '$board',  '$clg', ' $total', '$obt', '$perc', '0', '0')";
                if(mysqli_query($conn, $sql2)){
                  $last_id = $conn->insert_id;
                  $length = count($course);
                    for($i= 0; $i< $length; $i++)
                    {
                    $sql3 = "INSERT INTO edu_details (user_id, course_name, board, college, total, obtained, percentag) VALUES ('$last_id', '$course[$i]', '$board[$i]', '$clg[$i]', '$total[$i]', '$obt[$i]', '$perc[$i]')";
                    if(mysqli_query($conn, $sql3)){
                      $_SESSION['registermessage2'] = "Registered succesfully Please wait for the registration approval to login";
                      header('location:login.php');
                     }else{
                     $_SESSION['registermessage3'] = "Please try again later";
                     header('location:register.php');
                    }
                    }
                     }else{
                        $_SESSION['registermessage4'] = "Please try again later";
                       header('location:register.php');
                      }
                     }
        // Close connection
       
$conn->close();

?>


</body>
</html>