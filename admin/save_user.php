<?php
include '../admin/auth.php';

include '../includes/db_connect.php';
$a = $_POST['name'];
$b = $_POST['username'];
$c = $_POST['contact'];
$d = $_POST['email'];
$e = $_POST['date'];
$f = sha1($b);
// query
$sql = "INSERT INTO user (name,username,contact,email,date,pass) VALUES (:a,:b,:c,:d,:e,:f)";
$q = $db->prepare($sql);
$q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f));
header("location: users.php");
