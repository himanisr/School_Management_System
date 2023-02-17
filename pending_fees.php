<?php
require 'conn.php';
include 'header.php';
if(empty($_SESSION['enroll'])){
  header('location:login.php');
}
$sql1 = "SELECT id, fname, lname, applied_course, amount FROM users WHERE amount != 0";
$result1 = mysqli_query($conn, $sql1);
$count = mysqli_num_rows($result1); 
echo '<div class= "text-center">';
if($count > 0){
    echo '<table class="table table-primary mt-2">
    <thead>
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Course</th>
        <th scope="col">Amount</th>
      </tr>
    </thead>';
    while($row = mysqli_fetch_assoc($result1)){
    echo '<tbody>
      <tr>
        <th scope="row">'.$row['id'].'</th>
        <td>'.$row['fname'].'</td>
        <td>'.$row['lname'].'</td>
        <td>'.$row['applied_course'].'</td>
        <td>'.$row['amount'].'</td>
      </tr>
    </tbody>
  </table>';
    };
    echo '<button type="button" class="btn btn-secondary my-2" name= "mail" value="">SEND MAIL</button>';
  }
else{
 echo "No pending fees \n";
};
echo '</div>';
$conn->close();

include 'footer.php';
?>