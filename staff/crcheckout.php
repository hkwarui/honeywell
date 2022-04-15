<?php 
require_once 'auth.php';
require_once '../includes/db_connect.php';

$transaction_type = 'credit_sales';
$cname = 'Henry Warui';

//Create default expected date;
$expected_date  = strtotime(date('d-M-Y'));
$expected_date = strtotime('+7 day', $expected_date);
?>

<html>

<head>
    <title>Checkout</title>
    
    <script>
    function suggest(inputString) {
        if (inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
            $('#country').addClass('load');
            $.post("autosuggestname.php", {
                queryString: "" + inputString + ""
            }, function(data) {
                if (data.length > 0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#country').removeClass('load');
                }
            });
        }
    }

    function fill(thisValue) {
        $('#country').val(thisValue);

    }
    setTimeout("$('#suggestions').fadeOut();", 600);
    </script>

    <style>
    #result {
        height: 20px;
        font-size: 16px;
        font-family: Arial, Helvetica, sans-serif;
        color: #333;
        padding: 5px;
        margin-bottom: 10px;
        background-color: #FFFF99;
    }

    #country {
        border: 1px solid #999;
        background: #EEEEEE;
        padding: 5px 10px;
        box-shadow: 0 1px 2px #ddd;
        -moz-box-shadow: 0 1px 2px #ddd;
        -webkit-box-shadow: 0 1px 2px #ddd;
    }

    .suggestionsBox {
        position: absolute;
        left: 10px;
        margin: 0;
        width: 268px;
        top: 40px;
        padding: 0px;
        background-color: #000;
        color: #fff;
    }

    .suggestionList {
        margin: 0px;
        padding: 0px;
    }

    .suggestionList ul li {
        list-style: none;
        margin: 0px;
        padding: 6px;
        border-bottom: 1px dotted #666;
        cursor: pointer;
    }

    .suggestionList ul li:hover {
        background-color: #FC3;
        color: #000;
    }

    ul {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #FFF;
        padding: 0;
        margin: 0;
    }

    .load {
        background-image: url(loader.gif);
        background-position: right;
        background-repeat: no-repeat;
    }

    #suggest {
        position: relative;
    }

    .combopopup {
        padding: 3px;
        width: 268px;
        border: 1px #CCC solid;
    }
   
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  outline: 1px solid #ddd;
  width: 268px; 
  height:50px;
}

/* #myInput:focus {
    outline: 1px solid #ddd;
    width: 268px; 
    height:50px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 238px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  /* padding: 12px 16px; */
  /* text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;} */ */
</style>

</head>

<body onLoad="document.getElementById('country').focus();">
    <form action="savesales.php" method="post">
        <div id="ac">
            <center>
                <h4><i class="icon icon-money icon-large"></i> Credit Sale</h4>
            </center>
            <hr>
            <input type="hidden" name="date" value="<?php echo date("m/d/y"); ?>" />
            <input type="hidden" name="transaction_type" value="<?php echo $transaction_type; ?>" />
            <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
            <input type="hidden" name="amount" value="<?php echo $_GET['total']; ?>" />
            <input type="hidden" name="ptype" value="<?php echo $_GET['pt']; ?>" />
            <input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
            <input type="hidden" name="profit" value="<?php echo $_GET['totalprof']; ?>" />
             <input type="hidden" name="cname" value="<?php echo $cname; ?>" />
            <center>
                

                <label for="customer_info"></label>   
                <select  name="id_number" id='myInput'  style="width:268px; height:30px;" required>
                                  <?php 
                             $cust_info = $db->prepare("SELECT * FROM customer");
                             $cust_info->execute();
                            for ($i = 0; $row = $cust_info->fetch(); $i++) {  ?>
                              <option value="<?php echo $row['id_number']; ?>"><?php echo $row['customer_name'].'-'.$row['id_number']; ?></option>
                            <?php } ?>
                </select>

                  <label for="due"> Due Date</label>         
                <input type="date" name="due" value="<?php echo date('d-M-Y',$expected_date); ?>" placeholder="Due Date"
                    style="width: 268px; height:30px; margin-bottom: 15px;" /><br>

                 <input type="textarea" name="note" placeholder="Note"
                    style="width: 268px; height:50px;  margin-bottom: 15px;" /><br>
                <?php

?><button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
                    Save</button>
            </center>
        </div>
    </form>
</body>

</html>