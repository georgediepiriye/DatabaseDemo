<?php
require 'auth.inc.php';
require 'config.inc.php';
   if(isset($_GET['id']) && ctype_digit($_GET['id'])){ //checks if id is present and id is a digit
        $id = $_GET['id'];
   }else{
       header('Location:home.php');
   }


        $db = new mysqli(MY_HOST,MY_USER,MY_PASSWORD,MY_DATABASE,MY_PORT);
        $sql = "delete from users where id=$id";
        $db->query($sql);
        echo "User Deleted!";
        $db->close();
   
?>