<?php
require_once 'auth.php';

include '..includes/db_connect.php';
$id = $_GET['id'];
$result = $db->prepare("DELETE FROM customer WHERE customer_id= :memid");
$result->bindParam(':memid', $id);
$result->execute();
