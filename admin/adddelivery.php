<?php
  include 'auth.php';
  $delivery_id =  $_GET['id'];
?>

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveadddelivery.php" method="post">
  <center>
    <h4><i class="icon-plus-sign icon-large"></i> Delivery from <?php echo $_GET['name']; ?></h4>
  </center>
  <hr>
  <div id="ac">
   
     <input type="hidden" name='sup_id' value="<?php echo $_GET['id']; ?>" />
     <input type="hidden" name='sup_name' value="<?php echo $_GET['name']; ?>" />
    <span>Delivery date: </span><input type="date" style="width:265px; height:30px;" name="delivery_date" required /><br>
    <span>Amount: </span><input type="text" style="width:265px; height:30px;" name="amount" required/><br>
    <span>Status: </span>  <select name="status" style="width:265px; height:30px;">
        <option value="pending">Pending</option>
        <option value="paid">Paid</option>
    </select>  
    <span>Note : </span><textarea style="width:265px; height:80px;" name="note" /></textarea><br>
    <hr>
    <div style="float:right; margin-right:10px;">
    <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
        Save</button>
    </div>
  </div>
</form>
