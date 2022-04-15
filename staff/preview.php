<?php
include '../admin/auth.php';
include '../includes/db_connect.php';
?>


<!DOCTYPE html>
<html>

<head>
    <title>Preview</title>
    <link href="../static/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../static/css/DT_bootstrap.css">
    <link rel="stylesheet" href="../static/css/font-awesome.min.css">

    <style type="text/css">
    .sidebar-nav {
        padding: 9px 0;
    }
    </style>
    <link href="../static/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../static/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../static/lib/jquery.js" type="text/javascript"></script>
    <script src="../static/src/facebox.js" type="text/javascript"></script>


    <!-- <script language="javascript">
    function Clickheretoprint() {
        var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
        disp_setting += "scrollbars=yes,width=800, height=400, left=100, top=25";
        var content_vlue = document.getElementById("content").innerHTML;

        var docprint = window.open("receipt.php", "", disp_setting);
        docprint.document.open();
        docprint.document.write("<p>Honeywell Liqour store</p>");
        // '</head > < body onLoad = "self.print()"
        style = "width: 800px; font-size: 13px; font-family: arial;" > ');
        docprint.document.write();
        docprint.document.close();
        docprint.focus();
    }
    </script> -->

    <!-- <script type="text/javascript">
    function popuponclick() {
        my_window = window.open('../admin/receipt.php', 'mywindow', 'status=1,width=350,height=150');
        my_window.document.write('<html><head><title>Receipt</title></head>');
        my_window.document.write('<body onafterprint="self.close()">');
        my_window.document.write('<p>Honeywell Liqour Store</p>');
        my_window.document.write('<p>wholesale & Retail</p><br>');
        my_window.document.write('</body></html>');
    }
    </script> -->

    <script type="text/javascript">
    function closePrint() {
        document.body.removeChild(this.__container__);
    }

    function setPrint() {
        this.contentWindow.__container__ = this;
        this.contentWindow.onbeforeunload = closePrint;
        this.contentWindow.onafterprint = closePrint;
        this.contentWindow.focus(); // Required for IE
        this.contentWindow.print();
    }

    function printPage(sURL) {
        var oHideFrame = document.createElement("iframe");
        oHideFrame.onload = setPrint;
        oHideFrame.style.position = "fixed";
        oHideFrame.style.right = "0";
        oHideFrame.style.bottom = "0";
        oHideFrame.style.width = "0";
        oHideFrame.style.height = "0";
        oHideFrame.style.border = "0";
        oHideFrame.src = sURL;
        document.body.appendChild(oHideFrame);
    }
    </script>


    <?php
    //Get invoice Details

    $invoice = $_GET['invoice'];
    $result = $db->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
    $result->bindParam(':userid', $invoice);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $cname = $row['name'];
        $invoice = $row['invoice_number'];
        $date = $row['date'];
        $cash = $row['due_date'];
        $cashier = $row['cashier'];

        $pt = $row['type'];
        $am = $row['amount'];
        if ($pt == 'cash') {
            $cash = $row['due_date'];
            $amount = (int) $cash - (int) $am;
        }
    }
    ?>


    <?php
    function createRandomPassword()
    {
        $chars = "003232303232023232023456789";
        srand((float) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 7) {

            $num = rand() % 33;

            $tmp = substr($chars, $num, 1);

            $pass = $pass . $tmp;

            $i++;
        }
        return $pass;
    }
    $finalcode = 'RS-' . createRandomPassword();
    ?>

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

