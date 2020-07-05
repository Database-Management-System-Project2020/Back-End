<?php
  include "init.php";
?>

<?php 
  include "inc/logout.php";
?>

    <!-- navbar structure  -->
<!--     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="#">Product </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" link="Recurring" href="#">Recurring Profiles </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" link="customer" href="#">Customers </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" link="supplier" href="#">Suppliers </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" link="Order" href="#">Orders </a>
            </li>
        </ul>
        </div>
    </nav> -->

    <!-- add section structure -->
    <!-- Save & Returne -->
<?php
  include "inc/save_return.php";
?>


    <!-- add new recurring  -->
<?php
  include "inc/sections/edit/Edit_recurring.php";
?>

        
    <!-- add new customer structure -->
<?php
  include "inc/sections/edit/Edit_customer.php";
?>

    <!-- add new product structure  -->
<?php
  include "inc/sections/edit/Edit_product.php";
?>

    <!-- add new order structure  -->
<?php
  include "inc/sections/edit/Edit_order.php";
?>

    <!-- add new supplier structure  -->
<?php
  include "inc/sections/edit/Edit_supplier.php";
?>

<?php
  include "inc/htmlend.php";
?>