<?php

$DBhost = "localhost";
$DBuser = "root";
$DBpass = "28582027";
$DBname = "new_sales";

date_default_timezone_set('Africa/Nairobi');

$DBcon = new MySQLi($DBhost, $DBuser, $DBpass, $DBname);

if ($DBcon->connect_errno) {
    die("ERROR : -> " . $DBcon->connect_error);
}
;
/*  ===================================================================================== */

/* Database config */
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '28582027';
$db_database = 'new_sales';
date_default_timezone_set('Africa/Nairobi');

/* End config */

$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
