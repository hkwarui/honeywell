<?php
include 'auth.php';
include '../includes/db_connect.php';

$id = $_GET['id'];
echo $id;
$result = $db->prepare("DELETE FROM supplier_details WHERE id= :memid");
$result->bindParam(':memid', $id);
$result->execute();
