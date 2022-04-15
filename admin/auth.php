<?php
session_start();
require_once '../includes/db_connect.php';

if(!$_SESSION['status'] || !$_SESSION['categorySession'] || !$_SESSION['status'] == 1 ){
    session_unset();
    session_destroy();
    header("Location: ../");
    exit;
}

if ($_SESSION['categorySession'] == 2) {
    header("Location: ../staff");
    exit;
}
 elseif($_SESSION['categorySession'] == 1){
    // Do Nothing 
} 
else{
    session_unset();
    session_destroy();
    header("Location: ../");
    exit;
}


$username = $_SESSION['username'];
?>