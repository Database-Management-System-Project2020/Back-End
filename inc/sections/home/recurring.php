<?php
ob_start();

include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php';
include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';

?>

<table id="Recurring" class="table Recurring">
    <thead>
      <tr>

        <th>Type</th>
        <th>Name</th>
        <th>ID</th>
        <th>E-mail</th>
        <!-- <th>Pages available</th> -->
        <th>Job description</th>
        <th class="action">Edit </th>
        <?php  if($_SESSION['EmpType']==1){?>
        <th class="action">Dlt </th>
<?php } ?>
      </tr>
    </thead>
    <tbody>
        <?php
        connect();
        if($_SESSION['EmpType']==1){
        $rows = employee::get_Employee_Table();
        foreach($rows as $row){
            echo "<tr>";

            echo "<td> " . $row['type'] . "</td>";
            echo "<td> " . $row['name_emp'] . "</td>";

            echo "<td>" . $row['idemployee'] . "</td>";
            echo "<td>" . $row['employeeEmail'] . "</td>";

            // echo "<td>" . $row['page_url'] . "</td>";
            echo "<td>" . $row['Job_description'] . "</td>";
            echo "<td>" . "<form action='edit.php' method ='post'>".
            '<input type="hidden" name="EmployeeID" value="'.$row["idemployee"].'">'.
            "<button name='editEmp' class='btn edit'>" ."<i class='fas fa-edit'>" ."</i>". "</button>" . "</form>". "</td>";
            if($_SESSION['EmpType']==1){
            echo "<td>".
            "<form action='' method ='post'>".
            '<input type="hidden" name="EmpDltID" value="'.$row["idemployee"].'">'.
            "<button name='delEmp' value ='deleteEmp' class='btn edit'>" ."<i class='fas fa-trash'>" ."</i>" . "</button>" ."</form>". "</td>";
            echo "</tr>";
        }

        }
    }
            ?>
    </tbody>
</table>

<?php
$rows = employee::get_type_of_employee($_SESSION['ID']);
 foreach ($rows as $row) {
        $_SESSION['EmpType'] = $row['employee_type_idemployee_type'];
 }
 ?>

 <?php
  if(isset($_POST['delEmp'])){
      if($_POST['delEmp']==="deleteEmp"){
      employee::set_null_idemployeetype();
      employee::delete_employee_with_type($_POST['EmpDltID']);
      employee_type::deleteType($_POST['EmpDltID']);

      $themsg = "<div class ='alert alert-success'>".' Record Deleted</div>';

      ob_start();
      redirectHome($themsg, 'back');
 ob_end_flush();

  }
  }else{
     // echo 'not';
  }?>
