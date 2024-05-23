<?php
$host="localhost";
$dbname="ministere";
//$port=5433;
$user="root";
$pwd="root";
try {
    //code...
    //$db=pg_connect('host=$host dbname=$dbname, $user, $pwd');
    $db=new PDO("mysql:host=$host; dbname=$dbname", $user,$pwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    
} catch (PDOException $th) {
    echo "Error:".$th->getMessage();
}
    //$host = 'localhost';
    //$username = 'root';
    //$password = 'root';
    //$dbname='flutterDB';
    //
    //$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    
    
