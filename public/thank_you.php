<?php require_once("../resources/config.php"); ?>


<?php include (TEMPLATE_FRONT. DS . "header.php");?>
<?php

if(isset($_GET['tx'])){

  $amount = $_GET['amt'];
  $currency = $_GET['cc'];
  $transaction = $_GET['tx'];
  $status = $_GET['st'];

  $query = query("INSERT INTO orders VALUES(NULL,$amount,$transaction,'$status','$currency')");
  confirm($query);
  session_destroy();
}else {
  redirect("index.php");
}

report();
 ?>

 <h1 class="text-center"> Thank you</h1>
<?php include(TEMPLATE_FRONT.DS.'footer.php');?>
