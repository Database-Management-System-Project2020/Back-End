

<?php
@session_start();
        include_once 'C:\xampp\htdocs\All_tables\connect.php';
        include_once 'C:\xampp\htdocs\All_tables\delete.php';
        include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';


?>
<?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['BookID'])) {
            $BookID = $_POST['BookID'];
            $rows = Books::get_Books_tableByID($BookID);

            foreach ($rows as $row) { ?>
<form enctype="multipart/form-data" class="Products-form" id="Products" method="POST">
  <div class="form-group" >
    <h5><i class="fas fa-pen"></i> Edit Book </h5>
  </div>
  <div class="form-group">
    <label for="Brand_Name">Brand Name </label>
    <input type="text" class="form-control" name= "BrandName" value= "<?php echo $row['brand_name'] ?>" id="Brand_Name" placeholder="Brand Name">
  </div>
  <div class="form-group">
    <label for="Parts">Parts </label>
    <input type="text" class="form-control" name="Parts" value= "<?php echo $row['parts'] ?>" id="Parts" placeholder="Parts">
  </div>

  <div class="form-group">
    <label for="Stage">Educational Stage </label>
    <input type="text" class="form-control" name="Stage" value= "<?php echo $row['educational_stage'] ?>" id="Stage" placeholder="Educational Stage">
  </div>
  <div class="form-group">
    <label for="Subject">Subject </label>
    <input type="text" class="form-control" name="Subject" value= "<?php echo $row['subject'] ?>" id="Subject" placeholder="Subject">
  </div>
  <div class="form-group">
    <label for="product-ID">Product ID </label>
    <input type="number" class="form-control" name="productID" value= "<?php echo $row['product_id'] ?>" id="product-ID" placeholder="product ID">
  </div>
  <div class="form-group">
    <label for="price">Price </label>
    <input type="text" class="form-control" name= "price" value= "<?php echo $row['product_price'] ?>" id="price" placeholder="Price L.E">
  </div>
  <div class="form-group">
    <label for="Barcode">Barcode </label>
    <input type="text" class="form-control" name="Barcode" value= "<?php echo $row['product_barcode'] ?>" id="Barcode" placeholder="Barcode">
  </div>
  <div class="form-group">
    <label for="available_amount">Availanle Amount</label>
    <input type="text" class="form-control" name="availableAmount" value= "<?php echo $row['amount_available'] ?>" id="available_amount" placeholder="Amount">
  </div>
  <div class="form-group">
    <label for="Description">Description</label>
    <textarea class="form-control" name= "descriptionPro" value= "<?php echo $row['product_description'] ?>" id="tool-description">Enter text here...</textarea>
  </div>
  <div class="form-group">
    <label for="Stock_amount">Stock Amount</label>
    <input type="text" class="form-control" name ="StockAmount" value= "<?php echo $row['quantity'] ?>" id="Stock-amount" placeholder="Amount">
  </div>
  <div class="form-group">
    <label for="StockID">Stock Number</label>
    <input type="text" class="form-control" name ="StockID" value= "<?php echo $row['idstock'] ?>" id="Stock-id" placeholder="ID">
  </div>


  <div>
      <input type = "submit" name= "EditBook" value = "Update Book" class="form-control">
  </div>

  <div>
      <input type = "submit" name= "EditStock" value = "Update Stock" class="form-control">
  </div>
</form>
<?php     } }

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['EditBook'])) {

    $brandName = $_POST['BrandName'];
    $Parts = $_POST['Parts'];
    $stage = $_POST['Stage'];
    $subject = $_POST['Subject'];
    $BID = $_POST['productID'];
    $price = $_POST['price'];
    $barcode = $_POST['Barcode'];
    $bookAmount = $_POST['availableAmount'];
    $desc = $_POST['descriptionPro'];


    $stockID = $_POST['StockID'];


    $formErrors = array();
    if(strlen($barcode)< 3){
        $formErrors[] = 'Barcode cannot be less than 4 characters';
    }

    if(strlen($barcode)> 14){
        $formErrors[] = 'Barcode cannot be more than 25 characters';
    }

    if(empty($BID)){
        $formErrors[]= 'Book ID cannot be empty';
    }if(empty($stockID)){
        $formErrors[]= 'Stock ID cannot be empty';
    }if(empty($brandName)){
        $formErrors[]= 'Brand name cannot be empty';
    }if(empty($subject)){
        $formErrors[]= 'Subject cannot be empty';
    }if(empty($barcode)){
        $formErrors[]= 'barcode cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("product_product_id" , "books" , $BID);
        if($check ==1){

                        Product::update_price($price,$BID);
                        Product::update_description($desc,$BID);
                        Product::update_amount_available($bookAmount,$BID);
                        Books::update_brand_name($brandName, $barcode);
                        Books::update_parts($Parts,$barcode);
                        Books::update_subject($subject, $barcode);

                        Books::update_educational_stage($stage, $barcode);
                            $check = checkItem("idstock" , "stock" , $stockID);
                            if($check ==1){
                                Books:: update_FK_STOCKID($stockID, $barcode);
                            }else{
                                $themsg = "<div class ='alert alert-success'>".'  All updated Except Stock ID, Please Add it first </div>';
                                redirectHome($themsg);

                            }


                         $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
                         redirectHome($themsg);

        }else{
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
            redirectHome($themsg);

        }





}


}elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['EditStock'])) {
    $StockAmount = $_POST['StockAmount'];
    $stockID = $_POST['StockID'];


    $formErrors = array();
    if(empty($stockID)){
        $formErrors[]= 'Stock ID cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("idstock" , "stock" , $stockID);
        if($check ==1){
            stock::updatequantity($stockID,$StockAmount);
            $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
            redirectHome($themsg);

    }
}else{
    $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
    redirectHome($themsg);

    }
}



