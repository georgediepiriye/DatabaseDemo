<?php
session_start();
require 'config.inc.php';
   
   $message = '';
    
     if(isset($_POST['name']) && isset($_POST['password'])){                    #if log in button is clicked
        $db = new mysqli(MY_HOST,MY_USER,MY_PASSWORD,MY_DATABASE,MY_PORT);      #create database connection
        $sql = sprintf("select * from users where username='%s'",               #query database to get value of hash of user
             $db->real_escape_string($_POST['name']));
        $result = $db->query($sql);                                             
        $row = $result->fetch_object();                                         #get the entire row object and save in a variable
        if($row != null){
            $hash = $row->hash;
            if(password_verify($_POST["password"], $hash)){                      #verify password sent by user against the goten hash
                $message = "login successful!";
                $_SESSION['username']=$row->username;
                $_SESSION['isAdmin']=$row->isAdmin;
                
                header('Location:home.php');
            }else{
               

                $message = 'Login failed';
            
            }
        }else{
            $message = 'Login failed!';
        }
        $db->close();

    }


?>

<form method="post">
   
   Username: <input type="text" name="name"><br><br>
   Password: <input type="password" name="password"><br><br>
   <input type="submit" name="submit" value="Login">

</form>
<?php 
    echo $message;
    

?>