<?php
ob_start();

function redirectHome($themsg,$url=NULL , $seconds = 3){
    if($url === NULL){
        $url = 'BookStore.php';
    }else{
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
               $url = $_SERVER['HTTP_REFERER'];
        }else{
            $url = 'BookStore.php';
        }
    }

    echo $themsg;
    echo "<div class = 'alert alert-info'>You will be redirected to $url after $seconds seconds</div>";
    header("refresh:$seconds;url=$url");
    exit();
}

function checkItem($select, $from, $value){
   include_once 'C:\xampp\htdocs\All_tables\connect.php';
   connect();

   $statement = $GLOBALS["conn" ] -> prepare("SELECT $select FROM $from WHERE $select= ?");
   $statement ->execute(array($value));

   $count = $statement->rowCount();

   return $count;
}
