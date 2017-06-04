<?php require_once("config.php"); ?>
<?php include (TEMPLATE_FRONT. DS . "header.php");?>

<?php



if(isset($_GET['add'])){
  //$_SESSION['product_'.$_GET['add']]+=1;
  //redirect("index.php");

  $query = query('SELECT * FROM products WHERE product_id='.escape_string($_GET['add']));
  confirm($query);

  while($row=fetch_array($query)){
    if($row['product_quantity']!=$_SESSION['product_'.$_GET['add']]){
      $_SESSION['product_'.$_GET['add']]+=1;
      redirect('../public/checkout.php');
    }else{
      setMessage("There is no more of that product in the stock. Only ".$row['product_quantity'].' '.$row['product_title'].' items available');
      redirect('../public/checkout.php');
    }
  }
}



if(isset($_GET['remove'])){
  $_SESSION['product_'.$_GET['remove']]--;

  if($_SESSION['product_'.$_GET['remove']]<1){
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect('../public/checkout.php');
  }else{
    redirect('../public/checkout.php');
  }
}





if(isset($_GET['delete'])){
  $_SESSION['product_'.$_GET['delete']]='0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);
  redirect('../public/checkout.php');
}


function cart(){

$total = 0;
$item_quantity=0;
$item_name = 1;
$item_number = 1;
$amount = 1;
$quantity = 1;

foreach ($_SESSION as $name => $value) {

  if($value>0){


  if(substr($name,0,8)=='product_'){
    $length = strlen($name-8);
    $id = substr($name,8,$length);

    $query = query('SELECT * FROM products WHERE product_id='.escape_string($id)." ");
    confirm($query);

    while($row = fetch_array($query)){
      $subtotal = floatval($row['product_price'])*floatval($_SESSION['product_'.$id]);
      $item_quantity +=$value;
      $product = <<<DELIMETER
      <tr>
          <td>{$row['product_title']}</td>
          <td>{$row['product_price']} KM</td>
          <td>{$_SESSION['product_'.$id]}</td>
          <td>$subtotal KM</td>
          <td><a class='btn btn-md btn-warning' href='../resources/cart.php?remove={$row['product_id']}'><span class='glyphicon glyphicon-minus'></span></a></td>
          <td><a class='btn btn-md btn-success' href='../resources/cart.php?add={$row['product_id']}'><span class='glyphicon glyphicon-plus'></span></a></td>
          <td><a class='btn btn-md btn-danger' href='../resources/cart.php?delete={$row['product_id']}'><span class='glyphicon glyphicon-remove'></span></a></td>
      </tr>

      <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
      <input type="hidden" name="item_number_$item_number" value="{$row['product_id']}">
      <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
      <input type="hidden" name="quantity_{$quantity}" value="{$_SESSION['product_'.$id]}">
DELIMETER;
    echo $product;

    $item_name++;
    $item_number++;
    $amount++;
    $quantity++;
    }
    $total+=$subtotal;
    $_SESSION['item_total']=$total;
    $_SESSION['item_quantity']=$item_quantity;

  }
}
}
}

function show_paypal(){

  if(isset($_SESSION['item_quantity'])&& $_SESSION['item_quantity']>=1){
    $paypal_button = <<<DELIMETER
    <input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
DELIMETER;
  echo $paypal_button;
  }
  }

  function report(){

  $total = 0;
  $item_quantity=0;


  foreach ($_SESSION as $name => $value) {

    if($value>0){


    if(substr($name,0,8)=='product_'){
      $length = strlen($name-8);
      $id = substr($name,8,$length);

      $query = query('SELECT * FROM products WHERE product_id='.escape_string($id)." ");
      confirm($query);

      while($row = fetch_array($query)){
        $subtotal = floatval($row['product_price'])*floatval($_SESSION['product_'.$id]);
        $product_price = $row['product_price'];
        $item_quantity +=$value;

        $insert_report = query("INSERT INTO orders VALUES(NULL,$id,$product_price,'$status','$currency')");
        confirm($insert_report);


      }
      $total+=$subtotal;
      echo $item_quantity;

    }
  }
  }
  }

?>