else{
    echo "Go away";
}









?>


<?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['ToolID'])){
            $ToolID = $_POST['ToolID'];
            $rows = Tools::get_Tools_tableByID($ToolID);

            foreach ($rows as $row) { ?>
<form enctype="multipart/form-data" class="Products-form" id="Products" method="POST">
  <div class="form-group" >
    <h5><i class="fas fa-pen"></i> Edit Tool </h5>
  </div>
  <div class="form-group">
    <label for="Type">Tool Type </label>
    <input type="text" class="form-control" name="toolType" value= "<?php echo $row['type'] ?>" id="Tool_type" placeholder="Tool Type">
  </div>

  <div class="form-group">
    <label for="product-ID">Product ID </label>
    <input type="number" class="form-control" name="productID" value= "<?php echo $row['product_id'] ?>" id="product-ID" placeholder="product ID">
  </div>
  <div class="form-group">
    <label for="price">Price </label>
    <input type="text" class="form-control" name= "price" value= "<?php echo $row['product_price'] ?>" id="price" placeholder="Price L.E">
  </div>
  <div class="form-group">
    <label for="Barcode">Barcode </label>
    <input type="text" class="form-control" name="Barcode" value= "<?php echo $row['product_barcode'] ?>" id="Barcode" placeholder="Barcode">
  </div>
  <div class="form-group">
    <label for="available_amount">Availanle Amount</label>
    <input type="text" class="form-control" name="availableAmount" value= "<?php echo $row['amount_available'] ?>" id="available_amount" placeholder="Amount">
  </div>
  <div class="form-group">
    <label for="Description">Description</label>
    <textarea class="form-control" name= "descriptionPro" value= "<?php echo $row['product_description'] ?>" id="tool-description">Enter text here...</textarea>
  </div>
  <div class="form-group">
    <label for="Stock_amount">Stock Amount</label>
    <input type="text" class="form-control" name ="StockAmount" value= "<?php echo $row['quantity'] ?>" id="Stock-amount" placeholder="Amount">
  </div>
  <div class="form-group">
    <label for="StockID">Stock Number</label>
    <input type="text" class="form-control" name ="StockID" value= "<?php echo $row['idstock'] ?>" id="Stock-id" placeholder="ID">
  </div>


  <div>
      <input type = "submit" name= "EditTool" value = "Update Tool" class="form-control">
  </div>

  <div>
      <input type = "submit" name= "EditStock" value = "Update Stock" class="form-control">
  </div>
</form>
<?php     } }
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['EditTool'])) {

    $toolType = $_POST['toolType'];
    $BID = $_POST['productID'];
    $price = $_POST['price'];
    $barcode = $_POST['Barcode'];
    $bookAmount = $_POST['availableAmount'];
    $desc = $_POST['descriptionPro'];
    $stockID = $_POST['StockID'];



    $formErrors = array();
    if(strlen($barcode)< 3){
        $formErrors[] = 'Barcode cannot be less than 4 characters';
    }

    if(strlen($barcode)> 14){
        $formErrors[] = 'Barcode cannot be more than 25 characters';
    }

    if(empty($BID)){
        $formErrors[]= 'Book ID cannot be empty';
    }if(empty($stockID)){
        $formErrors[]= 'Stock ID cannot be empty';
    }if(empty($toolType)){
        $formErrors[]= 'Tool type cannot be empty';
    }if(empty($barcode)){
        $formErrors[]= 'barcode cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("product_product_id" , "Tools" , $BID);
        if($check ==1){

                        Product::update_price($price,$BID);
                        Product::update_description($desc,$BID);
                        Product::update_amount_available($bookAmount,$BID);

                        Tools::update_type($toolType, $barcode);
                            $check = checkItem("idstock" , "stock" , $stockID);
                            if($check ==1){
                                Books:: update_FK_STOCKID($stockID, $barcode);
                            }else{
                                $themsg = "<div class ='alert alert-success'>".'  All updated Except Stock ID, Please Add it first </div>';
                                redirectHome($themsg);

                            }


                         $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
                         redirectHome($themsg);

        }else{
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
            redirectHome($themsg);

        }





}


}elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['EditStock'])) {
    $StockAmount = $_POST['StockAmount'];
    $stockID = $_POST['StockID'];


    $formErrors = array();
    if(empty($stockID)){
        $formErrors[]= 'Stock ID cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("idstock" , "stock" , $stockID);
        if($check ==1){
            stock::updatequantity($stockID,$StockAmount);
            $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
            redirectHome($themsg);

    }
}else{
    $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
    redirectHome($themsg);

    }
}



