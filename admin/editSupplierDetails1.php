<?php 
    include 'auth.php';
    include '../includes/db_connect.php';

    $id = $_GET['id'];
    $result1 = $db->prepare("SELECT * FROM supplier_details WHERE id = :userid");
    $result1->bindParam(':userid', $id);
    $result1->execute();
?>

<link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
<?php 
  for ($i = 0; $row1 = $result1->fetch(); $i++) {
?>

<form action="saveeditcustomer.php" method="post">
  <?php
    echo $id;
  ?>  
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
      value="<?php echo $row['contact']; ?>" />
      <br>
      <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
        Save Changes</button>
    </div>
  </div>
</form>
<?php
}
?>