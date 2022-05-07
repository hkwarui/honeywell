<?php
include 'auth.php';

include '../includes/db_connect.php';
$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM  credits  WHERE id  = :userid");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
<link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditcreditsales.php" method="post">
  <center>
    <h4><i class="icon-edit icon-large"></i> Edit Credit Sales</h4>
  </center>
  <hr>
  <div id="ac">
    <input type="hidden" name="memi" value="<?php echo $id; ?>" />
    <span>ID Number : </span><input type="text" style="width:265px; height:30px;" name="id_number" value="<?php echo $row['id_number']; ?>"  readonly/><br>
    <span>Full Name : </span><input type="text" style="width:265px; height:30px;" name="name"
      value="<?php echo $row['customer_name']; ?>" /><br>
    <span>Invoice No. : </span><input type="text" style="width:265px; height:30px;" name="invoice_no"
      value="<?php echo $row['invoice_no']; ?>" readonly/><br>
    <span>Note : </span><input type="text" style="width:265px; height:30px;" name="note"
      value="<?php echo $row['note']; ?>" /><br>
    <span>Amount : </span><input type="number" style="width:265px; height:30px;" name="amount"
      value="<?php echo $row['amount']; ?>" readonly/><br>
    <span>Expected Date : </span><input type="text" style="width:265px; height:30px;" name="expected_date"
      value="<?php echo $row['expected_date']; ?>" /><br>
      <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
        Save Changes</button>
    </div>
  </div>
</form>
<?php
}
?>