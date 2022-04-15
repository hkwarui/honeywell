<?php
require_once 'auth.php';
include '../includes/db_connect.php';

?>

<html>

<head>
	<title>
		Honey Well | Collection
	</title>
	<?php include '../includes/header.php';?>
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
</head>

<body>
	<?php include '../includes/navfixed.php';?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li class="active"><a href="#"><i class="icon-dashboard icon-2x" style="color:#29D87E"></i>
								Dashboard </a>
						</li>
						<li><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i
									class="icon-shopping-cart icon-2x" style="color:#DB691C"></i>
								Sales</a> </li>
						<li><a href=" products.php"><i class="icon-list-alt icon-2x" style="color:blue"></i>
								Products</a> </li>
						<li><a href=" customer.php"><i class="icon-group icon-2x" style="color:green"></i> Customers</a>
						</li>
						<li><a href=" supplier.php"><i class="icon-group icon-2x" style="color:yellow"></i>
								Suppliers</a> </li>
						<li><a href=" salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"
									style="color:#fff"></i> Sales
								Report</a> </li>
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

	<div class="span10">
		<div class="contentheader">
			<i class="icon-bar-chart"></i> Collection Report
		</div>
		<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Collection Report</li>
		</ul>

		<div id="maintable">
			<div style="margin-top: -19px; margin-bottom: 21px;">
				<a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i
							class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			</div>
			<form action="collection.php" method="get">
				From : <input type="text" name="d1" style="width: 223px; padding:14px;" class="tcal" value="" /> To:
				<input type="text" style="width: 223px; padding:14px;" name="d2" class="tcal" value="" />
				<button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;" type="submit"><i
						class="icon icon-search icon-large"></i> Search</button>
				<button style="width: 123px; height:35px; margin-top:-2px; float:right;"
					class="btn btn-success btn-large"><a href="javascript:Clickheretoprint()"><i
							class="icon icon-print icon-large"></i> Print</a></button>
			</form>
			<div class="content" id="content">
				<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
					Collection Report from&nbsp;<?php echo $_GET['d1'] ?>&nbsp;to&nbsp;<?php echo $_GET['d2'] ?>
				</div>
				<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
					<thead>
						<tr>
							<th width="17%"> Transaction ID </th>
							<th width="8%"> Date </th>
							<th width="25%"> Customer Name </th>
							<th width="25%"> Invoice Number </th>
							<th width="15%"> Amount </th>
							<th width="10%"> Remarks </th>
						</tr>
					</thead>
					<tbody>

						<?php

$d1 = $_GET['d1'];
$d2 = $_GET['d2'];
$result = $db->prepare("SELECT * FROM sales WHERE date BETWEEN :a AND :b");
$result->bindParam(':a', $d1);
$result->bindParam(':b', $d2);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
						<tr class="record">
							<td>CTI-000<?php echo $row['transaction_id']; ?></td>
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['invoice_number']; ?></td>
							<td><?php
$dsdsd = $row['amount'];
    echo formatMoney($dsdsd, true);
    ?></td>
							<td><?php echo $row['remarks']; ?></td>
						</tr>
						<?php
}
?>

					</tbody>
					<thead>
						<tr>
							<th colspan="4" style="border-top:1px solid #999999"> Total </th>
							<th colspan="2" style="border-top:1px solid #999999">
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
$d1 = $_GET['d1'];
$d2 = $_GET['d2'];
$results = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN :a AND :b");
$results->bindParam(':a', $d1);
$results->bindParam(':b', $d2);
$results->execute();
for ($i = 0; $rows = $results->fetch(); $i++) {
    $dsdsd = $rows['sum(amount)'];
    echo formatMoney($dsdsd, true);
}
?>
							</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="clearfix"></div>
		</div>
</body>
<?php include '../includes/footer.php';?>

</html>