<?php
include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';
include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php'; ?>

  <table id="Supplier" class="table supplier">
    <thead>
      <tr>

        <th>Name</th>
        <th>ID</th>
        <th>Mobile Number</th>
        <th>Address</th>
        <th>Deals</th>
        <th>Supplied Date</th>
        <th>Deadline</th>
        <th>Discount</th>
        <th>Product</th>
        <th>Amount</th>
        <th class="action">Edt </th>
        <?php if($_SESSION['EmpType']==1){ ?>
        <th>Dlt</th>
    <?php } ?>
    </tr><?php
    connect();
    if($_SESSION['EmpType']==1 or $_SESSION['EmpType']==2 ){
    $rows = Supplier::get_Supplier_Table();
    foreach($rows as $row){
        echo "<tr>";

        echo "<td> " . $row['name_s'] . "</td>";
        echo "<td> " . $row['idSupplier'] . "</td>";
        echo "<td>" . $row['telephone_s'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['deals'] . "</td>";
        echo "<td>" . $row['supplied date'] . "</td>";
        echo "<td>" . $row['deadline'] . "</td>";
        echo "<td>" . $row['discount'] . "</td>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . $row['amount_available'] . "</td>";
        echo "<td>" . "<form action='edit.php' method ='post'>".
        '<input type="hidden" name="SuppID" value="'.$row["idSupplier"].'">'.
        "<button name='editSupp' class='btn edit'>" ."<i class='fas fa-edit'>" ."</i>". "</button>" . "</form>". "</td>";
if($_SESSION['EmpType'] ==1){
        echo "<td>"."<form action='' method ='post'>".
        '<input type="hidden" name="SuppID[]" value="'.$row["idSupplier"].'">'.
        '<input type="hidden" name="SuppID[]" value="'.$row["product_id"].'">'.
        '<input type="hidden" name="SuppID[]" value="'.$row["supplied date"].'">'.

        "<button name='delSupp' value ='deleteSupp' class='btn edit'>" ."<i class='fas fa-trash'>" ."</i>" . "</button>" ."</form>". "</td>";
        echo "</tr>";
    }
}
}
?><tr>
</table>
<?php
 if(isset($_POST['delSupp'])){
     if($_POST['delSupp']==="deleteSupp"){
         $suppArray = $_POST['SuppID'];
         if(empty($suppArray[2])){
             $themsg = "<div class ='alert alert-success'>".' nothing to delete</div>';

             ob_start();
             redirectHome($themsg);

         }else
     product_supplier_deal::delete($suppArray[0], $suppArray[1], $suppArray[2]) ;
     $themsg = "<div class ='alert alert-success'>".' Record Deleted</div>';

     ob_start();
     redirectHome($themsg, 'back');
 }

 }else{
    // echo 'not';
 }?>
