<?php
// configuration
include 'auth.php';
include '../includes/db_connect.php';

// new data
$id = $_POST['memi'];
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];

// query
$sql = "UPDATE customer
        SET customer_name=?, address=?, contact=?
		WHERE id_number=?";
$q = $db->prepare($sql);
$q->execute(array($a, $b, $c, $id));
header("location: customer.php");
