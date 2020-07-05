<?php

include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';
include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php';
//include_once 'C:\xampp\htdocs\All_tables\testcustomer.php';?>
  <table id="Customer" class="table customer">
      <tr>

        <th>CustomerName</th>
        <th>ID</th>
        <th>Mobile Number</th>
        <th class="action">Edt </th>
        <?php if($_SESSION['EmpType']==1){ ?>
        <th>Dlt</th>
    <?php } ?>
      </tr><?php
      connect();
      $rows = Customer::get_Customer_Table();
      foreach($rows as $row){
          echo "<tr>";

          echo "<td> " . $row['name_c'] . "</td>";
          echo "<td>" . $row['idcustomer'] . "</td>";
          echo "<td>" . $row['telephone_c'] . "</td>";
          echo "<td>" . "<form action='edit.php' method ='post'>".
          '<input type="hidden" name="CustomerID" value="'.$row["idcustomer"].'">'.
          "<button name='editCust' class='btn edit'>" ."<i class='fas fa-edit'>" ."</i>". "</button>" . "</form>". "</td>";

          if($_SESSION['EmpType']==1){
          echo "<td>".
          "<form action='' method ='post'>".
          '<input type="hidden" name="CustID" value="'.$row["idcustomer"].'">'.

          "<button name='delCust' value ='deleteCust' class='btn edit'>" ."<i class='fas fa-trash'>" ."</i>" . "</button>" ."</form>". "</td>";
          echo "</tr>";
      }
  }

?><tr>
 </table>
<?php
 if(isset($_POST['delCust'])){
     if($_POST['delCust']==="deleteCust"){
     Customer::delete_customer_by_id($_POST['CustID']);
     $themsg = "<div class ='alert alert-success'>".' Record Deleted</div>';

     ob_start();
     redirectHome($themsg, 'back');
ob_end_flush();

 }
 }else{
    // echo 'not';
 }?>
