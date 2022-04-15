<?php
require_once '../admin/auth.php';
require_once '../includes/db_connect.php';

$a = $_POST['invoice'];
$b = (int)$_POST['cash'];
$c = (int)$_POST['amount'];
$d = $b - $c;

echo $a;
echo $d;
// query
$sql = "UPDATE credits
        SET amount = ?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($d, $a));
header("location: preview.php?invoice=$a");

?>