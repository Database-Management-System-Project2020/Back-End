<?php
@session_start();
include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php';
include_once 'Add_functions.php';


 ?>
<form class="recurring-form" id="Recurring" method="post">
  <div class="form-group" >
    <h5><i class="fas fa-pen"></i> Recurring Profiles</h5>
  </div>
  <div class="form-group">
    <label for="Name">Name</label>
    <input type="text" name="Addname_emp" class="form-control" id="Name" placeholder="Name">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="Addpass" class="form-control" id="pass" placeholder="password" >
  </div>
  <div class="form-group">
    <label for="Email">Email address</label>
    <input type="email" name="AddemployeeEmail" class="form-control" id="Email" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="Type">TypeID</label>
    <input type="text" class="form-control" name="Addtype" id="Type">
  </div>
  <div class="form-group">
    <label for="Type">TypeName</label>
    <input type="text" class="form-control" name="Addtypename" id="Type">
  </div>


  <div class="form-group">
    <label for="Job description">Job description</label>
    <textarea class="form-control" name="AddJob_description" id="description"> </textarea>
  </div>
  <div>

      <input type = "submit" name= "AddEmp" value = "AddEmp" class="form-control">
      <input type = "submit" name= "Addemptype" value = "Add emp_type" class="form-control">
  </div>
</form>


 <?php



if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddEmp']) and $_SESSION['EmpType']==1) {

$type = $_POST['Addtype'];
$name_emp = $_POST['Addname_emp'];

$pass = $_POST['Addpass'];
$employeeEmail = $_POST['AddemployeeEmail'];
$Job_description = $_POST['AddJob_description'];


      $formErrors = array();
      if(empty($type)){
          $formErrors[] = 'Employee type cannot be empty';
      }

      if(empty($name_emp)){
          $formErrors[]= 'Employee name cannot be empty';
      }


      if(empty($employeeEmail)){
          $formErrors[]= 'Employee Email cannot be empty';
      }

      if(strlen($Job_description)> 125){
          $formErrors[]= 'Job description cannot be more than 125 characters';
      }

   foreach($formErrors as $errors){
       $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
       redirectHome($themsg, 'back');
   }

   if(empty($formErrors) ){

           $inserted = employee::insert_employee($name_emp, $Job_description, $pass,$employeeEmail, $type  );
           $themsg =  "<div class ='alert alert-success'>" . ' Record Inserted</div>';
           redirectHome($themsg, 'back');



}else{
    echo "No";
}
}elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Addemptype']) and  $_SESSION['EmpType']==1) {
  $typeName = $_POST['Addtypename'];
  $formErrors = array();
  if(empty($typeName)){
      $formErrors[] = 'Employee type cannot be empty';
  }

  foreach($formErrors as $errors){
      $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
      redirectHome($themsg, 'back');
  }
  if(empty($formErrors) ){
      echo $_SESSION['EmpType'];
      $inserted = employee_type::setType($typeName);
     $themsg =  "<div class ='alert alert-success'>" . ' Record Inserted</div>';
      redirectHome($themsg, 'back');

      }
      else{
          echo "no";
      }


}

else{
   echo "Not Working";

}


?>
