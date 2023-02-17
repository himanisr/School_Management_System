
<style>
    table {
    border-collapse: separate !important;
    text-align: center;
    margin: 10px 0px;
}
</style>
<?php
include 'header.php';
require 'conn.php';
$sql1 = "SELECT PA, CAST(date AS Date ) FROM student_attendance WHERE stud_user_id = '$_SESSION[userid]'"; 
$result1 = mysqli_query($conn,$sql1);
$count1 =  mysqli_num_rows($result1); 
if($count1 > 0){
    echo '<table class="table table-primary">
    <thead>
      <tr>
        <th scope="col">STATUS</th>
        <th scope="col">DATE</th>
      </tr>
    </thead>';
      while($row1 = mysqli_fetch_assoc($result1)){
      echo '<tbody>
        <tr>
          <td>'.$row1['PA'].'</td>
          <td>'.$row1['CAST(date AS Date )'].'</td>
        </tr>
      </tbody>';
    }
    echo '</table>';
  }
  else{
    echo '<span>You have no attendance records</span>';
  }
  
  $conn->close();
  include 'footer.php';
?>