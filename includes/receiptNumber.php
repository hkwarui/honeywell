<?php
include '../includes/db_connect.php';

    $result = $db->prepare("SELECT MAX(transaction_id) FROM sales");
    $result->execute();
    $invoiceId = $result->fetchColumn();
      $receiptTag = 'TS';
     $currentYear = date('y');
     $receiptNumber = (int)$invoiceId + 1;
     $invoiceNumber = $receiptTag.'-'.$currentYear.$receiptNumber;
    
  ?>