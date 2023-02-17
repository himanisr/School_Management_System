<?php
include 'conn.php';
include 'header.php';
 if(empty($_SESSION['enroll']) && empty($_SESSION['password'])){
  header('location:login.php');
 }
 $sql2 = "SELECT transaction_date, fees_paid, fees_due FROM student_transactions WHERE user_id = '$_SESSION[userid]'";
 $result2 = mysqli_query($conn, $sql2);
 $count2 =  mysqli_num_rows($result2); 
if($count2 > 0){
 echo '<table class="table table-primary">
    <thead>
      <tr>
        <th scope="col">DATE</th>
        <th scope="col">AMOUNT PAID</th>
        <th scope="col">AMOUNT DUE</th>
      </tr>
    </thead>';
      while($row2 = mysqli_fetch_assoc($result2)){
      echo '<tbody>
        <tr>
          <td>'.$row2['transaction_date'].'</td>
          <td>'.$row2['fees_paid'].'</td>
          <td>'.$row2['fees_due'].'</td>
        </tr>
      </tbody>';
    }
    echo '</table>';
}
  else{
    echo '<span>You have no attendance records</span>';
  }
 include 'footer.php';
 ?>