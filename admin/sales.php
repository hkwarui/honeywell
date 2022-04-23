  <?php
    require_once 'auth.php';
    require_once '../includes/db_connect.php';
    require_once '../includes/receiptNumber.php';
?>

  <!DOCTYPE html>
  <html>

  <head>
      <!-- js -->
      <link href="../static/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
      <script src="../static/lib/jquery.js" type="text/javascript"></script>
      <script src="../static/src/facebox.js" type="text/javascript"></script>
      <script type="text/javascript">
      jQuery(document).ready(function($) {
          $('a[rel*=facebox]').facebox({
              loadingImage: '../static/src/loading.gif',
              closeImage: '../static/src/closelabel.png'
          })
      })
      </script>
      <title> Sales </title>
      <?php
?>
      <link href="../static/vendors/uniform.default.css" rel="stylesheet" media="screen">
      <link href="../static/css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../static/css/DT_bootstrap.css">
      <link rel="stylesheet" href="../static/css/font-awesome.min.css">
      <style type="text/css">
      body {
          padding-top: 60px;
          padding-bottom: 40px;
      }

      .sidebar-nav {
          padding: 9px 0;
      }
      </style>
      <link href="../static/css/bootstrap-responsive.css" rel="stylesheet">
         <script src="../static/vendors/jquery-1.7.2.min.js"></script>
      <script src="../static/vendors/bootstrap.js"></script>
      <link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
        <script language="javascript" type="text/javascript">
      <!-- Begin
      var timerID = null;
      var timerRunning = false;

      function stopclock() {
          if (timerRunning)
              clearTimeout(timerID);
          timerRunning = false;
      }

      function showtime() {
          var now = new Date();
          var hours = now.getHours();
          var minutes = now.getMinutes();
          var seconds = now.getSeconds()
          var timeValue = "" + ((hours > 12) ? hours - 12 : hours)
          if (timeValue == "0") timeValue = 12;
          timeValue += ((minutes < 10) ? ":0" : ":") + minutes
          timeValue += ((seconds < 10) ? ":0" : ":") + seconds
          timeValue += (hours >= 12) ? " P.M." : " A.M."
          document.clock.face.value = timeValue;
          timerID = setTimeout("showtime()", 1000);
          timerRunning = true;
      }

      function startclock() {
          stopclock();
          showtime();
      }
      window.onload = startclock;
            </script>
  </head>

  <body>
      <?php include '../includes/navfixed.php';?>
      <div class="container-fluid">
          <div class="row-fluid">
              <div class="span2">
                  <div class="well sidebar-nav">
                      <ul class="nav nav-list">
                          <li><a href="index.php"><i class="icon-dashboard icon-2x" style="color:#29D87E"></i>
                                  Dashboard </a>
                          </li>
                          <li class="active"><a href="sales.php?id=cash&invoice=<?php echo $invoiceNumber ?>"><i
                                      class="icon-shopping-cart icon-2x" style="color:#DB691C"></i>
                                  Sales</a> </li>
                          <li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>
                                  Products</a>
                          </li>
                          <li><a href="credits.php"><i class="icon icon-money icon-2x" style="color:grey"></i>
                                  Credits</a>
                          </li>
                          <li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i>
                                  Customers</a>
                          </li>
                          <li><a href=" supplier.php"><i class="icon-group icon-2x" style="color:yellow"></i>
                                  Suppliers</a> </li>
                          <li><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"
                                      style="color:#fff"></i> Sales
                                  Report</a> </li>
                          <li><a href="sales_inventory.php"><i class="icon-table icon-2x" style="color:grey"></i> Sales
                                  Inventory</a> </li>
                          <li><a href="users.php"><i class="icon-group icon-2x" style="color:red"></i> Users</a> </li>
                          <li><a href=" password.php"><i class="icon-key icon-2x" style="color:red"></i> My Password</a>
                              <br><br><br><br><br><br>
                          <li>
                              <div class="hero-unit-clock">

                                  <form name="clock">
                                      <font color="white">Time: <br></font>&nbsp;<input
                                          style="width:150px;color:#00B294;" type="text" class="trans" name="face"
                                          value="" disabled>
                                  </form>
                              </div>
                          </li>

                      </ul>
                  </div>
                  <!--/.well -->
              </div>
              <!--/span-->
              <div class="span10">
                  <div class="contentheader">
                      <i class="icon-money" style="color:#DB691C"></i> Sales
                  </div>
                  <ul class="breadcrumb"></ul>
                  <div style="margin-top: -19px; margin-bottom: 21px;">
                      <a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i
                                  class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
                  </div>

                  <form action="incoming.php" method="post">

                      <input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
                      <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
                      <select name="product" style="width:650px; " class="chzn-select" required>
                          <option></option>
                          <?php
                            $result = $db->prepare("SELECT * FROM products WHERE qty > 0");
                            $result->execute();
                           for ($i = 0; $row = $result->fetch(); $i++) {
                          ?>
                          <option value="<?php echo $row['product_id']; ?>">
                              <?php echo strtoupper($row['product_name']); ?>
                              ----------------
                              <?php echo $row['qty']; ?> Items</option>
                          <?php
}
?>
                      </select>

                      <input type="number" name="qty" value="1" min="1" placeholder="Qty" autocomplete="off"
                          style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;"
                          required />
                      <input type="hidden" name="discount" value="" autocomplete="off"
                          style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" />
                      <input type="hidden" name="date" value="<?php echo date("m/d/y"); ?>" />
                      <Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;"><i
                              class="icon-plus-sign icon-large"></i> Add</button>
                  </form>
                  <table class="table table-bordered" id="resultTable" data-responsive="table">
                      <thead>
                          <tr>
                              <th> Product Name </th>
                              <th> Description </th>
                              <th> Price </th>
                              <th> Qty </th>
                              <th> Amount </th>
                              <th style="display: none;"> Profit </th>
                              <th> Action </th>
                          </tr>
                      </thead>
                      <tbody>

                          <?php
