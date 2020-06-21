<?php



   //WARNING: IN ORDER TO EXECUTE PHP FILES GO TO THE DESIGNED FOLDER BY YOUR SERVER
   // TO DO SO. USUALLY. C:/XAMPP/HTDOCS/
   // execute php files outside C:/XAMPP/HTDOCS/ and located in 
   //  http://localhost:8383/Helico/php/sendscore.php
   //  using the browser url:  
   //  http://localhost/PHPexec.php?f=C:\Roma\Nebeans_repsol\Helico\public_html\php\sendscore.php
   
   

include("connect.php");//contains all passwords.

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
     
 
 
 $conn->close();
 
 ?>