else{
    echo "Go away";
}






?>


<?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['proSaID'])){
            $ProSaID = $_POST['proSaID'];
            $rows = Books::get_productSale_tableByID($ProSaID);

            foreach ($rows as $row) { ?>
<form class="Products-form" id="Products" method="POST">
  <div class="form-group" >
    <h5><i class="fas fa-pen"></i> Edit Product Sales </h5>
  </div>

  <div class="form-group">
    <label for="product-ID">Product Sale ID </label>
    <input type="number" class="form-control" name="productSaID" value= "<?php echo $row['idproduct_sale'] ?>" id="product-ID" placeholder="product ID" readonly>
  </div>
  <div class="form-group">
    <label for="product-ID">Product ID </label>
    <input type="number" class="form-control" name="productID" value= "<?php echo $row['product_id'] ?>" id="product-ID" placeholder="product ID" readonly>
  </div>
  <div class="form-group">
    <label for="ProSaQuantity">Sale Quantity</label>
    <input type="text" class="form-control" name ="EProSaQuantity" value ="<?php echo $row['quantity'] ?>" id="Stock-id" placeholder="Quantity">
  </div>
  <div class="form-group">
    <label for="SaleStartDate">Sale Start Date</label>
    <input type="date" class="form-control" name ="ESaleStartDate" value ="<?php echo $row['start_date'] ?>" id="Stock-id" placeholder="start date">
  </div>
  <div class="form-group">
    <label for="Sale End Date">Sale End Date</label>
    <input type="date" class="form-control" name ="ESaleEndDate" value ="<?php echo $row['end_date'] ?>" id="Stock-id" placeholder="End date">
  </div>

  <div>
      <input type = "submit" name= "EditProSa" value = "Update Product Sale" class="form-control">
  </div>
</form>
<?php     } }

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['EditProSa'])) {
    $proID = $_POST['productID'];
    $EProSaQuantity = $_POST['EProSaQuantity'];
    $ESaleStartDate = $_POST['ESaleStartDate'];
    $ESaleEndDate = $_POST['ESaleEndDate'];
    $ProSaID = $_POST['productSaID'];


    $formErrors = array();
    if(empty($proID)){
        $formErrors[]= 'Product ID cannot be empty';
    }
    if(empty($EProSaQuantity)){
        $formErrors[]= 'Quantity cannot be empty';
    }
    if(empty($ESaleStartDate)){
        $formErrors[]= 'Start Date cannot be empty';
    }
    if(empty($ESaleEndDate)){
        $formErrors[]= 'End Date cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("idproduct_sale" , "product_sale" , $ProSaID);
        if($check ==1){
            product_sale::update($ProSaID,$proID,$ESaleStartDate, $ESaleEndDate,$EProSaQuantity);
            $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
            redirectHome($themsg);

    }
}else{
    $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
    redirectHome($themsg);

    }
}



else{
    echo "Go away";
}
