
<?php
session_start();
include_once 'C:\xampp\htdocs\All_tables\connect.php';
include_once 'C:\xampp\htdocs\All_tables\delete.php';
if(isset($_SESSION['Email'])){
    header('Location: BookStore.php');

}

$rowss = employee::get_Employee_Table();
//include $language ."arabic.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['email'];
    $password = $_POST['password'];
    $hashedpass = sha1($password);


    $stmt = $conn ->prepare("SELECT idemployee, employeeEmail, password FROM newpro.employee WHERE employeeEmail=? AND password = ? LIMIT 1");
    $stmt -> execute(array($username, $hashedpass));
    $row = $stmt ->fetch();
    $count = $stmt ->rowCount();



    if($count >0){
        $_SESSION['Email'] = $username;
        $_SESSION['ID'] = $row['idemployee'];
        $_SESSION['EmpType'] = employee::get_type_of_employee($_SESSION['ID']);
         header('Location: BookStore.php');
         exit();

    }else{
        echo "not found";
    }



}
?>



</header>

<form style="
margin: auto;
width: 50%;
background-color: white;
padding: 2rem;
margin-top: 2rem;
font-weight: bold;
border-radius: 2px;"

data-aos="fade-down" data-aos-duration="500" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" >
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  <button style="
  background-color: var(--main-color);
  color: white;
  font-weight: bold;
  margin-top: 1rem;"
 type="submit" class="btn">Login</button>
</form>
