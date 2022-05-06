<?php
  require 'auth.php';
  require_once '../includes/db_connect.php';
  require_once '../includes/receiptNumber.php';

?>
<html>

<head>
    <title>Suppliers</title>
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
    <!--sa poip up-->
    <script src="../static/jeffartagame.js" type="text/javascript" charset="utf-8"></script>
    <script src="../static/js/application.js" type="text/javascript" charset="utf-8"></script>
    <link href="../static/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../static/lib/jquery.js" type="text/javascript"></script>
    <script src="../static/src/facebox.js" type="text/javascript"></script>
    <script src="../static/js/application.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../static/src/loading.gif',
            closeImage: '../static/src/closelabel.png'
        })
    })
    </script>
</head>
<script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
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
// End -->
</SCRIPT>

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
                        <li class='active'><a href=" supplier.php"><i class="icon-group icon-2x"
                                    style="color:yellow"></i>
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
                    <i class="icon-group" style="color: yellow;"></i> Suppliers
                </div>
                <ul class="breadcrumb">
                </ul>


                <div style="margin-top: -19px; margin-bottom: 21px;">
                    <?php
                        $result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
                        $result->execute();
                        $rowcount = $result->rowcount();
                    ?>
                    <div style="text-align:center;">
                        Total Number of Suppliers: <font color="green" style="font:bold 22px 'Aleo';">
                            <?php echo $rowcount; ?>
                        </font>
                    </div>
                </div>
                <input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter"
                    placeholder="Search Supplier..." autocomplete="off" />
                <a rel="facebox" href="addsupplier.php"><Button type="submit" class="btn btn-info"
                        style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add
                    Supplier</button></a><br><br>
                <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
                    <thead>
                        <tr>
                            <th> Supplier </th>
                            <th> Contact Person </th>
                            <th> Address </th>
                            <th> Contact No.</th>
                            <th> Note</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $result = $db->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                         ?>
                        <tr class="record">
                            <td><?php echo $row['suplier_name']; ?></td>
                            <td><?php echo $row['contact_person']; ?></td>
                            <td><?php echo $row['suplier_address']; ?></td>
                            <td><?php echo $row['suplier_contact']; ?></td>
                            <td><?php echo $row['note']; ?></td>
                            <td>
                                <a rel="facebox" href="editsupplier.php?id=<?php echo $row['suplier_id']; ?>"><i
                                        class="icon-edit" title="Click to Edit" style="color:blue;"></i></a>
                                <a
                                    href="viewsupplier.php?id=<?php echo $row['suplier_id']; ?>&name=<?php echo $row['suplier_name']; ?>"><i
                                        class="icon-list" title="Click to See Details" style="color:grey;"></i></a>
                                <a href="#" id="<?php echo $row['suplier_id']; ?>" class="delbutton"
                                    title="Click To Delete"><i class="icon-trash" style="color:red;"></i> </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

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
            if (confirm("Are you sure want to delete? There is NO undo!")) {

                $.ajax({
                    type: "GET",
                    url: "deletesupplier.php",
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
</body>
<?php include '../includes/footer.php';?>

</html>