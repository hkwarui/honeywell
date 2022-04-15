<?php
include '../admin/auth.php';

include '../includes/db_connect.php';
$date = date('Y-m-d', strtotime($_POST['delivery_date']));
$a = $_POST['sup_id'];
$b = $_POST['amount'];
$c = $_POST['status'];
$d = $_POST['note'];
$e = $date;
$f = $_POST['sup_name'];


// query
$sql = "INSERT INTO supplier_details (supplier_id, amount, `status`, note, delivery_date) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e));

header("location: viewsupplier.php?id=$a&name=$f");
