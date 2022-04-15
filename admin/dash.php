<?php
include '../admin/auth.php';

include '../includes/db_connect.php';

?>


<html>

<head>
  <title> Users </title>
  <?php include '../includes/header.php';?>
  <script src="../static/js/application.js"></script>

<body>
  <?php include '../includes/navfixed.php';?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span2">
        <div class="well sidebar-nav">
          <ul class="nav nav-list">
            <li><a href="../admin"><i class="icon-dashboard icon-2x" style="color:#29D87E"></i> Dashboard </a>
            </li>
            <li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"
                  style="color:#DB691C"></i>
                Sales</a> </li>
            <li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>Products</a> </li>
            <li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i> Customers</a> </li>
            <li><a href=" supplier.php"><i class="icon-group icon-2x" style="color:yellow"></i> Suppliers</a> </li>
            <li><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x" style="color:#fff"></i> Sales
                Report</a> </li>
            <li class="active"><a href="#"><i class="icon-group icon-2x" style="color:red"></i> Users</a> </li>
            <br><br><br><br><br><br>
            <li>
              <div class=" hero-unit-clock">

                <form name="clock">
                  <font color="#ffffff">Time: <br></font>&nbsp;<input style="width:150px;color:#00B294;" type="
                    submit" class="trans" name="face" value="">
                </form>
              </div>
            </li>
          </ul>
        </div>
        <!--/.well -->
      </div>
      <div class="span10">
        <div class="contentheader">
          <i class="icon-group" style="color:red"></i> Users
        </div>
        <ul class="breadcrumb">

        </ul>
    </div>
  </div>
  <script src="../static/js/jquery.js"></script>
 </body>
<?php include '../includes/footer.php';?>

</html>