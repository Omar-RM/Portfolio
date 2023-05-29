<?php
/*
Create on 20/04/2023
Author: Omar Rico 

$dsn ='mysql:host=localhost;dname="" ;
$username = "";
$password ="";
*/

$dsn = "mysql:host=localhost;dbname=cafe";
$username ="root";
$password= "";
try{
    $db= new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
}catch(PDOException $ex){
    header("Location:../view/error.phph?msg".$ex->getMessage());
}