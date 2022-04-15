<?php
// configuration
include '../admin/auth.php';

include '../includes/db_connect.php';

// new data
$id = $_POST['memi'];
$a = $_POST['name'];
$b = $_POST['username'];
$c = $_POST['contact'];
$d = $_POST['email'];
$e = $_POST['date'];
$f = $_POST['stat'];
$g = $_POST['category'];
// query
$sql = "UPDATE user
        SET name=?, username=?, contact=?, email=?, date=?, stat=?, category=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a, $b, $c, $d, $e, $f, $g, $id));
header("location: users.php");
