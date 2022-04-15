<?php
require_once 'auth.php';

include '..includes/db_connect.php';
$id = $_GET['id'];
$result = $db->prepare("DELETE FROM purchases WHERE transaction_id= :memid");
$result->bindParam(':memid', $id);
$result->execute();
