<?php
    include 'auth.php';
    include '../includes/db_connect.php';

    $id = $_GET['delivery_id'];
    $result = $db->prepare("SELECT * FROM supplier_details WHERE id= :userid");
    $result->bindParam(':userid', $id);
    $result->execute();
?>

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />

<?php 
    for ($i = 0; $row = $result->fetch(); $i++) {
 ?>

<form action="saveeditdeliverly.php" method="post">
  <center>
    <h4><i class="icon-edit icon-large"></i> Edit Delivery Details</h4>
  </center>
  <hr>
  <div id="ac">
  <input type="hidden" name="memi" value="<?php echo $id; ?>" />
  <input type="hidden" name="supplier_id" value="<?php echo $row['supplier_id']; ?>" />
    <span>Amount (KES): </span><input type="text" style="width:265px; height:30px;" name="amount"
      value="<?php echo $row['amount']; ?>"disabled/><br>
    <span>Date : </span><input type="text" style="width:265px; height:30px;" name="date"
      value="<?php echo $row['delivery_date']; ?>" disabled/><br>
    <span>Status : </span><select  name="status" style="width:260px; height:30px;">
       <option value='<?php echo $row['status']?>'><?php echo $row['status']; ?></option>
       <option value='paid'>Paid</option>
       <option value='pending'>Pending</option>
    </select><br>
    <span>Note : </span><textarea style="width:265px; height:80px;"
      name="note"><?php echo $row['note']; ?></textarea>
      <br>
     <hr>
    <div style="float:right; margin-right:10px;">
     <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
        Save Changes</button>
    </div>
  </div>
</form>
<?php
}
?>