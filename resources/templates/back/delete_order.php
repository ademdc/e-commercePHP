<?php
require_once("../../config.php");

if(isset($_GET['id'])){
  $query = query("DELETE FROM orders where order_id= ".escape_string($_GET['id'])." ");
  confirm($query);
  setMessage("Order deleted");
  redirect("../../../public/admin/index.php?orders");
}else {
  redirect("../../../public/admin/index.php?orders");
}
 ?>
