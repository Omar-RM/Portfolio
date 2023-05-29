<?php
require 'database/connection.php';
require 'database/productQueries.php';


$action = filter_input(INPUT_POST,'action');
if($action == null){
    $action= filter_input(INPUT_GET, 'action');
    if($action==null){
        $action="home-page";
    }
}

switch($action){
    case 'home-page':
        include 'files/view/home.php';
        break;
    case 'login':
        session_destroy();
        include '../php/show_login.php';
    break;
    case'products':
        include '../php/products.php';
    break;    
    case 'addProduct':
        $product = filter_input(INPUT_POST, 'product-input');
        $productPrice = filter_input(INPUT_POST, 'product-price');
        $productDescription = filter_input(INPUT_POST, 'product-description');
        if(add_product($product, $productPrice, $productDescription)){
            header("Location:?action=products");
        }else{
            header("Location:?action=products");
        }
    break;
    case 'hotBeverage':
        include '../php/POS/hotBeverage';
    break; 
    case 'coldBeverage':
        include '../php/POS/hotBeverage';
    break; 
    case 'deserts':
        include '../php/POS/hotBeverage';
    break; 
    case 'snacks':
        include '../php/POS/hotBeverage';
    break; 
     
}

?>