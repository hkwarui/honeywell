<?php
require_once 'includes/db_connect.php';

if (isset($_POST['btn-login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);

    $username = $DBcon->real_escape_string($username);
    $password = $DBcon->real_escape_string($password);
    $pass = sha1($password);

    $query = $DBcon->query("SELECT username, stat, category, pass FROM user WHERE username ='$username' AND pass = '$pass' ");
    $row = $query->fetch_array();
    $count = $query->num_rows; // if username/password are correct returns must be 1 row
    if ($count == 1) {

        if ($row['stat'] == 1) {
            if ($row['category'] == 2) {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['categorySession'] = $row['category'];
                $_SESSION['status'] = $row['stat'];

                header("Location: staff/");
                exit;
            } elseif ($row['category'] == 1) {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['categorySession'] = $row['category'];
                $_SESSION['status'] = $row['stat'];

                header("Location: admin/");
                exit;
            } else {
                $msg = "<span style='color:red';>That user was not created  by Admin. Contact Admin</span>";
            }
        }
        else {
            $msg = "<span style='color:red';>Account is deactivated. Contact Admin</span>";
        }
    } else {
        $msg = "<span style='color:red';> Incorrect Username or Password. </span>";
    }

}
?>

<html>

<head>
    <title>
        Kiki empire outlets 2
    </title>
    <link rel="shortcut icon" href="static/images/pos.jpg">
    <link href="static/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="static/css/DT_bootstrap.css">
    <link rel="stylesheet" href="static/css/font-awesome.min.css">
    <link href="static/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <font style=" font:bold 30px 'Aleo'; text-shadow:1px 1px 15px #000; color:#c92859;">
            <center> KIKI EMPIRE OUTLETS 2</center>
        </font>

    </div>
    <div class="container-fluid">
        <div id="login">
            <?php
if (isset($msg)) {
    echo $msg;
}
?>
            <br>
            <form id="login-form" method="post">
                <br>
                <div class="input-prepend">
                    <span style="height:30px; width:25px;" class="add-on"><i class="icon-user icon-2x"></i></span><input
                        style="height:40px;" type="text" name="username" Placeholder="Username" required /><br>
                </div>
                <div class="input-prepend">
                    <span style="height:30px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span><input
                        type="password" style="height:40px;" name="password" Placeholder="Password" required /><br>
                </div>
                <div class="qwe">
                    <button class="btn btn-large btn-primary btn-block pull-right" name="btn-login" type="submit"><i
                            class="icon-signin icon-large"></i> Login</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</body>

</html>