<?php
require_once 'auth.php';
require_once '../includes/db_connect.php';
require_once '../includes/receiptNumber.php';

if ($username) {

  //get old password
  $result = $db->prepare("SELECT pass FROM user WHERE username = '$username'");
  $result->execute();
  $row = $result->fetch();
  $oldpassworddb = $row['pass'];

  //process form inputs
  if (isset($_POST['btn-save'])) {

    $oldPassword = trim($_POST['oldPassword']);
    $repeatPassword = trim($_POST['repeatPassword']);
    $password = trim($_POST['password']);

    $oldPass = sha1($oldPassword);


    if ($oldPass == $oldpassworddb) {
      if ($password == $repeatPassword) {

        $newPass = sha1($password);
        $sql = "UPDATE user SET pass=? WHERE username= ?";
        $q = $db->prepare($sql);
        $q->execute(array($newPass, $username));

        $msg = "<span style='color:green';>Password changed succesfully </span>";
      } else {

        $msg = "<span style='color:red';>New Password don't match</span>";
      }
    } else {

      $msg = "<span style='color:red';>Old password Incorrect</span>";
    }
  }
}
?>

<html>

<head>
    <title> Password Change</title>
    <?php include '../includes/header.php'; ?>
    <script src="../static/js/application.js"></script>

<body>
    <?php include '../includes/navfixed.php'; ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li><a href="index.php"><i class="icon-dashboard icon-2x" style="color:#29D87E"></i> Dashboard
                            </a>
                        </li>
                        <li><a href="sales.php?id=cash&invoice=<?php echo $invoiceNumber ?>"><i
                                    class="icon-shopping-cart icon-2x" style="color:#DB691C"></i>
                                Sales</a> </li>
                        <li><a href="credits.php"><i class="icon icon-money icon-2x" style="color:grey"></i> Credits</a>
                        <li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>Products</a>
                        </li>
                        <li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i> Customers</a>
                        </li>
                        <li><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"
                                    style="color:#fff"></i> Sales
                                Report</a> </li>
                        <li class="active"><a href=" password.php"><i class="icon-key icon-2x" style="color:red"></i> My
                                Password</a> </li>
                        <br><br><br><br><br><br>
                        <li>
                            <div class=" hero-unit-clock">

                                <form name="clock">
                                    <font color="#ffffff">Time: <br></font>&nbsp;<input
                                        style="width:150px;color:#00B294;" type="
                    submit" class="trans" name="face" value="">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-key" style="color:red"></i> Change Password
                </div>
                <ul class="breadcrumb">

                </ul>

                <div id="login">
                    <?php if (isset($msg)) {
            echo $msg;
          } ?>
                    <br>
                    <form id="login-form" method="post">
                        <br>
                        <div class="input-prepend">
                            <span style="height:30px; width:25px;" class="add-on"><i
                                    class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;"
                                name="oldPassword" Placeholder="Old Password" required /><br>
                        </div>
                        <div class="input-prepend">
                            <span style="height:30px; width:25px;" class="add-on"><i
                                    class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;"
                                name="password" Placeholder="New Password" required /><br>
                        </div>
                        <div class="input-prepend">
                            <span style="height:30px; width:25px;" class="add-on"><i
                                    class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;"
                                name="repeatPassword" Placeholder="Repeat Password" required /><br>
                        </div>
                        <div class="qwe">
                            <button class="btn btn-large btn-success btn-block pull-right" name="btn-save"
                                type="submit"><i class="icon-signin icon-large"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script src=" ../static/js/jquery.js">
    </script>
</body>
<?php include '../includes/footer.php'; ?>

</html>