<?php
require_once '../admin/auth.php';

include '../includes/db_connect.php';
$id = $_POST['id'];
$result = $db->prepare("DELETE FROM customer WHERE id_number= :memid");
$result->bindParam(':memid', $id);
if($result->execute()){
    echo 1;
    } else {
        echo 2;
    }

