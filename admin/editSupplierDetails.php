<?php 
include '../admin/auth.php';

include '../includes/db_connect.php'
$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM supplier_details WHERE id_number= :userid");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    ?>

<link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditcustomer.php" method="post">
  <center>
    <h4><i class="icon-edit icon-large"></i> Edit Customer</h4>
  </center>
  <hr>
  <div id="ac">
    <input type="hidden" name="memi" value="<?php echo $id; ?>" />
    <span>Full Name : </span><input type="text" style="width:265px; height:30px;" name="name"
      value="<?php echo $row['customer_name']; ?>" /><br>
    <span>Address : </span><input type="text" style="width:265px; height:30px;" name="address"
      value="<?php echo $row['address']; ?>" /><br>
    <span>Contact : </span><input type="number" style="width:265px; height:30px;" name="contact"
      value="<?php echo $row['contact']; ?>" /><br>
      <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
        Save Changes</button>
    </div>
  </div>
</form>
<?php
}
?>