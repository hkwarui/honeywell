<?php
include 'auth.php';
include '../includes/db_connect.php';
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];
$d = $_POST['id_number'];

// query
$sql = "INSERT INTO customer (customer_name,`address`,contact,id_number) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d));
header("location: customer.php");
