<?php
require_once 'auth.php';

include '../includes/db_connect.php';
$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
<link href="../static/css/styles.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditproduct.php" method="post">
    <center>
        <h4><i class="icon-edit icon-large"></i> Edit Product</h4>
    </center>
    <hr>
    <div id="ac">
        <input type="hidden" name="memi" value="<?php echo $id; ?>" />
        <span>Product Name : </span><input type="text" style="width:265px; height:30px;" name="prod_name"
            value="<?php echo $row['product_name']; ?>" Required /><br>
        <span> Description : </span><textarea style="width:265px; height:50px;"
            name="desc"><?php echo $row['description']; ?> </textarea><br>
        <span>Selling Price : </span><input type="text" style="width:265px; height:30px;" id="txt1" name="price"
            value="<?php echo $row['price']; ?>" onkeyup="sum();" Required /><br>
        <span>Original Price : </span><input type="text" style="width:265px; height:30px;" id="txt2" name="o_price"
            value="<?php echo $row['o_price']; ?>" onkeyup="sum();" Required /><br>
        <span>Profit : </span><input type="text" style="width:265px; height:30px;" id="txt3" name="profit"
            value="<?php echo $row['profit']; ?>" readonly><br>
        <span>QTY Left: </span><input type="number" min=0 style="width:265px; height:30px;" min="0" name="qty"
            value="<?php echo $row['qty']; ?>" /><br>
        <div style="float:right; margin-right:10px;">

            <button class="btn btn-success btn-block btn-large" style="width:267px;"><i
                    class="icon icon-save icon-large"></i> Save Changes</button>
        </div>
    </div>
</form>
<?php
}
?>