<body>
    <?php include '../includes/navfixed.php'; ?>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li><a href="../admin"><i class="icon-dashboard icon-2x" style="color:#29D87E"></i> Dashboard
                            </a>
                        </li>
                        <li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i
                                    class="icon-shopping-cart icon-2x" style="color:#DB691C"></i>
                                Sales</a> </li>
                        <li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>Products</a>
                        </li>
                        <li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i> Customers</a>
                        </li>
                        <li><a href=" supplier.php"><i class="icon-group icon-2x" style="color:yellow"></i>
                                Suppliers</a> </li>
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
                <a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default"><i
                            class="icon-arrow-left"></i> Back to Sales</button></a>
                <div class="content" id="content">
                    <div style="margin: 0 auto; padding: 20px; width: 400px; font-weight: normal;">
                        <div style="width: 100%; height: 190px;">
                            <div style="float: left;">
                                <center>
                                    <div style="width:400px; font:bold 20px 'Aleo';">KIKI EMPIRE OUTLETS 2</div>
                                    Wholesale & Retail <br> Tel:0722679288 <br><br>
                                </center>
                                <div>
                                </div>
                            </div>
                            <div style="float: left;">
                                <table cellpadding="5" cellspacing="0"
                                    style="font-family: arial; font-size: nnnnn12px; width: 100%;">

                                    <tr>
                                        <td>RCT :<?php echo $invoice ?></td>
                                        <td>Date :<?php echo date("d/m/y  H:i") ?></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div style="width: 100%; margin-top:-70px;">
                            <table border="1" cellpadding="4" cellspacing="0"
                                style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
                                <thead>
                                    <tr>
                                        <th> Product Name </th>
                                        <th> Qty </th>
                                        <th> Price </th>
                                        <th> Amount </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $id = $_GET['invoice'];
                                    $result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
                                    $result->bindParam(':userid', $id);
                                    $result->execute();
                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                    ?>
                                    <tr class="record">
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        <td>
                                            <?php
                                                $ppp = $row['price'];
                                                echo formatMoney($ppp, true);
                                                ?>
                                        </td>
                                        <td>
                                            <?php
                                                $dfdf = $row['amount'];
                                                echo formatMoney($dfdf, true);
                                                ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>

                                    <tr>
                                        <td colspan="3" style=" text-align:right;"><strong
                                                style="font-size: 12px;">Total: &nbsp;</strong>
                                        </td>
                                        <td colspan="2"><strong style="font-size: 12px;">
                                                <?php
                                                $sdsd = $_GET['invoice'];
                                                $resultas = $db->prepare("SELECT sum(amount) FROM sales_order WHERE invoice= :a");
                                                $resultas->bindParam(':a', $sdsd);
                                                $resultas->execute();
                                                for ($i = 0; $rowas = $resultas->fetch(); $i++) {
                                                    $fgfg = $rowas['sum(amount)'];
                                                    echo formatMoney($fgfg, true);
                                                }
                                                ?>
                                            </strong></td>
                                    </tr>
                                    <?php if ($pt == 'cash') {
                                    ?>
                                    <tr>
                                        <td colspan="3" style=" text-align:right;"><strong
                                                style="font-size: 12px; color: #222222;">Cash
                                                Tendered:&nbsp;</strong></td>
                                        <td colspan="2"><strong style="font-size: 12px; color: #222222;">
                                                <?php
                                                    echo formatMoney($cash, true);
                                                    ?>
                                            </strong></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" style=" text-align:right;"><strong
                                                style="font-size: 12px; color: #222222;">
                                                <font style="font-size:14px;">
                                                    <?php
                                                    if ($pt == 'cash') {
                                                        echo 'Change:';
                                                    }
                                                    if ($pt == 'credit') {
                                                        echo 'Due Date:';
                                                    }
                                                    ?>&nbsp;
                                            </strong></td>
                                        <td colspan="2"><strong style="font-size: 14px; color: #222222;">
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
                                                if ($pt == 'credit') {
                                                    echo $cash;
                                                }
                                                if ($pt == 'cash') {
                                                    echo formatMoney($amount, true);
                                                }
                                                ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <center style="font-size:12px">
                                <div>Good onces sold are not refundable </div>
                            </center>

                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right" style="margin-right:100px;">
                <a href="#" id="<?php echo $sdsd; ?>" onclick="printPage('receipt.php')" style="font-size:20px;"><button
                        class="btn btn-success btn-large printbtn"><i class="icon-print"></i>
                        Print</button></a>
            </div>
        </div>
    </div>