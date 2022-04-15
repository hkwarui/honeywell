<?php require_once 'auth.php';?>

<link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
<style>
.required label {
    font-weight: bold;
}

.required label:after {
    color: #e32;
    content: ' *';
    display: inline;
}
</style>
<form action="saveproduct.php" method="post">
    <center>
        <h4><i class="icon-plus-sign icon-large"></i> Add Product</h4>
    </center>
    <hr>
    <div id="ac">
        <span>Product Name : </span><input type="text" style="width:265px; height:30px;" name="prod_name"
            required /><br>
        <span> Description : </span><textarea style="width:265px; height:50px;" name="desc"> </textarea><br>
        <span>Selling Price : </span><input type="text" id="txt1" style="width:265px; height:30px;" name="price"
            onkeyup="sum();" Required><br>
        <span>Original Price : </span><input type="text" id="txt2" style="width:265px; height:30px;" name="o_price"
            onkeyup="sum();" Required><br>
        <span>Profit : </span><input type="text" id="txt3" style="width:265px; height:30px;" name="profit" readonly><br>
        <span>Quantity : </span><input type="number" min="0" style="width:265px; height:30px;" min="0" id="txt11"
            onkeyup="sum();" name="qty" Required><br>
        <span></span><input type="hidden" style="width:265px; height:30px;" id="txt22" name="qty_sold" Required><br>
        <div style="float:right; margin-right:10px;">
            <button class="btn btn-success btn-block btn-large" style="width:267px;"><i
                    class="icon icon-save icon-large"></i> Save</button>
        </div>
    </div>
</form>