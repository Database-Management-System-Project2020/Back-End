  <form class="Supplier-form" id="Supplier" method = "post">
    <div class="form-group" >
      <h5><i class="fas fa-pen"></i> Add New Supplier </h5>
    </div>
    <div class="form-group">
      <label for="Name">Name </label>
      <input type="text" name="suppName" class="form-control" placeholder="Name" >
    </div>
    <div class="form-group">
      <label for="Mobile_Number">Mobile Number </label>
      <input type="text" name ="suppPhone" class="form-control" placeholder="Mobile Number"id="Mobile_Number">
    </div>
    <div class="form-group">
      <label for="Address">Address </label>
      <input type="text" name="suppAdd" class="form-control" id="Address" placeholder="Address">
    </div>
    <div class="form-group">
      <label for="Deal">Deals </label>
      <input type="text" name = "suppDeal" class="form-control" id="Deal" placeholder="Deal">
    </div>
    <div class="form-group">
      <label for="Supp_date">Supplied Date </label>
      <input type="date" name="suppDate" class="form-control" id="Supp_date">
    </div>
    <div class="form-group">
      <label for="Deadline">Deadline </label>
      <input type="date" name="suppDeadline" class="form-control" id="Deadline">
    </div>
    <div class="form-group">
      <label for="Discount">Discount </label>
      <input type="number" name="suppDisc" class="form-control" placeholder="Discount"id="Discount">
    </div>
    <div class="form-group">
      <label for="Product">Product </label>
      <input type="text" name="suppProID" class="form-control" placeholder="Product" id="Product">
    </div>
    <div class="form-group">
      <label for="Amount">Supplier ID </label>
      <input type="text" name= "suppID" class="form-control" placeholder="Amount"id="Amount">
    </div>
    <div>
        <input type = "submit" name= "AddSupp" value = "AddSupp" class="form-control">
    </div>
    <div>
        <input type = "submit" name= "AddDeal" value = "AddDeal" class="form-control">
    </div>
  </form>
<?php
include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\supplier.php';
include_once 'C:\xampp\htdocs\All_tables\product_supplier_deal.php';


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddSupp'])){

    $suppName = $_POST['suppName'];
    $suppPhone = $_POST['suppPhone'];
    $suppAdd = $_POST['suppAdd'];
    $suppDeal = $_POST['suppDeal'];






    $formErrors = array();
    if(strlen($suppName)< 4){
        $formErrors[] = 'Username cannot be less than 4 characters';
    }

    if(strlen($suppName)> 25){
        $formErrors[] = 'Username cannot be more than 25 characters';
    }

    if(empty($suppName)){
        $formErrors[]= 'Username cannot be empty';
    }
    if(empty($suppPhone)){
        $formErrors[]= 'Phone cannot be empty';
    }
    if(empty($suppDeal)){
        $formErrors[]= 'Deal cannot be empty';
    }
    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg, 'back');
    }

    if(empty($formErrors)){
        $check = checkItem("name_s" , "supplier" , $suppName);
        if($check ==1){
            $themsg =  "<div class ='alert alert-success'>". 'sorry this name is taken</div>';
            redirectHome($themsg);
        }

        else{

            $inserted = new Supplier($suppName, $suppPhone,$suppAdd, $suppDeal );
            $themsg =  "<div class ='alert alert-success'>" . ' Record Inserted</div>';
            redirectHome($themsg, 'back');


    }
    }
}
elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddDeal'])){
    $suppDate = $_POST['suppDate'];
    $suppDeadline = $_POST['suppDeadline'];
    $suppDisc = $_POST['suppDisc'];
    $suppProID = $_POST['suppProID'];
    $suppID = $_POST['suppID'];
    $formErrors = array();


    $formErrors = array();
    if(empty($suppDisc)){
        $formErrors[]= 'Discount cannot be empty';
    }
    if(empty($suppProID)){
        $formErrors[]= 'Product ID cannot be empty';
    }
    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg, 'back');
    }

    if(empty($formErrors)){
        $check = checkItem("product_product_id" , "books" , $suppProID);
        $check_ = checkItem("product_product_id" , "tools" , $suppProID);
        if($check == 1 ){

            product_supplier_deal::insert_deal($suppProID, $suppID, $suppDate,$suppDeadline, $suppDisc);
            $themsg =  "<div class ='alert alert-success'>" . ' Record Inserted</div>';
            redirectHome($themsg, 'back');

        }elseif( $check_ == 1){

            product_supplier_deal::insert_deal($suppProID, $suppID, $suppDate,$suppDeadline, $suppDisc);
            $themsg =  "<div class ='alert alert-success'>" . ' Record Inserted</div>';
            redirectHome($themsg, 'back');



        }



            else{
                $themsg =  "<div class ='alert alert-danger'>". 'sorry this book/tool ID not found</div>';
                redirectHome($themsg, 'back');
    }
}

}else{
    echo "not Supp";
}


  ?>
