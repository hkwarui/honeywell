<?php
require_once 'auth.php';

include '../includes/db_connect.php';
$id = $_POST['id'];
$result = $db->prepare("DELETE FROM products WHERE product_id= :memid");
$result->bindParam(':memid', $id);
if($result->execute())
{
    echo 1;
} else
echo 2;
