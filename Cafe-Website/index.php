<?php
require '../database/database.php';
require '../database/productsDB.php';

$action = filter_input(INPUT_POST,'action');
if($action == null){
    $action= filter_input(INPUT_GET, 'action');
    if($action==null){
        $action="home-page";
    }
    
}

?>