<?php
session_start();

$username = $_SESSION['username'];
echo $_SESSION['categorySession'];

//Check whether the session variable is present or not
if (isset($_SESSION['categorySession'])) {
    if ($_SESSION['categorySession'] == 1) {
        // $msg = "<span style='color:red';>That user was not created  by Admin. Contact Admin</span>";
        header("Location: ../");
        exit;
    }
    if ($_SESSION['categorySession'] == 2) {
        // $msg = "<span style='color:red';>That user was not created  by Admin. Contact Admin</span>";
        header("Location: /");
        exit;
    } 
} else {
    // If no session variable logout
    session_unset();
    session_destroy();
    header("Location: ../");
    exit;
 
}

?>