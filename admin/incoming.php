<?php
require_once 'auth.php';

include '../includes/db_connect.php';
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$date = date("Y-m-d", strtotime($_POST['date']));
$discount = $_POST['discount'];
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $asasa = $row['price'];
    $code = $row['product_name'];
    $p = $row['profit'];
    $desc = $row['description'];
}

//edit qty
$sql = "UPDATE products
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c, $b));
$fffffff = (int) $asasa - (int) $discount;
$d = $fffffff * $c;
$profit = $p * $c;
// query
$sql = "INSERT INTO sales_order (invoice,product,qty,amount,`description`,price,profit,product_name,`date`) VALUES (:a,:b,:c,:d,:j,:f,:h,:i,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':f' => $asasa, ':h' => $profit, ':i' => $code,  ':k' => $date, ':j'=> $desc));
header("location: sales.php?id=$w&invoice=$a");