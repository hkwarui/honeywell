<?php
require_once 'auth.php';
require_once '../includes/db_connect.php';
require_once '../includes/receiptNumber.php';

//suppliers count
$result = $db->prepare("SELECT count(*) FROM supliers");
$result->execute();
$num_rows = $result->fetchColumn();

//users count
$result1 = $db->prepare("SELECT count(*) FROM user");
$result1->execute();
$num_rows1 = $result1->fetchColumn();

//customers count
$result2 = $db->prepare("SELECT count(*) FROM customer");
$result2->execute();
$num_rows2 = $result2->fetchColumn();

// 7 Favourite products count
$result3 = $db->prepare("SELECT  product_name, Sum(amount) as Total, SUM(qty) as fav_product FROM sales_order WHERE MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) GROUP BY product_name ORDER BY fav_product DESC LIMIT 7  ");
$result3->execute();

//Transactions count for today
$result4 = $db->prepare("SELECT count(*) FROM sales_order WHERE `date` = CURDATE()");
$result4->execute();
$num_rows4 = $result4->fetchColumn();

//Transactions count for this month
$result9 = $db->prepare("SELECT count(*) FROM sales_order WHERE MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE()) ");
$result9->execute();
$num_rows9 = $result9->fetchColumn();

//Sum sales today
$result5 = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE()");
$result5->execute();
$num_rows5 = $result5->fetchColumn();
$tot_amount = formatMoney($num_rows5, true);

// Todays credit sales 
$res_credit_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='credit_sales'");
$res_credit_sales->execute();
$tot = $res_credit_sales->fetchColumn();
$tot_credit_sales  = formatMoney($tot, true);

// Todays cash sales 
$res_cash_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='cash_sales'");
$res_cash_sales->execute();
$tot_cash = $res_cash_sales->fetchColumn();
$tot_cash_sales  = formatMoney($tot_cash, true);

// Todays buy_goods_and_services sales 
$res_bgas_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='buy_goods_and_services'");
$res_bgas_sales->execute();
$tot_bgas = $res_bgas_sales->fetchColumn();
$tot_bgas_sales  = formatMoney($tot_bgas, true);

// Todays equity_paybill sales 
$res_equity_paybill_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='equity_paybill'");
$res_equity_paybill_sales->execute();
$tot_equity = $res_equity_paybill_sales->fetchColumn();
$tot_equity_paybill_sales  = formatMoney($tot_equity, true);

//Sum sales this month
$result10 = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE MONTH(`date`) = MONTH(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE())");
$result10->execute();
$num_rows10 = $result10->fetchColumn();
$tot_amount3 = formatMoney($num_rows10, true);

//Sum profit today
$result6 = $db->prepare("SELECT SUM(profit) AS tot_profit FROM sales_order WHERE `date`= CURDATE()");
$result6->execute();
$num_rows6 = $result6->fetchColumn();
$tot_amount1 = formatMoney($num_rows6, true);

//Sum profit this month
$result8 = $db->prepare("SELECT SUM(profit) AS tot_profit FROM sales_order WHERE  MONTH(`date`) =  Month(CURDATE()) AND YEAR(`date`) = YEAR(CURDATE())");
$result8->execute();
$num_rows8 = $result8->fetchColumn();
$tot_amount2 = formatMoney($num_rows8, true);

//Products Out of Stock
$result7 = $db->prepare("SELECT product_name, SUM(qty) AS out_of_stock FROM products WHERE qty < 0");
$result7->execute();

//Sales per day for last 7 days
$result11 = $db->prepare("SELECT SUM(amount) AS amount, SUM(profit) as profit, `date` FROM sales WHERE `date` > CURDATE() - interval 1 week GROUP BY `date` ORDER BY `date` DESC LIMIT 7");
$result11->execute();

// $db->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>DASHBOARD</title>
    <?php include '../includes/header.php'; ?>

    <style>
    span.b {
        display: inline-block;
        width: auto;
        text-align: center;
        margin-left: 6%;
        margin-right: auto;
    }

    span.badge {
        padding: 7px;
    }
    </style>

