<?php

        include_once 'C:\xampp\htdocs\All_tables\connect.php';
        include_once 'C:\xampp\htdocs\All_tables\delete.php';
        include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';


?>
<?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['SuppID'])){
            $SuppID = $_POST['SuppID'];
            $rows = $rows = Supplier::get_Supplier_TableByID($SuppID);

            foreach ($rows as $row) { ?>

    <form class="Supplier-form" id="Supplier" method = "post">
        <div class="form-group" >
            <h5><i class="fas fa-pen"></i> Edit Supplier </h5>
        </div>
        <div class="form-group">
            <label for="s-name">ID </label>
            <input type="text" class="form-control" name ="SuppID" value= "<?php echo $row['idSupplier'] ?>" id="s-name" placeholder="Name" readonly>
        </div>
        <div class="form-group">
            <label for="s-name">Name </label>
            <input type="text" class="form-control" name ="name_s" value= "<?php echo $row['name_s'] ?>" id="s-name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="s-mobile">Mobile Number </label>
            <input type="text" class="form-control" name ="tele_s" value= "<?php echo $row['telephone_s'] ?>" id="s-mobile" placeholder="Mobile Number">
        </div>
        <div class="form-group">
            <label for="address">Address </label>
            <input type="text" class="form-control" name ="add_s" value= "<?php echo $row['address'] ?>" id="address" placeholder="Adress">
        </div>
        <div class="form-group">
            <label for="Deals">Deals </label>
            <input type="text" class="form-control" name ="deal_s" value= "<?php echo $row['deals'] ?>" id="Deals" placeholder="Deals">
        </div>
        <div class="form-group">
            <label for="Supplied-Date">Supplied Date </label>
            <input type="date" class="form-control" name ="sDate" value= "<?php echo $row['supplied date'] ?>" id="Supplied-Date" placeholder=<?php echo $row['supplied date'] ?>>
        </div>
        <div class="form-group">
            <label for="s-deadline">Deadline </label>
            <input type="date" class="form-control" name ="sEnd" value= "<?php echo $row['deadline'] ?>" id="s-deadline" placeholder="Deadline">
        </div>
        <div class="form-group">
            <label for="Discount">Discount</label>
            <input type="text" class="form-control" name ="sDiscount" value= "<?php echo $row['discount'] ?>" placeholder="Discount" id="Discount">
        </div>
        <div class="form-group">
            <label for="product"> Product </label>
            <input type="text" class="form-control" name ="ProID" value= "<?php echo $row['product_id'] ?>" id="product" placeholder="product">
        </div>
        <div class="form-group">
            <label for="Amount">Amount Available </label>
            <input type="number" class="form-control" name ="SuppAm" value= "<?php echo $row['amount_available'] ?>" id="Amount" placeholder="Amount" readonly>
        </div>
        <div>
            <input type = "submit" name= "EditSupp" value = "Update Supplier" class="form-control">
        </div>
    </form>

<?php  }}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['EditSupp'])) {

    $suppID = $_POST['SuppID'];
    $name_s = $_POST['name_s'];
    $tele_s = $_POST['tele_s'];
    $add_s = $_POST['add_s'];
    $deal_s = $_POST['deal_s'];
    $sDate = $_POST['sDate'];
    $sEnd = $_POST['sEnd'];
    $sDisc = $_POST['sDiscount'];
    $proId = $_POST['ProID'];

    $suppAm = $_POST['SuppAm'];


    $formErrors = array();

    if(empty($name_s)){
        $formErrors[]= 'Book ID cannot be empty';
    }if(empty($tele_s)){
        $formErrors[]= 'Stock ID cannot be empty';
    }if(empty($add_s)){
        $formErrors[]= 'Address cannot be empty';
    }if(empty($deal_s)){
        $formErrors[]= 'Deals cannot be empty';
    }if(empty($sDate)){
        $formErrors[]= 'Start date cannot be empty';
    }if(empty($sEnd)){
        $formErrors[]= 'End date cannot be empty';
    }if(empty($sDisc)){
        $formErrors[]= 'Discount cannot be empty';
    }if(empty($proId)){
        $formErrors[]= 'Product ID cannot be empty';
    }

    foreach($formErrors as $errors){
        $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
        redirectHome($themsg);
    }
    if(empty($formErrors)){
        $check = checkItem("idSupplier" , "Supplier" , $suppID);
        echo $check;
        if($check ==1){

                        Supplier::update($suppID,$name_s ,$tele_s ,$add_s,$deal_s);
                            $check = checkItem("product_id" , "product" , $proId);
                            if($check ==1){
                                product_supplier_deal::update($proId,$suppID ,$sDate ,$sEnd,$sDisc);
                            }else{
                                $themsg = "<div class ='alert alert-success'>".'  All updated Except Product ID, Please Add it first </div>';
                                redirectHome($themsg);

                            }


                         $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
                         redirectHome($themsg);

        }else{
            $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
            redirectHome($themsg);

        }





}


}else{
    echo "not here";
}
