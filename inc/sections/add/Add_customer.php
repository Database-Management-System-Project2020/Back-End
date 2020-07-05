
  <form class="Customer-form" id="Customer" method = "POST">
    <div class="form-group" >
      <h5><i class="fas fa-pen"></i>Add New Customer </h5>
    </div>
    <div class="form-group">
      <label >Name</label>
      <input type="text" name= "CustName" class="form-control" placeholder="Name">
    </div>

    <div class="form-group">
      <label >Mobile Number</label>
      <input type="text" name= "CustPh" class="form-control" placeholder="Mobile Number">
    </div>
    <div>
        <input type = "submit" name= "AddCust" value = "AddCust" class="form-control">
    </div>
  </form>

 <?php


 include_once 'C:\xampp\htdocs\All_tables\connect.php';
 include_once 'C:\xampp\htdocs\All_tables\delete.php';
 include_once 'Add_functions.php';


 if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['AddCust'])) {

     $name = $_POST['CustName'];
     $phone = $_POST['CustPh'];


     $formErrors = array();
     if(strlen($name)< 4){
         $formErrors[] = 'Username cannot be less than 4 characters';
     }

     if(strlen($name)> 25){
         $formErrors[] = 'Username cannot be more than 25 characters';
     }

     if(empty($name)){
         $formErrors[]= 'Username cannot be empty';
     }
     if(empty($phone)){
         $formErrors[]= 'Phone cannot be empty';
     }

     foreach($formErrors as $errors){
         $themsg = '<div class = "alert alert-danger">' . $errors . '</div>';
         redirectHome($themsg, 'back');
     }

     if(empty($formErrors)){
         $check = checkItem("name_c" , "customer" , $name);
         if($check ==1){
             $themsg =  "<div class ='alert alert-success'>". 'sorry this name is taken</div>';
             redirectHome($themsg, 'back');
         }

         else{

             $inserted = new Customer($name, $phone);
             $themsg =  "<div class ='alert alert-success'>" . ' Record Inserted</div>';
             redirectHome($themsg, 'back');


}
}
}

else{
     echo "Not Working";

 }



   ?>
