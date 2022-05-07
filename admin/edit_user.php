<?php
include 'auth.php';
include '../includes/db_connect.php';

$id = $_GET['id'];
$result = $db->prepare("SELECT * FROM user WHERE id= :userid");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    ?>
<link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="update_user.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit Customer</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
<span>Full Name : </span><input type="text" style="width:260px; height:30px;" name="name" value="<?php echo $row['name']; ?>" /><br>
<span>Username : </span><input type="text" style="width:260px; height:30px;" name="username" value="<?php echo $row['username']; ?>" /><br>
<span>Contact : </span><input type="text" style="width:260px; height:30px;" name="contact" value="<?php echo $row['contact']; ?>" /><br>
<span>Email : </span><input type="text" style="width:260px; height:30px;" name="email" value="<?php echo $row['email']; ?>" /><br>
<span>Category : </span><select name="category" style="width:260px; height:30px;">
<option value="<?php echo $row['category']; ?>"> <?php echo ($row['category'] == 2) ? "Cashier" : "Admin"; ?> </option>
<option value=1> Admin</option> <option value=2>Cashier</option>
</select><br>
<span>Status : </span><select  name="stat" style="width:260px; height:30px;">
<option value="<?php echo $row['stat']; ?>"> <?php echo ($row['stat'] == 0) ? "Disabled" : "Active"; ?> </option>
<option value=1> Active</option> <option value=0>Disable</option>
</select><br>   55
<span>Start Date: </span><input type="date" style="width:260px; height:30px;" name="date" value="<?php echo $row['date']; ?>" placeholder="Date"/><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>Update</button>
</div>
</div>
</form>
<?php
}
?>