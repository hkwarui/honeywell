<?php
include 'auth.php';
include '../includes/receiptNumber.php';


//Sum sales today
$result5 = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND cashier=?");
$result5->execute([$username]);
$num_rows5 = $result5->fetchColumn();
$tot_amount = formatMoney($num_rows5, true);

// Todays credit sales 
$res_credit_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='credit_sales' AND cashier=?");
$res_credit_sales->execute([$username]);
$tot = $res_credit_sales->fetchColumn();
$tot_credit_sales  = formatMoney($tot, true);

// Todays cash sales 
$res_cash_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='cash_sales' AND cashier=?");
$res_cash_sales->execute([$username]);
$tot_cash = $res_cash_sales->fetchColumn();
$tot_cash_sales  = formatMoney($tot_cash, true);

// Todays buy_goods_and_services sales 
$res_bgas_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='buy_goods_and_services' AND cashier=?");
$res_bgas_sales->execute([$username]);
$tot_bgas = $res_bgas_sales->fetchColumn();
$tot_bgas_sales  = formatMoney($tot_bgas, true);

// Todays equity_paybill sales 
$res_equity_paybill_sales = $db->prepare("SELECT SUM(amount) AS tot_amount FROM sales WHERE `date`= CURDATE() AND `type`='equity_paybill' AND cashier=?");
$res_equity_paybill_sales->execute([$username]);
$tot_equity = $res_equity_paybill_sales->fetchColumn();
$tot_equity_paybill_sales  = formatMoney($tot_equity, true);

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
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        DASHBOARD
    </title>
    <?php include '../includes/header.php'; ?>

<body>
    <?php include '../includes/navfixed.php'; ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li class="active"><a href="#"><i class="icon-dashboard icon-2x" style="color:#29D87E"></i>
                                Dashboard </a>
                        </li>
                        <li><a href="sales.php?id=cash&invoice=<?php echo $invoiceNumber ?>"><i
                                    class="icon-shopping-cart icon-2x" style="color:#DB691C"></i>
                                Sales</a> </li>
                        <li><a href="credits.php"><i class="icon icon-money icon-2x" style="color:grey"></i> Credits</a>
                        <li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>
                                Products</a> </li>
                        <li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i> Customers</a>
                        </li>
                        <li><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"
                                    style="color:#fff"></i> Sales
                                Report</a> </li>
                        <li><a href=" password.php"><i class="icon-key icon-2x" style="color:red"></i> My Password</a>
                        </li>
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
                <ul class="breadcrumb">
                    <li class="active">
                 
                    </li>
                </ul>
                <div id="mainmain">

                <a href="#"><i class="icon-money icon-2x"
                            style="color:green"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_cash_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>CASH SALES</span>
                    </a>
                    <a href="#"><i class="icon-mobile-phone icon-2x"
                            style="color:green"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_bgas_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>M-PESA Till SALES</span>
                    </a>
                    <a href="#"><i class="icon-mobile-phone icon-2x"
                            style="color:#900C3F"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_equity_paybill_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>EQUITY PAYBILL</span>
                    </a>
                    <a href="#"><i class="icon-credit-card icon-2x"
                            style="color:red"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_credit_sales; ?> </b> </span><br> <span
                            class='badge badge-success'>CREDIT SALES</span>
                    </a>
                    <a href="#"><i class="icon-money icon-2x"
                            style="color:grey;"></i><br>
                        <span class="c"> <b> Ksh. <?php echo $tot_amount; ?> </b> </span><br> <span
                            class='badge badge-success'>TODAYS TOTAL SALES</span>
                    </a>
                      <a href="salesreport.php?d1=0&d2=0"><i class="icon-money icon-2x"
                            style="color:grey;"></i><br>
                       <span>Sales Report </span>
                    </a>
                 <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include '../includes/footer.php'; ?>

</html>