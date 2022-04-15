<?php
// configuration
require_once 'auth.php';

include '../includes/db_connect.php';

// new data
$id = $_POST['memi'];
$a = $_POST['prod_name'];
$b = $_POST['desc'];
$c = $_POST['price'];
$d = $_POST['qty'];
$e = $_POST['o_price'];
$f = $_POST['profit'];
// query
$sql = "UPDATE products
        SET product_name=?, `description`=?, price=?,qty=?, o_price=?,profit=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($a, $b, $c, $d, $e, $f, $id));
header("location: products.php");