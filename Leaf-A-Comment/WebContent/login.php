<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $username = "";
    $password= "";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            
            $username = $_POST["username"];
            $password = $_POST["password"];
            
        }
    }
    
    $sql = "SELECT uid, username, password, enabled FROM users";
    
    $header="Location: main.php";
    
    if($result = $mysqli -> query($sql)){
        
        while($fieldinfo = $result -> fetch_assoc()){
            
            $a = $fieldinfo["username"];
            $b = $fieldinfo["password"];
            $c = $fieldinfo["uid"];
            $d = $fieldinfo["enabled"];
            if (strcasecmp($a, $username)==0 && strcasecmp($b, $password)==0){
                $_SESSION["loggedIn"] = true;
                $_SESSION["uid"] = $c;
                if ($d == 1)
                {
                    $_SESSION["enabled"] = true;
                }
                else
                {
                    $_SESSION["enabled"] = false;
                }
            }
        }
        $result -> free_result();   
        
        $sql = "SELECT * FROM  admins";
        if($result = $mysqli -> query($sql)) {
            
            while($fieldinfo = $result -> fetch_assoc()) {
                $d = $fieldinfo["uid"];
                if ($_SESSION["uid"] == $d){
                    $_SESSION["admin"] = true;
                }
            } $result -> free_result();
        }
    }
    
    if (!isset($_SESSION["loggedIn"]))
        $header = "Location: login.html?err='incorrect'";
        
    
    $mysqli -> close();
    
    header($header);
    

?>

</body>
</html>
