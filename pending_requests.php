<?php
include 'header.php';
if(empty($_SESSION['enroll'])){
  header('location:login.php');
}
?>
<script>
 $(document).ready(function(){ 
  $('.accept-btn').click(function(){ 
        let id = $(this).val();
      let btnclick = $(this);
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){
     btnclick.prev().html(this.responseText);
      }
    };
    xmlhttp.open("GET","pending_request_script1.php?q="+id,true);
    xmlhttp.send();
    $(this).css('display','none');
    $(this).next().css('display','none');
  }); 

  $('.reject-btn').click(function(){ 
    let id2 = $(this).val();
      let btn2click = $(this);
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){
     btn2click.prev().prev().html(this.responseText);
      }
    };
    xmlhttp.open("GET","pending_request_script2.php?p="+id2,true);
    xmlhttp.send();

    $(this).css('display','none');
   $(this).prev().css('display','none');
   
  });
});  
</script>
<?php

require 'conn.php';

$sql1 = "SELECT * FROM users WHERE statuss = 0";
$result1 = mysqli_query($conn, $sql1);
$count = mysqli_num_rows($result1); 
echo '<div class="text-center my-2">';
if($count > 0){
  for($i=0; $i<$count; $i++){
    while($row = mysqli_fetch_assoc($result1)){
      $sql2 = "SELECT * FROM edu_details WHERE user_id = $row[id]";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      echo '<table class="table table-primary msg">
    <thead>
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Gender</th>
        <th scope="col">Applied Course</th>
        <th scope="col">DOB</th>
        <th scope="col">Contact</th>
        <th scope="col">Course</th>
        <th scope="col">Board</th>
        <th scope="col">College Name</th>
        <th scope="col">Total</th>
        <th scope="col">Obtained</th>
        <th scope="col">Percentage</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">'.$row['id'].'</th>
        <td>'.$row['fname'].'</td>
        <td>'.$row['lname'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['addr'].'</td>
        <td>'.$row['gender'].'</td>
        <td>'.$row['applied_course'].'</td>
        <td>'.$row['dob'].'</td>
        <td>'.$row['contact'].'</td>
        <td>'.$row2['course_name'].'</td>
        <td>'.$row2['board'].'</td>
        <td>'.$row2['college'].'</td>
        <td>'.$row2['total'].'</td>
        <td>'.$row2['obtained'].'</td>
        <td>'.$row2['percentag'].'</td>
      </tr>
    </tbody>
  </table>
  <button type="button" class="btn btn-secondary accept-btn" name= "accept" value="'.$row["id"].'">ACCEPT</button>
  <button type="button" class="btn btn-primary reject-btn" name= "reject" value="'.$row["id"].'" >REJECT</button>';
    };
  };
  }
else{
 echo "No pending requests \n";
echo '<a href= "admin_dashboard.php"><button type="button" class="btn btn-primary">Go back to dashboard</button></a>';
};
echo "</div>";
$conn->close();

include 'footer.php';
?>
