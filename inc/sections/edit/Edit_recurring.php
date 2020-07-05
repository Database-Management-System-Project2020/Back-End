<?php
    @session_start();
    include_once 'C:\xampp\htdocs\All_tables\connect.php';
    include_once 'C:\xampp\htdocs\All_tables\delete.php';
    include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['editEmp'])){
    $EmpID = $_POST['EmployeeID'];
    $rows = employee:: get_type_of_employee($EmpID);
    foreach ($rows as $row) {
?>
<form class="recurring-form" id="Recurring" method="post">
    <div class="form-group" >
        <h5><i class="fas fa-pen"></i> Recurring Profiles</h5>
    </div>
    <div class="form-group">
        <label for="Type">Type</label>
        <input type="text" class="form-control" id="Type" name="type" value='<?php echo $row['employee_type_idemployee_type'] ?>' placeholder="Type">
    </div>
    <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" class="form-control" id="Name" name='name_emp' value='<?php echo $row['name_emp']?>' placeholder='<?php echo $row['name_emp']?>' >
    </div>
    <div class="form-group">
        <label for="ID">ID</label>
        <input type="number" class="form-control" id="ID" name='idemployee' value='<?php echo $row['idemployee']?>' placeholder='<?php echo $row['idemployee']?>'>
    </div>
    <?php  if($_SESSION['EmpType']==1){?>
    <div class = "form-group">
        <label for="ID">Password</label>
        <input type = "hidden" name= "oldPassword" class = "form-control"  value = '<?php echo $row['password']?>'>
        <input type = "password" name= "newPassword" class = "form-control" autocomplete="new-password" placeholder="leave blank if you don't want to change your password."/>
    </div>
<?php } ?>
    <div class="form-group">
        <label for="Email">Email address</label>
        <input type="email" class="form-control" id="Email" name='employeeEmail' value='<?php echo $row['employeeEmail'] ?>' placeholder='<?php echo $row['employeeEmail'] ?>'>
    </div>
    <div class="form-group">
        <label for="job">Job description</label>
        <input type="text" class="form-control" id="job" name="Job_description" value="<?php echo $row['Job_description'] ?>" placeholder="<?php echo $row['Job_description'] ?>">
    </div>
    <div>
        <input type = "submit" name= "UpdateEmp" value = "UpdateEmp" class="form-control">
    </div>
</form>

<?php

$rows = employee::get_type_of_employee($_SESSION['ID']);
 foreach ($rows as $row) {
        $_SESSION['EmpType'] = $row['employee_type_idemployee_type'];
 }
 ?>

<?php     } }

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['UpdateEmp'])) {

    $type = $_POST['type'];
    $name_emp = $_POST['name_emp'];
    $EmpID = $_POST['idemployee'];
    $pass = empty($_POST['newPassword'])?  $_POST['oldPassword']: sha1($_POST['newPassword']);
    $employeeEmail = $_POST['employeeEmail'];
    $Job_description = $_POST['Job_description'];

    $formErrors = array();
    if(empty($type)){
        $formErrors[] = 'Employee type cannot be empty';
    }

    if(empty($name_emp)){
        $formErrors[]= 'Employee name cannot be empty';
    }

    if(empty($EmpID)){
        $formErrors[]= 'ID cannot be empty';
    }



    if(empty($employeeEmail)){
        $formErrors[]= 'Employee Email cannot be empty';
    }

    if(strlen($Job_description)> 125){
        $formErrors[]= 'Job description cannot be more than 125 characters';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("idemployee" , "employee" , $EmpID);
        if($check ==1){


                        employee::update_name_emp($name_emp, $EmpID);
                        employee::update_email($employeeEmail, $EmpID);

                        employee::update_password($pass, $EmpID);

                        employee::update_type($type, $EmpID);
                        employee::update_job_description($Job_description, $EmpID);

                        $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
                        redirectHome($themsg);

        }else{
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
            redirectHome($themsg);

        }
    }

} else{
    echo "not here duuuuudeeeeee!";
}


?>