<body>
    <?php include '../includes/navfixed.php'; ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li class="active"><a href="index.php"><i class="icon-dashboard icon-2x"
                                    style="color:#29D87E"></i>
                                Dashboard </a>
                        </li>
                        <li><a href="sales.php?id=cash&invoice=<?php echo $invoiceNumber ?>"><i
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
                        <li><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"
                                    style="color:#fff"></i> Sales
                                Report</a> </li>
                        <li><a href="sales_inventory.php"><i class="icon-table icon-2x" style="color:grey"></i> Sales
                                Inventory</a> </li>
                        <li><a href="users.php"><i class="icon-group icon-2x" style="color:red"></i> Users</a> </li>
                        <li><a href=" password.php"><i class="icon-key icon-2x" style="color:red"></i> My Password</a>
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
                <!--/.well -->
            </div>
            <!--/span-->
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-dashboard" style="color:#29D87E"></i> Dashboard
                </div>
                <div id="mainmain">

                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-money icon-2x"
                            style="color:green"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_cash_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>CASH SALES</span>
                    </a>
                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-mobile-phone icon-2x"
                            style="color:green"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_bgas_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>M-PESA Till SALES</span>
                    </a>
                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-mobile-phone icon-2x"
                            style="color:#900C3F"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_equity_paybill_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>EQUITY PAYBILL</span>
                    </a>
                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-credit-card icon-2x"
                            style="color:red"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_credit_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>CREDIT SALES</span>
                    </a>
                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-money icon-2x"
                            style="color:grey;"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_amount; ?> </b> </span><br> <span
                            class='badge badge-success'>TODAYS TOTAL SALES</span>
                    </a>

                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-money icon-2x" style="color:green"></i><br>
                        <b> Ksh. <?php echo $tot_amount1; ?> </b><br>
                        <span class='badge badge-success'>TODAYS TOTAL PROFIT</span>
                    </a>

                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x" style="color:#2B313D"></i><br>
                        <b> <?php echo $num_rows4 ?></b><br>
                        <span class='badge badge-success'>TODAYS TRANSACTIONS</span>
                    </a>
                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-shopping-cart icon-2x"
                            style="color:#ffbf00"></i><br>
                        <b> Ksh. <?php echo $tot_amount3; ?></b></b><br>
                        <span class='badge badge-success'>
                            <?php echo strtoupper(date('F')); ?> SALES</span>
                    </a>

                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-list-alt icon-2x" style="color:#2B313D"></i><br>
                        <b> Ksh. <?php echo $tot_amount2 ?> </b> <br>
                        <span class='badge badge-success'>
                            <?php echo strtoupper(date('F')); ?> PROFITS</span>
                    </a>

                    <!-- <a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x" style="color:red"></i><br>
                        <b><?php echo $num_rows9 ?> </b><br>
                        <span class='badge badge-success'>
                            <?php echo strtoupper(date('F')); ?> TRANSACTIONS</span>
                    </a> -->
                    <div class="clearfix"></div> 
                </div>

                <div>
                    <span class="b">
                        <table class="table table-striped">
                            <thead>
                                <th colspan='4' style="color:#f2f2f2; background-color:#6C7366 ;text-align:center">
                                    <b>PREVIOUS SALES<b>
                                </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th> DATE </th>
                                    <th> TOTAL</th>
                                    <th>PROFIT</th>
                                </tr>
                                </th>
                            </thead>

                            <tbody>
                                <?php
                                    function getWeekday($date)
                                    {
                                        $dayofweek = date('w', strtotime($date));
                                        $day = "";
                                        if ($dayofweek == 1) {
                                            $day = 'monday';
                                        };
                                        if ($dayofweek == 2) {
                                            $day = 'tuesday';
                                        };
                                        if ($dayofweek == 3) {
                                            $day = 'wednesday';
                                        };
                                        if ($dayofweek == 4) {
                                            $day = 'thursday';
                                        };
                                        if ($dayofweek == 5) {
                                            $day = 'friday';
                                        };
                                        if ($dayofweek == 6) {
                                            $day = 'saturday';
                                        };
                                        if ($dayofweek == 0) {
                                            $day = 'sunday';
                                        }
                                        return ucfirst($day);
                                    };
                                    $num1 = 1;
                                    while ($num_rows11 = $result11->fetch()) {
                                        $day = getWeekday($num_rows11['date']) . ' , ' . date("M d", strtotime($num_rows11['date']));
                                    ?>
                                <tr>
                                    <td><?php echo $num1++; ?></td>
                                    <td><?php echo $day ?>
                                    </td>
                                    <td>Ksh. <?php echo formatMoney($num_rows11['amount'], true) ?></td>
                                    <td>Ksh. <?php echo formatMoney($num_rows11['profit'], true) ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <th colspan='4' style="color:#f2f2f2; background-color:#ADB6A5 ;text-align:center">
                                    <b>PREVIOUS SALES<b>
                                </th>
                                </tr>
                            </tfoot>
                        </table>
                    </span>
                    <span class=b>
                        <table class="table table-striped">
                            <thead>
                                <th colspan='4' style=" color:#f2f2f2; background-color:#6C7366  ;text-align:center">
                                    <b><?php echo strtoupper(date('F')); ?> FAVOURITE ITEMS<b>
                                </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th> ITEM </th>
                                    <th>QTY SOLD</th>
                                    <th>TOTAL</th>
                                </tr>
                                </th>
                            </thead>

                            <tbody>
                                <?php
                                    $num1 = 1;
                                    while ($num_rows3 = $result3->fetch()) { ?>
                                <tr>
                                    <td><?php echo $num1++; ?></td>
                                    <td><?php echo $num_rows3['product_name'] ?>
                                    </td>
                                    <td><?php echo $num_rows3['fav_product'] ?></td>
                                    <td>Ksh: <?php echo formatMoney($num_rows3['Total'], true) ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <th colspan='4' style="color:#f2f2f2; background-color:#ADB6A5 ;text-align:center">
                                    <b><?php echo strtoupper(date('F')); ?> FAVOURITE ITEMS<b>
                                </th>
                                </tr>
                            </tfoot>
                        </table>
                    </span>
                </div>

            </div>
        </div>
    </div>
</body>
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
include '../includes/footer.php'; ?>

</html>