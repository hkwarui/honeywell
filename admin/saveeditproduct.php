<?php
    include 'auth.php';
    include '../includes/db_connect.php';

    // posted data
    $id = $_POST['memi'];
    $a = $_POST['product_name'];
    $b = $_POST['price'];
    $c = $_POST['o_price'];
    $d = $_POST['profit'];
    $e = $_POST['qty'];
    $f = $_POST['desc'];

    // sql query
    $sql = "UPDATE products
            SET product_name=?, price=?, o_price=?, profit=?, qty=?, `description`=?
            WHERE product_id=?";
    $q = $db->prepare($sql);
    $q->execute(array($a, $b, $c,$d,$e,$f, $id));

    header("location: products.php");
?>