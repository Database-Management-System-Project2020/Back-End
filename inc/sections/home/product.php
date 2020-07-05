<?php

include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php';
//include_once 'C:\xampp\htdocs\All_tables\books.php';
//include_once 'C:\xampp\htdocs\All_tables\toolsTest.php';

 ?>


  <div id="Products" class="table product">
    <ul>
      <li><a href="#books">Books</a></li>
      <li><a href="#tools">Tools</a></li>
      <li><a href="#ProSa">Product Sale</a></li>
    </ul>
    <div id="books">
      <table id="book-table">

          <tr>

            <th>Brand Name</th>
            <th>Parts</th>
            <th>Image</th>
            <th>Educat Stage</th>
            <th>Subject</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>Barcode</th>
            <th>Available Amount</th>
            <th>Description</th>
            <th>Stock Amount</th>
            <th>StockID</th>
            <th class="action">Edt</th>
            <?php if($_SESSION['EmpType']==1){ ?>
            <th>Dlt</th>
        <?php } ?>
          </tr>

          <?php
          connect();
          $rows = Books::get_Books_table();

          foreach($rows as $row){
              echo "<tr>";

              echo "<td> " . $row['brand_name'] . "</td>";
              echo "<td>" . $row['parts'] . "</td>";
              echo "<td>" ."<img src='media/imgs/book1.jpg' alt='Italian Trulli'>". "</td>";
              //echo "<td>" . '<img src="E:/pictures/' .$row['image'].'" >' . "</td>";
              //echo "<td>" .$row['image']. "</td>";
              echo "<td>" . $row['educational_stage'] . "</td>";
              echo "<td>" . $row['subject'] . "</td>";
              echo "<td>" . $row['product_id'] . "</td>";
              echo "<td>" . $row['product_price'] . "</td>";
              echo "<td>" . $row['product_barcode'] . "</td>";
              echo "<td>" . $row['amount_available'] . "</td>";
              echo "<td>" . $row['product_description'] . "</td>";
              echo "<td>" . $row['quantity'] . "</td>";
              echo "<td>" . $row['idstock'] .  "</td>";
              echo "<td>" . "<form action='edit.php' method ='post'>".
              '<input type="hidden" name="BookID" value="'.$row["product_id"].'">'.
              "<button name='editBook' class='btn edit'>" ."<i class='fas fa-edit'>" ."</i>". "</button>" . "</form>". "</td>";
              if($_SESSION['EmpType'] == 1){

              echo "<td>".
              "<form action='' method ='post'>".
              '<input type="hidden" name="BookID" value="'.$row["product_id"].'">'.
              '<input type="hidden" name="StockID" value="'.$row["idstock"].'">'.

              "<button name='delBook' value ='deleteBook' class='btn edit'>" ."<i class='fas fa-trash'>" ."</i>" . "</button>" ."</form>". "</td>";
              echo "</tr>";
          }
      }
           ?>
         <tr>
     </table>
<?php
      if(isset($_POST['delBook'])){
          if($_POST['delBook']==="deleteBook"){
         Product::delete_product($_POST['BookID']);
         stock::detele($_POST['StockID']);



      }
      }else{
          echo 'not';
      }
