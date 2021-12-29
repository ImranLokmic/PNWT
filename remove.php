<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "test";
	$conn = mysqli_connect($host, $user, $password, $database);  

    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  ;
	

    if(isset($_GET["code"])) {

        echo $_GET["code"];
        $remove = "DELETE FROM menu WHERE code='" . $_GET["code"] . "'";
        if (mysqli_query($conn, $remove)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }


    }
    header('location: /admin.php')

?>