<?php
    require_once 'auth.php';
    require_once '../includes/db_connect.php';

    //Create default expected date;
    $expected_date  = strtotime(date('d-M-Y'));
    $expected_date = strtotime('+7 day', $expected_date);

    $date = date("Y-m-d", strtotime($_POST['date']));
    $a = $_POST['invoice'];
    $b = $_POST['cashier'];
    $c = $date;
    $d = $_POST['transaction_type'];
    $e = $_POST['amount'];
    $z = $_POST['profit'];
    $cname = $_POST['cname'];

    echo $cname;

    /**
     * Credit sale checkout 
     */

    if ($d == 'credit_sales') {
        $dt = date('Y-m-d',strtotime($_POST['due']));
        $f = isset($dt) ? $dt : date('Y-m-d',$expected_date);
        $g = $_POST['note'];
        $i = $_POST['id_number'];

        $result = $db->prepare("SELECT customer_name FROM customer WHERE id_number = ?");
        $result->execute([$i]);
        $h = $result->fetchColumn();

        $sql = "INSERT INTO sales (invoice_number,cashier,`date`,`type`,amount,profit,due_date,`name`) VALUES (:a,:b,:c,:d,:e,:z,:f,:g)";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':z' => $z, ':f' => $f, ':g' => $cname));

        $sql1 = "INSERT INTO credits (customer_name, id_number, invoice_no ,note, expected_date, amount) VALUES (:h, :i, :a, :g, :f, :e)";
        $q1 = $db->prepare($sql1);
        $q1->execute(array(':h' => $h, ':i'=> $i, ':a' =>$a,  ':g' =>$g, ':f' =>$f, ':e' => $e));

        header("location: preview.php?invoice=$a");
        exit();
    }

    /**
     * Cash sales checckout
     */

    if ($d == 'cash_sales') {
        $h = $_POST['cash_tendered'] ;
        $f = $h - $e;
       $sql = "INSERT INTO sales (invoice_number,cashier,`date`,`type`,amount,profit,balance,`name`,cash_tendered) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:h)";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':z' => $z, ':f' => $f, ':g' => $cname, ':h'=> $h));
        header("location: preview.php?invoice=$a");
        exit();
    }

    /**
     * Mobile payment checkout
     */

    if ($d == 'buy_goods_and_services'){
        $sql = "INSERT INTO sales (invoice_number,cashier,`date`,`type`,amount,profit,`name`) VALUES (:a,:b,:c,:d,:e,:z,:g)";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':z' => $z, ':g' => $cname));
        header("location: preview.php?invoice=$a");
        exit();
    }
    if($d='equity_paybill'){
        $sql = "INSERT INTO sales (invoice_number,cashier,`date`,`type`,amount,profit,`name`) VALUES (:a,:b,:c,:d,:e,:z,:g)";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':z' => $z,':g' => $cname));
        header("location: preview.php?invoice=$a");
        exit();
    }
?>