<?php
  include "init.php";
?>

<?php
  include "inc/logout.php";
?>

<?php session_start();
if(isset($_SESSION['Email'])){
     ?>

  <!-- navbar structure  -->
<!-- head and header opening tag -->
<?php
  include "inc/nav.php";
?>
  <!-- Section container tables Structure  -->
<?php
  include "inc/filter.php";
?>
  <!-- recurring table -->
<?php
  include "inc/sections/home/recurring.php";
?>
  <!-- Customer table Structure  -->
<?php
  include "inc/sections/home/customer.php";
?>
  <!-- Suppliers table Structure  -->
<?php
  include "inc/sections/home/supplier.php";
?>
  <!-- products table -->
<?php
  include "inc/sections/home/product.php";
?>

  <!-- order table  -->
<?php
  include "inc/sections/home/order.php";
?>
<?php }else{
    header('Location: login.php');
} ?>
  <!-- script & [body,html]closed tag -->
<?php
  include "inc/htmlend.php";
?>
