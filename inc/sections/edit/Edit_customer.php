

        <?php
        include_once 'C:\xampp\htdocs\All_tables\connect.php';
        include_once 'C:\xampp\htdocs\All_tables\delete.php';
        include_once 'C:\xampp\htdocs\StationeryStoreSys\inc\sections\add\Add_functions.php';
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['CustomerID'])){
        $CustID = $_POST['CustomerID'];
        $rows = Customer::getCustInfoByID($CustID);
        foreach ($rows as $row) { ?>
            <form class="Customer-form" id="Customer" method = "post">
                <div class="form-group" >
                <h5><i class="fas fa-pen"></i>Edit Customer </h5>
                </div>
                <div class="form-group">
                    <label for="c-name">Name</label>
                    <input type="text" class="form-control" name = 'name_c' value =' <?php echo $row['name_c'] ?>' id="c-name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="c-id">ID</label>
                    <input type="number" class="form-control" name = 'idcustomer' value =' <?php echo $row['idcustomer']  ?>' id="c-id" placeholder=" <?php echo $row['idcustomer']  ?>" required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="form-control" name = 'tele_c' value =' <?php echo $row['telephone_c'] ?>' id="mobile" placeholder="Mobile Number">
                </div>
                <div>
                    <input type = "submit" name= "Update_c" value = "UpdateCust" class="form-control">
                </div>
            </form>

    <?php     } }

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Update_c'])) {

        $name_c = $_POST['name_c'];
        $tele_c = $_POST['tele_c'];
        $custID = $_POST['idcustomer'];

        $formErrors = array();
        if(strlen($name_c)< 4){
            $formErrors[] = 'Username cannot be less than 4 characters';
        }

        if(strlen($name_c)> 25){
            $formErrors[] = 'Username cannot be more than 25 characters';
        }

        if(empty($custID)){
            $formErrors[]= 'ID cannot be empty';
        }

        foreach($formErrors as $errors){
            $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
            redirectHome($themsg);
        }
        if(empty($formErrors)){
            $check = checkItem("idcustomer" , "customer" , $custID);
            if($check ==1){

                            Customer::update_nameCustomer($custID,$name_c);
                            Customer::update_telephoneCustomer($custID,$tele_c);

                            $themsg = "<div class ='alert alert-success'>".'  Record Updated</div>';
                            redirectHome($themsg);

            }else{
                $themsg =  "<div class ='alert alert-danger'>". 'sorry this ID Not found</div>';
                redirectHome($themsg);

            }





    }
}else{
        echo "Go away from here";
    }




         ?>
