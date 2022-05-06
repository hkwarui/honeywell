<?php
include 'auth.php';
include '../includes/db_connect.php';

// new data
$id = $_POST['memi'];
$supplier_id= $_POST['supplier_id'];
$a = $_POST['status'];
$b = $_POST['note'];

// query
$result = $db->prepare("SELECT suplier_name FROM supliers WHERE suplier_id = :userid");
$result->bindParam(':userid', $supplier_id);
$result->execute();
$name = $result->fetchColumn();

$sql = "UPDATE supplier_details
        SET status=?, note=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a, $b, $id));
header("location:viewsupplier.php?id=".$supplier_id."&name=".$name);