$id = $_GET['invoice'];
$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 1; $row = $result->fetch(); $i++) {
    ?>
                          <tr class="record">
                              <td hidden><?php echo $row['product']; ?></td>
                              <td><?php echo strtoupper($row['product_name']); ?></td>
                              <td><?php echo $row['description']; ?></td>
                              <td>
                                  <?php
                                  $row['profit'];
$ppp = $row['price'];
    echo formatMoney($ppp, true);
    ?>
                              </td>
                              <td><?php echo $row['qty']; ?></td>
                              <td>
                                  <?php
$dfdf = $row['amount'];
    echo formatMoney($dfdf, true);
    ?>
                              </td>
                              <td width="90"><a
                                      href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty']; ?>&code=<?php echo $row['product']; ?>"><button
                                          class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Cancel
                                      </button></a></td>
                              <td style="display:none"><?php echo $row['profit']?></td>
                          </tr>
                          <?php
}
?>
                          <tr>
                              <th> </th>
                              <th> </th>
                              <th> </th>
                              <th> </th>
                              <td> Total Amount: </td>
                              <th> </th>
                          </tr>
                          <tr>
                              <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                              <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                      <?php
function formatMoney($number, $fractional = false)
{
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

$sdsd = $_GET['invoice'];

//Total amount
$resultas = $db->prepare("SELECT sum(amount) FROM sales_order WHERE invoice= :a");
$resultas->bindParam(':a', $sdsd);
$resultas->execute();
for ($i = 0; $rowas = $resultas->fetch(); $i++) {
    $fgfg = $rowas['sum(amount)'];
    echo formatMoney($fgfg, true);
}
?> </td>
                              <td></td>
                              <td style="display: none;">

                                  <?php
//Total Profit
$resultcr = $db->prepare("SELECT sum(profit) FROM sales_order WHERE invoice= :a");
$resultcr->bindParam(':a', $sdsd);
$resultcr->execute();

for ($i = 0; $rows = $resultcr->fetch(); $i++) {
    $asd = $rows['sum(profit)'];
    echo $asd;
 }
?>
                                  </strong></td>
                              <th></th>
                          </tr>

                      </tbody>
                  </table><br>
                  <a rel="facebox"
                      href="crcheckout.php?pt=<?php echo $_GET['id'] ?>&invoice=<?php echo $_GET['invoice'] ?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $username ?>"><button
                          class="btn btn-info btn-large btn-inline" style="width: 200px;"><i
                              class="icon icon-credit-card icon-large"></i>
                          CREDIT</button>
                  </a>
                  <a rel="facebox"
                      href="mobile_checkout.php?pt=<?php echo $_GET['id'] ?>&invoice=<?php echo $_GET['invoice'] ?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $username ?>"><button
                          class="btn btn-large btn-inline" style="width: 200px; margin-left:50px; color:#900C3F;><i
                              class="icon icon-mobile-phone icon-large"></i>
                          M-Pesa / Equity </button>
                  </a>
                  <a rel="facebox"
                      href="checkout.php?pt=<?php echo $_GET['id'] ?>&invoice=<?php echo $_GET['invoice'] ?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $username ?>"><button
                          class="btn btn-success btn-large btn-inline" style="width: 500px;margin-left:50px"><i
                              class="icon icon-money icon-large"></i>
                          CASH</button>
                  </a>
                  <div class="clearfix"></div>
              </div>
          </div>
      </div>
  </body>
  <?php include '../includes/footer.php';?>

  </html>