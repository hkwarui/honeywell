<?php
include 'auth.php';
include '../includes/db_connect.php';
$a = $_POST['id_number'];
$b = $_POST['product_name'];
$c = $_POST['note'];
$d = $_POST['amount'];
$e = $_POST['expected_date'];
$f = $_POST['name'];

// query
$sql = "INSERT INTO credits (id_number, product_name,note , amount, expected_date, customer_name) VALUES (:a,:b,:c,:d,:e,:f)";
$q = $db->prepare($sql);
$q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' =>$e, ':f' =>$f));
header("location: credits.php");
