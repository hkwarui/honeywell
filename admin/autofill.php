<?php
require_once 'auth.php';

include '../includes/db_connect.php';

$info = $_POST['info'];
$result = $db->prepare("SELECT customer_name FROM customer WHERE id_number= :info");
$result->bindParam(':info', $info);
if($result->execute()){
    echo "succcesful";
    json_encode($result);
    } else {
        echo "could't fetch data ";
    }

