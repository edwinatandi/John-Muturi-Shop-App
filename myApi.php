<?php
include'connect_db.php';
session_start();

// login user
if(isset($_POST['login'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }
   else{
      $alert[] = 'incorrect password or email!';
   }
}

// register new user
if(isset($_POST['register'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   if($pass== $cpass){

   $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $alert[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_info`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $alert[] = 'registered successfully!';
      header('location:login.php');
   }
   }
   else{
      $alert[] = 'password not matching!';
   }


}

// if one logs out
if(isset($_GET['logout'])){
	unset($user_id);
	session_destroy();
	header('location:login.php');
}
// create new Item
if(isset($_POST['newItem'])){
   $name = $_POST['name'];
   $price = $_POST['price'];
   mysqli_query($conn,"INSERT INTO `items`(`item_name`, `item_price`) VALUES ('$name ','$price')")or die('cannot fetch the items');
   header('location:index.php');

};
// add items to cart
if(isset($_POST['addToCart'])){
	$item_name = $_POST['item_name'];
	$item_price = $_POST['item_price'];
	$item_qty = $_POST['item_qty'];
   $user_id = $_POST['user_id'];

	$fetch_cart_items = mysqli_query($conn,   "SELECT * FROM `cart_items` WHERE item_name = '$item_name' AND user_id = '$user_id'") or die('cannot fetch the items');
	if(mysqli_num_rows($fetch_cart_items)>0){
		$alert[]="cart is not empty";
	}
	else{
		mysqli_query($conn,
			"INSERT INTO `cart_items`(user_id,item_name,item_price,item_qty)
			VALUES ('$user_id','$item_name','$item_price','$item_qty')")
			or die('adding items failed');

			$alert[] = 'item added to cart successfully';
	}
};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart_items` SET item_qty = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart_items` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart_items` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}


?>