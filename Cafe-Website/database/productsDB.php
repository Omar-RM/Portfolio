<?php
function add_product($product, $productPrice, $productDescription){
global $db;
$query= "INSERT INTO product(productName, price, description) VALUES (:p, :pp, pD)";
$st = $db->prepare($query);
$st->bindValue('p', $product);
$st->bindValue('pP', $productPrice);
$st->bindValue('pD', $productDescription);
try{
    $st->execute();
}catch(PDOException $e){
    header("Location:../view/error.php?msg".$e->getMessage());
}
$st->closeCursor();
return true;
}