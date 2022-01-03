<?php
$host = "localhost";
	$user = "root";
	$password = "";
	$database = "test";
	$conn = mysqli_connect($host, $user, $password, $database);  

    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  ;
	




    if(isset($_POST["code"])) {

        echo $_POST["code"];
        #$remove = "DELETE FROM menu WHERE code='" . $_POST["code"] . "'";
        $add = "INSERT INTO menu (id,pname,food,code,price,pimage) VALUES (DEFAULT,'" . $_POST["pname"] . "', '". $_POST["food"] ."','". $_POST["code"] ."','". $_POST["PRICE"] ."','BLANK')";
        if (mysqli_query($conn, $add)) {
            echo "Record added successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }


    }
   
    header('location: /admin.php')
?>