<?php
require_once("../../config.php");

if(isset($_GET['id'])){
  $query = query("DELETE FROM products where product_id= ".escape_string($_GET['id'])." ");
  confirm($query);
  setMessage("Product deleted");
  redirect("../../../public/admin/index.php?products");
}else {
  redirect("../../../public/admin/index.php?products");
}
 ?>
