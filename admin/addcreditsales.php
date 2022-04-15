
<?php
include '../admin/auth.php';
include '../includes/db_connect.php';

$result = $db->prepare("SELECT id_number FROM customer ORDER BY customer_name ASC");
$result->execute();
?>


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savecreditsales.php" method="post">
  <center>
    <h4><i class="icon-plus-sign icon-large"></i> Add Credit Sales</h4>
  </center>
  <hr>

  <div id="ac">
    <span>ID number : </span>
   <select name='id_number' id='id_number' style="width:265px; height:30px;" required> 
   <?php 
  for ($i = 0; $row = $result->fetch(); $i++) { ?>
        <option value=<?php echo $row['id_number'] ?>>
        <?php echo $row['id_number'] ?>
        </option>
        <?php } ?>
   </select>

    <span>Full Name : </span><input type="text" style="width:265px; height:30px;" id='customer_name' name="name" placeholder="Full Name"
      required /><br>
      <span>Product Name : </span><input type="text" style="width:265px; height:30px;" name="product_name"
      placeholder="ProductName" required /><br>
     <span>Note : </span><input type="text" style="width:265px; height:30px;" name="note"
      placeholder="Note" /><br>
      <span>Amount : </span><input type="number" style="width:265px; height:30px;" name="amount"
      placeholder="amount" required/><br>
      <span>Expected Date : </span><input type="date" style="width:265px; height:30px;" name="expected_date"
      placeholder="Expected Date"/><br>
      <div style="float:right; margin-right:10px;">
      <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
        Save</button>
    </div>
  </div>
</form>

<script src="../static/js/jquery.js"></script>
<script>
$('#id_number').change(function(){
   var info =  $('#id_number').val();
 alert('Th id number has been changed ')
   $.ajax({
       url: 'autofill.php',
       data: data,
       type:  'POST',
       success : function(result){
           console.log(result);
           $(#customer_name).val(result);
       }
   })

    })

</script>