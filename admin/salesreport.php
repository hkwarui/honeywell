<?php
  require_once 'auth.php';
  require_once '../includes/db_connect.php';
  require_once '../includes/receiptNumber.php';
?>

<html>

<head>
    <title>Sales Report</title>
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
    <link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="tcal.css" />
    <script type="text/javascript" src="tcal.js"></script>
    <script language="javascript">
    function Clickheretoprint() {
        var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
        disp_setting += "scrollbars=yes,width=700, height=400, left=100, top=25";
        var content_vlue = document.getElementById("content").innerHTML;

        var docprint = window.open("", "", disp_setting);
        docprint.document.open();
        docprint.document.write(
            '</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">'
        );
        docprint.document.write(content_vlue);
        docprint.document.close();
        docprint.focus();
    }
    </script>


    <script language="javascript" type="text/javascript">
    /* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
    // <!-- Begin
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
    // End -->
    </SCRIPT>
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
                        <li><a href="sales.php?id=cash&invoice=<?php echo $invoiceNumber; ?>"><i
                                    class="icon-shopping-cart icon-2x" style="color:#DB691C"></i>
                                Sales</a> </li>
                        <li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>
                                Products</a>
                        </li>
                        <li><a href="credits.php"><i class="icon icon-money icon-2x" style="color:grey"></i> Credits</a>
                        </li>
                        <li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i> Customers</a>
                        </li>
                        <li><a href=" supplier.php"><i class="icon-group icon-2x" style="color:yellow"></i>
                                Suppliers</a> </li>
                        <li class="active"><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"
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
                                    <font color="white">Time: <br></font>&nbsp;<input style="width:150px;color:#00B294;"
                                        type="submit" class="trans" name="face" value="">
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
                    <i class="icon-bar-chart"></i> Sales Report
                </div>
                <ul class="breadcrumb">
                </ul>

                <div style="margin-top: -19px; margin-bottom: 21px;">
                    </button></a>
                    <button style="float:right;" class="btn btn-success btn-mini"><a
                            href="javascript:Clickheretoprint()">
                            Print</button></a>
                </div>
                <form action="salesreport.php" method="get">
                    <center><strong>
                            From : <input type="text" style="width: 223px; padding:14px;" name="d1" class="tcal"
                                value="" />
                            To:
                            <input type="text" style="width: 223px; padding:14px;" name="d2" class="tcal" value="" />
                            <button class="btn btn-info"
                                style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i
                                    class="icon icon-search icon-large"></i> Search</button>
                        </strong></center>
                </form>
                <div class="content" id="content">
                    <div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
                        Sales Report from&nbsp;<?php echo $_GET['d1'] ?>&nbsp;to&nbsp;<?php echo $_GET['d2'] ?>
                    </div>
                    <table class="table table-bordered" id="resultTable" data-responsive="table"
                        style="text-align: left;">
                        <thead>
                            <tr>
                                <th width="13%"> Transaction ID </th>
                                <th width="13%"> Transaction Date </th>
                                <th width="20%"> Cashier Name </th>
                                <th width="16%"> Invoice Number </th>
                                <th width="18%"> Amount </th>
                                <th width="13%"> Profit </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
$d1 = date("Y-m-d", strtotime($_GET['d1']));
$d2 = date("Y-m-d", strtotime($_GET['d2']));
$result = $db->prepare("SELECT * FROM sales WHERE  `date` BETWEEN :a AND :b ORDER by transaction_id DESC ");
$result->bindParam(':a', $d1);
$result->bindParam(':b', $d2);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
                            <tr class="record">
                                <td>STI-00<?php echo $row['transaction_id']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['cashier']; ?></td>
                                <td><?php echo $row['invoice_number']; ?></td>
                                <td><?php
$dsdsd = $row['amount'];
    echo formatMoney($dsdsd, true);
    ?></td>
                                <td><?php
$zxc = $row['profit'];
    echo formatMoney($zxc, true);
    ?></td>
                            </tr>
                            <?php
}
?>

                        </tbody>
                        <thead>
                            <tr>
                                <th colspan="4" style="border-top:1px solid #999999"> Total: </th>
                                <th colspan="1" style="border-top:1px solid #999999">
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
$d1 = date("Y-m-d", strtotime($_GET['d1']));
$d2 = date("Y-m-d", strtotime($_GET['d2']));
$results = $db->prepare("SELECT sum(amount) FROM sales WHERE  `date` BETWEEN :a AND :b");
$results->bindParam(':a', $d1);
$results->bindParam(':b', $d2);
$results->execute();
for ($i = 0; $rows = $results->fetch(); $i++) {
    $dsdsd = $rows['sum(amount)'];
    echo formatMoney($dsdsd, true);
}
?>
                                </th>
                                <th colspan="1" style="border-top:1px solid #999999">
                                    <?php
$resultia = $db->prepare("SELECT sum(profit) FROM sales WHERE `date` BETWEEN :d AND :e");
$resultia->bindParam(':d', $d1);
$resultia->bindParam(':e', $d2);
$resultia->execute();
for ($i = 0; $cxz = $resultia->fetch(); $i++) {
    $zxc = $cxz['sum(profit)'];
    echo formatMoney($zxc, true);
}
?>

                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</body>
<script src="../static/js/jquery.js"></script>
<script type="text/javascript">
$(function() {


    $(".delbutton").click(function() {

        //Save the link in a variable called element
        var element = $(this);

        //Find the id of the link that was clicked
        var del_id = element.attr("id");

        //Built a url to send
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this update? There is NO undo!")) {

            $.ajax({
                type: "GET",
                url: "deletesales.php",
                data: info,
                success: function() {

                }
            });
            $(this).parents(".record").animate({
                    backgroundColor: "#fbc7c7"
                }, "fast")
                .animate({
                    opacity: "hide"
                }, "slow");

        }

        return false;

    });

});
</script>
<?php include '../includes/footer.php';?>

</html>