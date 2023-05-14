<?php 
    $dbname = 'mysql:host=localhost;dbname=admission-bcas';
    $dbuser = 'root';
    $dbpass = '';

    $conn = new PDO($dbname, $dbuser, $dbpass);

    if (!$conn){
        echo "Not Connected";
    } 
    // else {
    //     echo "Connected Successfully";
    // }
?>