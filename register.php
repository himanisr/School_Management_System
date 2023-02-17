<?php
include 'header.php';
if(isset($_SESSION['registermessage1']))
{
  echo "<script>alert('($_SESSION[registermessage1])')</script>";  
  unset($_SESSION['registermessage1']);
}
if(isset($_SESSION['registermessage3'])){
  echo "<script>alert('($_SESSION[registermessage3])')</script>";
  unset($_SESSION['registermessage3']);
}
?>
<script>
$(document).ready(function(){
  
  let date = new Date();
   let dd = date.getDate();
   let mm = date.getMonth() + 1; // since it returns months from 0-11
   let yyyy = date.getFullYear();
  
   

    if(dd < 10){
      dd = "0"+ dd; //Add a zero if one Digit (eg: 05,09)
    }
    if(mm < 10){
      mm = "0"+ mm; //Add a zero if one Digit (eg: 05,09)
    }
    
    let minYear = yyyy - 50; //Calculate Minimun Age (<50)
    let maxYear = yyyy - 18; //Calculate Maximum Age (>18)

    let min = minYear + "-" + mm + "-" + dd; 
    let max = maxYear + "-" + mm+ "-" + dd; 
     
 $('#dob').attr({min: min, max: max});  //to set attribute for minimum and maximum using jquery 
 var flag = 0;
 setInterval(() => { 
 $('.form-control').keyup(function(){
  let flag1=0;
  $('.course').each(function(index, value){
    if(value.value == ""){
    flag1++;
    $(this).next('.course-error').text("Please provide course name");
   }
   else{
     $(this).next('.course-error').text("");
   }
  });
  let flag2=0;
  $('.board').each(function(index, value){ 
  if(value.value == ""){
    $(this).next('.board-error').text("Please provide board or university name");
    flag2++;
  }
  else{
    $(this).next('.board-error').text("");
  }
});
let flag3=0;
  $('.clg-name').each(function(index, value){ 
    if(value.value == ""){
    $(this).next('.clg-error').text("Please provide college name");
    flag3++;
  }
  else{
    $(this).next('.clg-error').text("");
  }
  });
  let flag4=0;
  $('.total').each(function(index, value){ 
    if(value.value == ""){
    $(this).next('.total-error').text("Please provide total marks");
    flag4++;
  }
  else{
    $(this).next('.total-error').text("");
  }
  });
  let flag5=0;
  $('.obtained').each(function(index, value){ 
    if(value.value == ""){
    $(this).next('.obt-error').text("Please provide obtained marks");
    flag5++;
  }
  else{
    $(this).next('.obt-error').text("");
  }
  });
  let flag6=0;
  $('.calculate').each(function(index, value){ 
if(value.value != ""){
let val1 = $(this).parent().parent().find('.obtained').val();
let val2 = $(this).parent().parent().find('.total').val();
//console.log(val1+" hello "+val2);
val1 = parseInt(val1);
val2 = parseInt(val2);
if(val1 <= val2){
  let values = (val1/val2)*100;
  $(this).parent().parent().find('.percentage').val(values+'%'); 
  $(this).parent().parent().find('.perc-error').text("");
}
else{
  $(this).parent().parent().find('.percentage').val('0%'); 
  $(this).parent().parent().find('.perc-error').text("total should be greater than obtained");
  flag6++;
}
}
  });
    if(flag==0 && flag1==0 && flag2==0 && flag3==0 && flag4==0 && flag5==0 && flag6==0){
    $('#submit-btn').removeAttr("disabled");
    $('#error-note').text("");
    $('#submit-btn').css({"background-color":"green", "border":"none"});
    }
    else{
    $('#submit-btn').attr({"disabled":"disabled"});
    $('#error-note').text("please fill mendatory details");
  }
 });
},1000);

 
$('.form-control, .form-select, .form-check-input').on("keyup change", function(){    // binding multiple events
  let fnew =0;
  let validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if($('#fname').val() == ""){
    $('#fname-error').text("Please provide first name");
    fnew++;}
  else{
    $('#fname-error').text("");
  }
  if($('#email').val() == ""){
    $('#email-error').text("Please provide email address");
    fnew++;}
  else if(!$('#email').val().match(validRegex)){
    $('#email-error').text("Please provide proper email format");
    fnew++;
  }
  else{
    $('#email-error').text("");
  }
  if(($('#contact').val() == "") || ($('#contact').val().length != 10)){
    $('#contact-error').text("Please provide 10 digit contact number");
    fnew++;}
  else{
    $('#contact-error').text("");
  }
  if($('#applied-course').val() == ""){
    $('#appl-course-error').text("Please provide course");
    fnew++;}
  else{
    $('#appl-course-error').text("");
  }
  if($('#dob').val() == ""){
    $('#dob-error').text("Please provide date of birth and your age should be between 18-50");
    fnew++;}
  else{
      $('#dob-error').text("");
  }
  
  if($('input[name="GENDER"]:checked').length == 0){
    $('#gender-error').text("Please provide gender");
    fnew++;}
  else{
    $('#gender-error').text("");
  }
  flag = fnew;
  
});
var flags = 1;
$('#add').click(function(){
 $('#addition').append('<div class="row fields-container" >'+'<div class="col-md-2 col-12 form-fields edu-field1">'+
        '<label for="course" class="form-label">Course</label>'+
        '<input type="text" name="COURSE[]" id="course'+flags+'"  value=""  class="form-control course"/>'+'<p value="" class="course-error"></p>'+
      '</div>'+
      '<div class="col-md-2 col-12 form-fields edu-field2">'+
        '<label for="board" class="form-label">Board(University)</label>'+
        '<input type="text" name="BOARD[]" id="board'+flags+'"  value=""  class="form-control board"/>'+
        '<p class="board-error"></p>'+
      '</div>'+
      '<div class="col-md-2 col-12 form-fields edu-field3">'+
        '<label for="clg" class="form-label">College Name</label>'+
        '<input type="text" name="CLG[]" id="clg'+flags+'"  value=""  class="form-control clg-name"/>'+
        '<p class="clg-error"></p>'+
      '</div>'+
      '<div class="col-md-2 col-12 form-fields edu-field4">'+
        '<label for="total" class="form-label">Total Marks</label>'+
        '<input type="text" name="TOTAL[]" id="total'+flags+'" value="" class="form-control total calculate"/>'+
        '<p class="total-error"></p>'+
      '</div>'+
      '<div class="col-md-2 col-12 form-fields edu-field5">'+
        '<label for="obt" class="form-label">Marks Obtained</label>'+
        '<input type="text" name="OBT[]" id="obt'+flags+'" value="" class="form-control obtained calculate"/>'+
        '<p class="obt-error"></p>'+
      '</div>'+
      '<div class="col-md-2 col-12 form-fields edu-field6">' +
        '<label for="perc" class="form-label">Percentage</label>'+
        '<input type="text" name="PERC[]" id="perc'+flags+'" value="" class="form-control percentage" readonly/>'+
        '<p class="perc-error"></p>'+
       '</div>'+'</div>');
      /*$('<div class="row fields-container" >'+'<div class="col-md-2 col-12 form-fields" id="edu-field1">'+
        '<label for="course" class="form-label">Course</label>'+
        '<input type="text" name="COURSE[]" id="course'+flags+'" class="form-control"/>'+'<p id="course-error"></p>'+
      '</div>'+'</div>').insertAfter('#addition');*/
      flags = flags+1;
});

});
</script>
  <div class="container-fluid">
    <div class="row"><div class="col">
    <h3 class="text-center pt-3">Registration Form</h3></div></div>
    <div class="row justify-content-center">
        <div class="col-xl-11 col-12 form">
    <form name= "REGISTER-FORM" id="register-form" method="post" action= "register-script.php">
       <div class="row justify-content-center fields-container" name="form-row">
       <div class="col-md-6 col-12 form-fields">
        <label for="fname" class="form-label">First Name</label>
        <input type="text" name="FNAME" id="fname" class="form-control"/>
        <p id="fname-error"></p>
        </div>
        <div class="col-md-6 col-12 form-fields">
        <label for="lname" class="form-label">Last Name</label>
        <input type="text" name="LNAME" id="lname" class="form-control"/>
        <p id="lname-error"></p>
        </div></div>
        <div class="row fields-container">
        <div class="col-md-6 col-12 form-fields">
        <label for="email" class="form-label">EMAIL</label>
        <input type="email" name="EMAIL" id="email" class="form-control"/>
        <p id="email-error"></p>
        </div>
        <div class="col-md-6 col-12 form-fields">
        <label for="contact" class="form-label">Contact Number</label>
        <input type="tel" name="CONTACT" id="contact" class="form-control"/>
        <p id="contact-error"></p>
        </div></div>
        <div class="row fields-container">
        <div class="col-md-6 col-12 form-fields">
        <label for="Address"  class="form-label">Address</label>
        <textarea name="ADDRESS" id="Address" cols="20" rows="5"  class="form-control"></textarea>
        <p id="addr-error"></p>
        </div>
        <div class="col-md-6 col-12 form-fields">
        <label for="applied-course" class="form-label">Course</label>
        <select name="APPLIED_COURSE" id="applied-course" class="form-select">
        <option value="">Select Course</option>
            <optgroup label="UG Courses">
            <option value="BA">BA</option>
            <option value="B.Sc">B.Sc</option>
            <option value="BBA">BBA</option>
            <option value="BCA">BCA</option>
            </optgroup>
            <optgroup label="PG Courses">
            <option value="MA">MA</option>
            <option value="M.Sc">M.Sc</option>
            <option value="MBA">MBA</option>
            <option value="MCA">MCA</option>
            </optgroup>
        </select>
        <p id="appl-course-error"></p> 
        </div>
        </div>
        <div class="row fields-container">
        <div class="col-md-6 col-12 form-fields">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="DOB" id="dob" value=""  class="form-control"/>
        <p id="dob-error"></p>
        </div>
        <div class="col-md-6 col-12 form-fields" >
        <p>Gender:</p>
        <label for="male"  class="form-check-label">Male</label>
        <input type="radio" name="GENDER" id="male" value="male"  class="form-check-input"/>
        <label for="female"  class="form-check-label"> Female</label>
        <input type="radio" name="GENDER" id="female"  value="female" class="form-check-input"/>
        <p id="gender-error"></p>
        </div></div>
  <div id="addition">
      <div class="row fields-container">
      <div class="col-md-2 col-12 form-fields edu-field1">
        <label for="course" class="form-label">Course</label>
        <input type="text" name="COURSE[]" id="course" value="" class="form-control course"/>
        <p class="course-error"></p>
      </div>
      <div class="col-md-2 col-12 form-fields edu-field2">
        <label for="board" class="form-label">Board(University)</label>
        <input type="text" name="BOARD[]" id="board" value="" class="form-control board"/>
        <p class="board-error"></p>
      </div>
      <div class="col-md-2 col-12 form-fields edu-field3">
        <label for="clg" class="form-label">College Name</label>
        <input type="text" name="CLG[]" id="clg" value= "" class="form-control clg-name"/>
        <p class="clg-error"></p>
      </div>
      <div class="col-md-2 col-12 form-fields edu-field4"> 
        <label for="total" class="form-label">Total Marks</label>
        <input type="text" name="TOTAL[]" id="total" value="" class="form-control calculate total"/>
        <p class="total-error"></p>
      </div>
      <div class="col-md-2 col-12 form-fields edu-field5">
        <label for="obt" class="form-label">Marks Obtained</label>
        <input type="text" name="OBT[]" id="obt" value="" class="form-control calculate obtained"/>
        <p class="obt-error"></p>
      </div>
      <div class="col-md-2 col-12 form-fields edu-field6"> 
        <label for="perc" class="form-label">Percentage</label>
        <input type="text" name="PERC[]" id="perc" value="" class="form-control percentage" readonly/>
        <p class="perc-error"></p>
       </div>
       </div>
      </div>
        <div class="row fields-container">
        <div class="col-12 form-fields text-center"> 
      <input type="button" name="ADD" id="add" class="form-control new-fields" value="Add New fields"/>
       </div>
       </div>
       <div class="row">
       <div class="col-12 form-fields text-center"> 
        <p id="error-note"></p>
        <input type="submit" value="SUBMIT" id= "submit-btn" class="btn btn-primary mb-2" disabled> 
       </div>
       </div>
    </form>
    </div>
 </div> 
 <?Php
 include 'footer.php';
 ?>
 
