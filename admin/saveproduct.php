<?php
require_once 'auth.php';

include '../includes/db_connect.php';
$a = $_POST['prod_name'];
$b = $_POST['desc'];
$d = $_POST['price'];
$f = $_POST['qty'];
$g = $_POST['o_price'];
$h = $_POST['profit'];

// query
$sql = "INSERT INTO products (product_name, `description`, price, qty, o_price, profit) VALUES (:a,:b,:d,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a' => $a, ':b' => $b, ':d' => $d,':f' => $f, ':g' => $g, ':h' => $h));
header("location: products.php");