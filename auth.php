<?php

include('dbcontroller.php');  


    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' and pw = '$password'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result); 
    
    if($count == 1){  
        if($row['auth']==1)
        header("Location: admin.php");  
        if($row['auth']==0)
        header("Location: user.php");  
    }  
    else{  
        header("Location: index.html");  
    }     
    
?>