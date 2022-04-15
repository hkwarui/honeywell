<?php
require_once "auth.php";
include_once "../includes/db_connect.php";
include_once "../includes/header.php";

//Format money function
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

//Get last insertedID 
$sql = $db->prepare("SELECT max(transaction_id) FROM sales_order");
$sql->execute();
$row = $sql->fetchColumn();

//Get the invoice no.
$sql1 = $db->prepare("SELECT invoice FROM sales_order WHERE transaction_id ='$row'");
$sql1->execute();
$row1 = $sql1->fetchColumn();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table,
    th,
    td,
    tr {
        border: 1px solid black;
        border-collapse: collapse;
    }

    table.center {
        margin-left: auto;
        margin-right: auto;
    }
    </style>
</head>

<body>
    <div class="container" style="width:100%; font-size:12px">

        <center>
            <p><b>KIKI EMPIRE OUTLETS 2<br>Wholesale & Retail<br>Tel: 0722-679-288</b></p>
        </center>
        <div class="tablediv" style="text-align: center;">
            <table class=" table table-condensed center" cellpadding="1px" cellspacing="4px"
                style="width:auto; font-size:12px;">
                <p>RCT: <?php echo $row1 ?> <span style="text-align: right;margin-left:3px"><b> </b>Date:
                        <?php echo date('d/m/y H:i') ?>
                    </span>
                </p>
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
                    $result->bindParam(':userid', $row1);
                    $result->execute();
                    while ($row2 = $result->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><small><?php echo ucwords($row2['product_name']) ?></small></td>
                        <td><?php echo $row2['qty'] ?></td>
                        <td><?php echo formatMoney($row2['price'], true) ?></td>
                        <td><?php echo formatMoney($row2['amount'], true) ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" style="text-align:right;"> <strong>Total</strong></td>
                        <?php
                        $result1 = $db->prepare("SELECT sum(amount) as total FROM sales_order WHERE invoice=
                        :userid");
                        $result1->bindParam(':userid', $row1);
                        $result1->execute();
                        $row3 = $result1->fetchColumn()
                        ?>
                        <td colspan="1">
                            <strong><?php echo formatMoney($row3, true) ?></strong>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <center>
            <p></br>Goods onces sold are not refundable</p>
        </center>
    </div>
</body>

</html>