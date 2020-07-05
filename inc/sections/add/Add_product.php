<?php
@session_start();
?>

<?php if(@$_SESSION['EmpType']==1 or @$_SESSION['EmpType']==2){ ?>
  <form enctype="multipart/form-data" class="Products-form" id="Products" method="POST">
    <div class="form-group" >
      <h5><i class="fas fa-pen"></i> Add New Product </h5>
    </div>
    <div class="form-group">
      <label for="Type">Tool Type </label>
      <input type="text" class="form-control" name="toolType" id="Tool_type" placeholder="Tool Type">
    </div>
    <div class="form-group">
      <label for="Brand_Name">Brand Name </label>
      <input type="text" class="form-control" name= "BrandName" id="Brand_Name" placeholder="Brand Name">
    </div>
    <div class="form-group">
      <label for="Parts">Parts </label>
      <input type="text" class="form-control" name="Parts" id="Parts" placeholder="Parts">
    </div>
    <div class="form-group" >
      <label for="Image">Select Image</label>
      <input type="file" class="form-control-file" name="ImageUpload" id="Image">
    </div>
    <div class="form-group">
      <label for="Stage">Educational Stage </label>
      <input type="text" class="form-control" name="Stage" id="Stage" placeholder="Educational Stage">
    </div>
    <div class="form-group">
      <label for="Subject">Subject </label>
      <input type="text" class="form-control" name="Subject" id="Subject" placeholder="Subject">
    </div>

    <div class="form-group">
      <label for="price">Price </label>
      <input type="text" class="form-control" name= "price" id="price" placeholder="Price L.E">
    </div>
    <div class="form-group">
      <label for="Barcode">Barcode </label>
      <input type="text" class="form-control" name="Barcode" id="Barcode" placeholder="Barcode">
    </div>
    <div class="form-group">
      <label for="available_amount">Availanle Amount</label>
      <input type="text" class="form-control" name="availableAmount" id="available_amount" placeholder="Amount">
    </div>
    <div class="form-group">
      <label for="Description">Description</label>
      <textarea class="form-control" name= "descriptionPro" id="tool-description">Enter text here...</textarea>
    </div>
    <div class="form-group">
      <label for="Stock_amount">Stock Amount</label>
      <input type="text" class="form-control" name ="StockAmount" id="Stock-amount" placeholder="Amount">
    </div>
    <div class="form-group">
      <label for="StockID">Stock Number</label>
      <input type="text" class="form-control" name ="StockID" id="Stock-id" placeholder="ID">
    </div>
    <div class="form-group">
      <label for="product-ID">Product ID </label>
      <input type="number" class="form-control" name="productID" id="product-ID" placeholder="product ID">
    </div>
    <div class="form-group">
      <label for="ProSaQuantity">Sale Quantity</label>
      <input type="text" class="form-control" name ="ProSaQuantity" id="Stock-id" placeholder="Quantity">
    </div>
    <div class="form-group">
      <label for="SaleStartDate">Sale Start Date</label>
      <input type="date" class="form-control" name ="SaleStartDate" id="Stock-id" placeholder="start date">
    </div>
    <div class="form-group">
      <label for="Sale End Date">Sale End Date</label>
      <input type="date" class="form-control" name ="SaleEndDate" id="Stock-id" placeholder="End date">
    </div>

    <div>
        <input type = "submit" name= "AddBook" value = "AddBook" class="form-control">
    </div>
    <div>
        <input type = "submit" name= "AddTool" value = "AddTool" class="form-control">
    </div>
    <div>
        <input type = "submit" name= "AddStock" value = "AddStock" class="form-control">
    </div>
    <div>
        <input type = "submit" name= "AddProSa" value = "Add Product Sale" class="form-control">
    </div>
  </form>

<?php

include_once "Add_functions.php";
include_once 'C:\xampp\htdocs\All_tables\connect.php';
// include_once 'C:\xampp\htdocs\All_tables\testProduct.php';
// include_once 'C:\xampp\htdocs\All_tables\books.php';
// include_once 'C:\xampp\htdocs\All_tables\toolsTest.php';
// include_once 'C:\xampp\htdocs\All_tables\employee.php';
// include_once 'C:\xampp\htdocs\All_tables\stock.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php';


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddBook'])) {

    $BrandName = $_POST['BrandName'];
    $parts = $_POST['Parts'];
    $educational_stage = $_POST['Stage'];
    $Subject = $_POST['Subject'];
    $productID = $_POST['productID'];
    $price = $_POST['price'];
    $Barcode = $_POST['Barcode'];
    $available_amount = $_POST['availableAmount'];
    $descriptionPro = $_POST['descriptionPro'];
    $StockAmount = $_POST['StockAmount'];
    $stockID = $_POST['StockID'];
    $employee_Id = $_SESSION['ID'];
    $filename = $_FILES["ImageUpload"]["name"];
    $tempname = $_FILES["ImageUpload"]["tmp_name"];
    $folder = "../images/".basename($filename);





    $formErrors = array();
    if(strlen($educational_stage)< 1){
        $formErrors[] = 'Stage cannot be less than 1 characters';
    }

    if(strlen($educational_stage)> 9){
        $formErrors[] = 'Stage cannot be more than 9 characters';
    }
    if(strlen($BrandName)< 1){
        $formErrors[] = 'Brand Name cannot be less than 1 characters';
    }

    if(strlen($BrandName)> 9){
        $formErrors[] = 'Brand Name cannot be more than 9 characters';
    }
    if(strlen($Subject)< 2){
        $formErrors[] = 'subject cannot be less than 1 characters';
    }

    if(strlen($Subject)> 43){
        $formErrors[] = 'subject cannot be more than 9 characters';
    }

    if(strlen($Barcode)< 4){
        $formErrors[] = 'Barcode cannot be less than 4 characters';
    }

    if(strlen($Barcode)> 14){
        $formErrors[] = 'Barcode cannot be more than 14 characters';
    }


    if(empty($BrandName)){
        $formErrors[]= 'Brandname cannot be empty';
    }
    if(empty($parts)){
        $formErrors[]= 'parts cannot be empty';
    }
    if(empty($educational_stage)){
        $formErrors[]= 'Educational stage cannot be empty';
    }
    if(empty($Subject)){
        $formErrors[]= 'Subject cannot be empty';
    }

    if(empty($price)){
        $formErrors[]= 'price cannot be empty';
    }
    if(empty($Barcode)){
        $formErrors[]= 'barcode cannot be empty';
    }
    if(empty($available_amount)){
        $formErrors[]= 'available amount cannot be empty';
    }
    if(empty($descriptionPro)){
        $formErrors[]= 'Descritption cannot be empty';
    }
    if(empty($StockAmount)){
        $formErrors[]= 'stock amount cannot be empty';
    }
    if(empty($stockID)){
        $formErrors[]= 'stock number cannot be empty';
    }


    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg, 'back');
    }

    if(empty($formErrors)){
        $check = checkItem("product_product_id" , "books" , $productID);
        $check_ = checkItem("product_barcode" , "product" , $Barcode);
        if($check ==1){
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this BookID is taken</div>';
            redirectHome($themsg, 'back');
        }elseif($check_ == 1){
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this barcode is taken</div>';
            redirectHome($themsg, 'back');

        }

        else{
            $check = checkItem("idstock" , "stock" , $stockID);
            if ($check ==1){

            Product::set_employee_ID($employee_Id);
            Images::set_employee_ID($employee_Id);

            $insrtedProduct = new product($Barcode, $price,$descriptionPro, $available_amount,$stockID);
            $GLOBALS["id_emp"] = $employee_Id;
            $insertedBook = new Books($BrandName,$parts ,$educational_stage, $Subject);
            Images::insert_image($filename);

            $themsg =  "<div class ='alert alert-success'>" . ' Book Record Inserted</div>';
            redirectHome($themsg, 'back');}
            else{
                stock::setquantity($StockAmount);
                Product::set_employee_ID($employee_Id);
                Images::set_employee_ID($employee_Id);
                $insrtedProduct = new product($Barcode, $price,$descriptionPro, $available_amount,$stockID);
                $GLOBALS["id_emp"] = $employee_Id;
                $insertedBook = new Books($BrandName,$parts ,$educational_stage, $Subject);
                Images::insert_image($filename);

                $themsg =  "<div class ='alert alert-success'>" . ' Book Record Inserted</div>';
                redirectHome($themsg, 'back');
            }


}
}
}elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddTool'])) {

    $productID = $_POST['productID'];
    $toolType = $_POST['toolType'];
    $price = $_POST['price'];
    $Barcode = $_POST['Barcode'];
    $available_amount = $_POST['availableAmount'];
    $descriptionPro = $_POST['descriptionPro'];
    $StockAmount = $_POST['StockAmount'];
    $stockID = $_POST['StockID'];
    $filename = $_FILES["ImageUpload"]["name"];
    $tempname = $_FILES["ImageUpload"]["tmp_name"];
    $folder = "../images/".basename($filename);

    print_r($_POST);
    $employee_Id = $_SESSION['ID'];



    $formErrors = array();
    if(strlen($Barcode)< 3){
        $formErrors[] = 'Barcode cannot be less than 4 characters';
    }

    if(strlen($Barcode)> 14){
        $formErrors[] = 'Barcode cannot be more than 25 characters';
    }

    if(empty($toolType)){
        $formErrors[]= 'Tool Type cannot be empty';
    }

    if(empty($price)){
        $formErrors[]= 'price cannot be empty';
    }
    if(empty($Barcode)){
        $formErrors[]= 'barcode cannot be empty';
    }
    if(empty($available_amount)){
        $formErrors[]= 'available amount cannot be empty';
    }
    if(empty($descriptionPro)){
        $formErrors[]= 'Descritption cannot be empty';
    }
    if(empty($StockAmount)){
        $formErrors[]= 'stock amount cannot be empty';
    }
    if(empty($stockID)){
        $formErrors[]= 'stock number cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg, 'back');
    }

    if(empty($formErrors)){
        $check = checkItem("product_product_id" , "tools" , $productID);
        $check_ = checkItem("product_barcode" , "product" , $Barcode);
        if($check ==1){
            $themsg =  "<div class ='alert alert-success'>". 'sorry this BookID is taken</div>';
            redirectHome($themsg, 'back');
        }elseif($check_ == 1){
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this barcode is taken</div>';
            redirectHome($themsg, 'back');

        }

        else{
            $check = checkItem("idstock" , "stock" , $stockID);
            if ($check ==1){


            Product::set_employee_ID($employee_Id);
            $insrtedProduct = new product($Barcode, $price,$descriptionPro, $available_amount,$stockID);
            $GLOBALS["id_emp"] = $employee_Id;
            $insertedTool = new Tools($toolType);
            Images::set_employee_ID($employee_Id);
            Images::insert_image($filename);
            $themsg =  "<div class ='alert alert-success'>" . ' Tool Record Inserted</div>';
            redirectHome($themsg, 'back');
        }
            else{
                stock::setquantity($StockAmount);
                Product::set_employee_ID($employee_Id);
                $insrtedProduct = new product($Barcode, $price,$descriptionPro, $available_amount,$stockID);
                $GLOBALS["id_emp"] = $employee_Id;
                $insertedTool = new Tools($toolType);
                Images::set_employee_ID($employee_Id);
                Images::insert_image($filename);
                $themsg =  "<div class ='alert alert-success'>" . ' Tool Record Inserted</div>';
                redirectHome($themsg, 'back');

            }


}
}
}elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddStock'])){
    $StockAmount = $_POST['StockAmount'];
    $formErrors = array();
    if(empty($StockAmount)){
        $formErrors[]= 'stock amount cannot be empty';
    }foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg, 'back');
    }if(empty($formErrors)){
    stock::setquantity($StockAmount);

    $themsg =  "<div class ='alert alert-success'>" . ' Stock Record Inserted</div>';
    redirectHome($themsg, 'back');
}

}elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddProSa'])){
     $ProSaQuantity = $_POST['ProSaQuantity'];
     $SaleStartDate = $_POST['SaleStartDate'];
     $SaleEndDate = $_POST['SaleEndDate'];
     $productID = $_POST['productID'];

     $formErrors = array();

     if(empty($ProSaQuantity)){
         $formErrors[]= 'Sale Quantity cannot be empty';
     }
     if(empty($productID)){
         $formErrors[]= 'ProductID cannot be empty';
     }
     if(empty($SaleStartDate)){
         $formErrors[]= 'Sale Start Date cannot be empty';
     }
     if(empty($SaleEndDate)){
         $formErrors[]= 'Sale End Date cannot be empty';
     }
     foreach($formErrors as $errors){
         $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
         redirectHome($themsg, 'back');
     }if(empty($formErrors)){




    product_sale::insert_sale($productID,$SaleStartDate, $SaleEndDate,$ProSaQuantity);
    $themsg =  "<div class ='alert alert-success'>" . ' Sale Record Inserted</div>';
    redirectHome($themsg, 'back');
}
}

else{
    echo "Not Working";

}
}else{
    $themsg =  "<div class ='alert alert-danger'>" . 'You can not Add!</div>';
    redirectHome($themsg, 'back');
}
