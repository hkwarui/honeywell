<?php
// configuration
include 'auth.php';
include '../includes/db_connect.php';

// new data
$id = $_POST['memi'];
$a = $_POST['name'];
$b = $_POST['invoice_no'];
$c = $_POST['note'];
$d = $_POST['amount'];
$e = $_POST['expected_date'];

// query
$sql = "UPDATE credits
        SET customer_name =?, invoice_no=?, note=?, amount=?,expected_date = ?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a, $b, $c,$d,$e, $id));

header("location: credits.php");
