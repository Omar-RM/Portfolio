<?php
include '../php/header.php';
?>
 <section id="POS">
 <?php include '../php/POS/POSmenu.php'?>
    <div id="POS-prod">
    <?php
    $allProductos = showAllProductosByCategoria('caliente');
    foreach($allProductos as $product){
        echo"";
        echo ' <div class="box-item">
        <div class="box-item-name">'.$product['productName'].'</div>
        <div class="box-item-price"><span>&dollar;</span>'.$product['price'].'</div>
        <button class="add-to-sumary">ADD</button>
    </div>';     
    }
    ?>
    </div>
</section>
<?php include '../php/asideTotalVenta.php';?>
<?php
include '../php/footer.php';
?>