?>

    </div>
    <div id="tools">
      <table id="tools-table">

          <tr>

            <th>Product ID</th>
            <th>Type</th>
            <th>Image</th>
            <th>Price</th>
            <th>Barcode</th>
            <th>Available Amount</th>
            <th>Description</th>
            <th>Stock Amount</th>
            <th>StockID</th>
            <th class="action">Edt</th>
            <?php if($_SESSION['EmpType']==1){ ?>
            <th>Dlt</th>
        <?php } ?>
          </tr>

          <?php
          connect();
          $rows = Tools::get_Tools_table();
          foreach($rows as $row){
              echo "<tr>";

              echo "<td> " . $row['product_id'] . "</td>";
              echo "<td>" . $row['type'] . "</td>";
              echo "<td>" ."<img src='media/imgs/book1.jpg' alt='Italian Trulli'>". "</td>";
              //echo "<td>" . "<img src='C:\xampp\htdocs\All_tables\images\'".$row["image"]."' >" . "</td>";
              //echo "<td>" .$row['image']. "</td>";
              echo "<td>" . $row['product_price'] . "</td>";
              echo "<td>" . $row['product_barcode'] . "</td>";
              echo "<td>" . $row['amount_available'] . "</td>";
              echo "<td>" . $row['product_description'] . "</td>";
              echo "<td>" . $row['quantity'] . "</td>";
              echo "<td>" . $row['idstock'] . "</td>";
              echo "<td>" . "<form action='edit.php' method ='post'>".
              '<input type="hidden" name="ToolID" value="'.$row["product_id"].'">'.
              "<button name='editTool' class='btn edit'>" ."<i class='fas fa-edit'>" ."</i>". "</button>" . "</form>". "</td>";
              if($_SESSION['EmpType'] == 1){

              echo "<td>"."<form action='' method ='post'>".
              '<input type="hidden" name="ToolID" value="'.$row["product_id"].'">'.
              '<input type="hidden" name="StockID" value="'.$row["idstock"].'">'.
              "<button name='delTool' value ='deleteTool' class='btn edit'>" ."<i class='fas fa-trash'>" ."</i>" . "</button>" ."</form>". "</td>";
              echo "</tr>";
          }
      }
           ?>
           <tr>
      </table>
      <?php
            if(isset($_POST['delTool'])){
                if($_POST['delTool']==="deleteTool"){
               Product::delete_product($_POST['ToolID']);
               stock::detele($_POST['StockID']);

            }
            }else{
                echo 'not';
            }
      ?>
    </div>
    <div id="ProSa">
      <table id="ps-table">

          <tr>

            <th>Brand Name</th>
            <th>Parts</th>
            <th>Educational Stage</th>
            <th>Subject</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>Barcode</th>
            <th>Available Amount</th>
            <th>Tool Name</th>
            <th>Quantity on Sale</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th class="action">Edt</th>
            <?php if($_SESSION['EmpType']==1){ ?>
            <th>Dlt</th>
        <?php } ?>
          </tr>
          <?php
          connect();
          $rows = Books::get_productSale_table();

          foreach($rows as $row){
              echo "<tr>";
              echo "<td> " . $row['brand_name'] . "</td>";
              echo "<td>" . $row['parts'] . "</td>";
              echo "<td>" . $row['educational_stage'] . "</td>";
              echo "<td>" . $row['subject'] . "</td>";
              echo "<td>" . $row['product_id'] . "</td>";
              echo "<td>" . $row['product_price'] . "</td>";
              echo "<td>" . $row['product_barcode'] . "</td>";
              echo "<td>" . $row['amount_available'] . "</td>";
              echo "<td>" . $row['type'] . "</td>";
              echo "<td>" . $row['quantity'] . "</td>";
              echo "<td>" . $row['start_date'] . "</td>";
              echo "<td>" . $row['end_date'] . "</td>";
              echo "<td>" . "<form action='edit.php' method ='post'>".
              '<input type="hidden" name="proSaID" value="'.$row["product_id"].'">'.
              "<button name='editProSa' class='btn edit'>" ."<i class='fas fa-edit'>" ."</i>". "</button>" . "</form>". "</td>";
              if($_SESSION['EmpType'] == 1){

              echo "<td>"."<form action='' method ='post'>".
              '<input type="hidden" name="ProSaID" value="'.$row["idproduct_sale"].'">'.

              "<button name='delProSa' value ='deleteProSa' class='btn edit'>" ."<i class='fas fa-trash'>" ."</i>" . "</button>" ."</form>". "</td>";
              echo "</tr>";
          }}
           ?>
           <tr>
      </table>
      <?php
            if(isset($_POST['delProSa'])){
                if($_POST['delProSa']==="deleteProSa"){
               product_sale::delete($_POST['ProSaID']);

            }
            }else{
                echo 'not';
            }?>



 </div>
  </div>
