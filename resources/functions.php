<?php
//helper functions

function setMessage($msg){
  if(!empty($msg)){
    $_SESSION['message'] = $msg;
  }else {
    $msg = '';
  }
}

function displayMessage(){
  if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}
function redirect($location){
  header("Location: $location");
}

function last_id(){
  global $connection;
  return mysqli_insert_id($connection);
}
function query($sql){
global $connection;
  return mysqli_query($connection, $sql);
}

function confirm($result){
  global $connection;
  if(!$result){
    die("QUERY FAILED ". mysqli_error($connection));
  }
}

function escape_string($string){
  global $connection;
  return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result){

  return mysqli_fetch_array($result);
}
//******************************** FRONT END FUNCTIONS ************************************
//get products
function get_products(){
  $query = query('SELECT * FROM products');
  confirm($query);

  while($row = fetch_array($query)){
  $product = <<<DELIMETER

      <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
            <a href='item.php?id={$row['product_id']}'><img src="{$row['product_image']}" alt=""></a>
            <div class="caption">
                <h4 class="pull-right">{$row['product_price']} KM</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>See more snippets like this online store item at </p>
                <a class="btn btn-primary" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
            </div>

        </div>
        </div>
DELIMETER;
 echo  $product;
 }
}

function get_categories(){
  $query = query("SELECT * FROM categories");
  confirm($query);
  while($row = fetch_array($query)){
    $category_list = <<<DELIMETER

    <a href="category.php?id={$row['cat_id']}" class="list-group-item">{$row["cat_title"]}</a>

DELIMETER;
echo $category_list;

}
}

function get_categories_navbar(){
  $query = query("SELECT * FROM categories");
  confirm($query);
  while($row = fetch_array($query)){
    $category_list = <<<DELIMETER
    <li>
        <a href="category.php?id={$row['cat_id']}">{$row["cat_title"]}</a>
    </li>
DELIMETER;
echo $category_list;

}
}

function get_products_in_cat_page(){
  $query = query('SELECT * FROM products WHERE product_category_id='.escape_string($_GET['id']).' ');
  confirm($query);
  while($row = fetch_array($query)){

    $category_list_products = <<<DELIMETER

    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}</h3>
                <p>{$row['product_description']}</p>
                <p>
                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>

DELIMETER;
echo $category_list_products;

}
}

function get_products_in_shop_page(){
  $query = query('SELECT * FROM products');
  confirm($query);
  while($row = fetch_array($query)){

    $category_list_products = <<<DELIMETER

    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}</h3>
                <p>{$row['product_description']}</p>
                <p>
                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>

DELIMETER;
echo $category_list_products;

}
}

function login_user(){


if(isset($_POST['submit'])){

$username = escape_string($_POST['username']);
$password = escape_string($_POST['password']);

$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password }' ");
confirm($query);

if(mysqli_num_rows($query) == 0) {
  setMessage("Your pass or username is wrong");
redirect("login.php");


} else {
  $_SESSION['username']=$username;
redirect("admin");

         }
    }
}

function send_message(){
  if(isset($_POST['submit'])){
    $to        = "ademdinarevic@gmail.com";
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $subject   = $_POST['subject'];
    $message   = $_POST['message'];

    $headers = "From: {$name} {$email}";

    $result = mail($to, $subject, $message, $headers);

    if(!$result){
      echo 'Working';
    }else {
      echo 'error';
    }
}
}
//******************************** BACK END FUNCTIONS ************************************
function display_orders(){



$query = query("SELECT * FROM orders");
confirm($query);


while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>




DELIMETER;

echo $orders;



    }
}
//******************************** ADMIN PRODUCTS ************************************

function get_products_in_admin(){
  $query = query('SELECT * FROM products');
  confirm($query);

  while($row = fetch_array($query)){
  $product = <<<DELIMETER

  <tr>
        <td>{$row['product_id']}</td>
        <td>{$row['product_title']}<br>
          <a href="index.php?edit_product&id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        </td>
        <td>Category</td>
        <td>{$row['product_price']}</td>
        <td>{$row['product_quantity']}</td>
        <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>

    </tr>
DELIMETER;
 echo  $product;
 }
}

?>
