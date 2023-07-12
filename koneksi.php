<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ujianppkn";
 
return new PDO("mysql:host=$host;dbname=$database", $user, $password, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));