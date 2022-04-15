<?php 
 require_once 'auth.php';
 require_once '../includes/db_connect.php';

 $id = $_GET['id'];

 // Pick credit info
 $result = $db->prepare('SELECT * FROM credits WHERE id = ? ');
 $result->execute([$id]);
 $row = $result -> fetch();

  
 ?>

<html>

<head>
    <title>Checkout</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
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

      <script src="../static/js/application.js"></script>

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
    </style>
</head>

<body >
    <form action="pay_invoice.php" method="post">
        <div id="ac">
            <center>
                <h4><i class="icon icon-money icon-large"></i>  Pay for invoice: <?php echo $row['invoice_no']; ?></h4>
            </center>
            <hr>
            <input type="hidden" name="invoice" value="<?php echo $row['invoice_no']; ?>" />
            <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>" />
            <center>
                <p><?php echo 'Amount:  KSH '. $row['amount'] ?></p>
                <input type="text"  style="width: 268px; height:30px;"  value="<?php echo $row['customer_name']?>" readonly/>
                            

                <input type="number" name="cash" min=<?php echo $row['amount'];?> max=<?php echo $row['amount']; ?> placeholder="Cash"
                    style="width: 268px; height:30px;  margin-bottom: 15px;" required /><br>
              <button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i>
                    Save</button>
            </center>
        </div>
    </form>
</body>

</html>