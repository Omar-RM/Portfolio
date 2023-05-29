<?php
function add_product($product, $productPrice, $productDescription)
{
    global $db;
    $query = "INSERT INTO product(productName, price, description) VALUES (:p, :pp, pD)";
    $st = $db->prepare($query);
    $st->bindValue('p', $product);
    $st->bindValue('pP', $productPrice);
    $st->bindValue('pD', $productDescription);
    try {
        $st->execute();
    } catch (PDOException $e) {
        header("Location:../view/error.php?msg" . $e->getMessage());
    }
    $st->closeCursor();
    return true;
}

function show_all_product()
{
    global $db;
    $query = "SELECT * FROM product";
    $st = $db->prepare($query);
    try {
        $st->execute();
    } catch (PDOException $e) {
        header("Location:../view/error.php?msg" . $e->getMessage());
    }
    $products = $st->fetchAll();
    $st->closeCursor();
    return $products;
}

function show_all_productos_by_categoria($categoria){
    global $db;
    $query ="SELECT * FROM product WHERE category = :category";
    
    $st= $db->prepare($query);
    $st->bindValue(':category', $categoria);
    try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php".$e->getMessage());
    }
    $products=$st->fetchAll();
    $st->closeCursor();
    return $products;
}

function add_orders_track($date, $employee){
    global $db;
    $query ="INSERT INTO orderstrack(date, staff) VALUES (:date, :employee)";
    $st = $db->prepare($query);
    $st->bindValue(':date', $date);
    $st->bindValue(':employee', $employee);
        try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php?msg".$e->getMessage());
    }
    $st->closeCursor();
    return true;
}

function return_max_id(){
    global $db;
    $query ="SELECT id FROM orderstrack WHERE id = (SELECT MAX(id) FROM orderstrack)";
    $st = $db->prepare($query);
    try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php?msg".$e->getMessage());
    }
    $id=$st->fetch();
    $st->closeCursor();
    return $id['id'];
}
function add_to_order_list($id,$product, $price, $date){
    global $db;
    $query ="INSERT INTO orderlist(orderid,product, price, date) VALUES (:id, :product, :price, :date)";
    $st = $db->prepare($query);
    $st->bindValue(':id', $id);
    $st->bindValue(':product', $product);
    $st->bindValue(':price', $price);
    $st->bindValue(':date', $date);
        try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php?msg".$e->getMessage());
    }
    $st->closeCursor();
    return true;
}
//Display the orderList table using date
function show_order_by_date($date){
    global $db;
    $query ="SELECT * FROM orderlist WHERE date = :date";
    
    $st= $db->prepare($query);
    $st->bindValue(':date', $date);
    try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php".$e->getMessage());
    }
    $products=$st->fetchAll();
    $st->closeCursor();
    return $products;
}
//Return the orderList table.
function show_order_by_id($id){
    global $db;
    $query ="SELECT * FROM orderlist WHERE orderid = :id" ;
    $st= $db->prepare($query);
    $st->bindValue(':id', $id);

    try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php".$e->getMessage());
    }
    $products=$st->fetchAll();
    $st->closeCursor();
    return $products;
}
// Return the ordersTrack table
function show_order_ids(){
    global $db;
    $query ="SELECT * FROM orderstrack" ;
    
    $st= $db->prepare($query);
    try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php".$e->getMessage());
    }
    $products=$st->fetchAll();
    $st->closeCursor();
    return $products;
}
// Takes id to search in db[orderList] then sum and return the total of the order with that id.
function return_total_by_id($id){
    global $db;
    $query = "SELECT sum(price) as total FROM orderlist WHERE orderId = :id";
    $st = $db->prepare($query);
    $st->bindValue(':id', $id);
    try{
        $st->execute();
    }catch(PDOException $e){
        header("Location:../php/error.php".$e->getMessage());
    }
    $totalPrice = $st->fetch();
    $st->closeCursor();
    return $totalPrice['total'];
}