
<?php

require 'config.inc.php';

    $name = '';
    $password = '';
    $gender = '';
    $color =  '';



 if(isset($_POST["submit"])){
     $ok = true;

    if(!isset($_POST['name']) || $_POST['name'] ===''){
        $ok = false;    
    }else{
        $name = $_POST['name'];
    }


    if(!isset($_POST['password']) || $_POST['password'] ==='' ){
        $ok = false;     
    }else{
        $password = $_POST['password'];
    }


    if(!isset($_POST['gender']) || $_POST['gender'] ==='' ){
        $ok=false;       
    }else{
        $gender = $_POST['gender'];
    }


    if(!isset($_POST['color']) || $_POST['color'] ===''){
        $ok = false;
    }else{
        $color = $_POST['color'];
    }


  
    if($ok){
        $hash = password_hash($password,PASSWORD_DEFAULT); #hash the passport
        $db = new mysqli(MY_HOST,MY_USER,MY_PASSWORD,MY_DATABASE,MY_PORT);
        $sql = sprintf("insert into users (username,hash,gender,color) values('%s','%s','%s','%s')",
                    $db->real_escape_string( htmlspecialchars($name,ENT_QUOTES)),
                    $db->real_escape_string($hash),
                    $db->real_escape_string(htmlspecialchars($gender,ENT_QUOTES)),
                    $db->real_escape_string(htmlspecialchars($color,ENT_QUOTES)));
        $db->query($sql);
        $db->close();
        header("Location:home.php");
    }


 }
 

?>
<form method="post">
  Username: <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES);?>"><br>
  Password: <input type="password" name="password"><br>
  Gender : 
        <input type="radio" name="gender" value="male"<?php 
            if($gender==='male'){
                echo " checked";
            }
        ?>> male
        <input type="radio" name="gender" value="female"<?php 
            if($gender==='female'){
                echo " checked";
            }
        ?>> female<br>

  Select Colour:
   <select name="color">
   <option value="">Select color</option>
        <option value="red"<?php 
            if($color === "red"){
                echo " selected";
            }?>>Red</option>
        <option value="green" <?php 
            if($color === "green"){
                echo " selected";
            }?>>Green</option>
        <option value="blue"<?php 
            if($color === "blue"){
                echo " selected";
            }?>>Blue</option>
  </select><br>

  <input type="submit" name="submit" value="Register">
</form>

