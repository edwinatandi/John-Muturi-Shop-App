<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online shopping for muturi</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background: #fff;">


	<?php
	include'connect_db.php';
	include'myApi.php';
   $user_id = $_SESSION['user_id'];

// if the user is not loged in, open login page
   if(!isset($user_id)){
      header('location:login.php');
      }
	if(isset($alert)){
		foreach ($alert as $alert) {
			echo'<div class="alert" onclick="this.remove();">'.$alert.'</div>';
		}
	}
	?>
	<div class="col-md-12">
		<div class="col-md-12 shopName">
         <div class="col-md-9">
            <center><h2><b>JOHN MUTURI SHOPPING APPLICATION</b></h2></center>
         <?php
         $logged_user = mysqli_query($conn,"SELECT `id`, `name`, `email`, `password` FROM `user_info` WHERE id = '$user_id' ") or die('no user data found');

         if(mysqli_num_rows($logged_user)>0){
            $fetc_user_details = mysqli_fetch_assoc($logged_user);
         };
         ?>
         </div>
			
			<div class="col-md-3">
            
         <a href="index.php?logout=<?php echo $user_id;?>" onclick = "return confirm('are you sure you want to logout');" class="btn-primary mybtn">logout</a>
         </div>
	
</div>
	
<div class="col-md-7">
	<center><h2><b>Shop item Catalog</b></h2></center>
		<div class="products">
         <?php
            $select_product = mysqli_query($conn, "SELECT * FROM `items`") or die('query failed');
            if(mysqli_num_rows($select_product) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_product))
            {
         ?>
         <div class="col-md-4">
            <div class="inner-div">
            <center>
            <form method="post" class="form-group" action="">
               <div ><?php echo $fetch_product['item_name']; ?></div>
               <div ><b>Ksh : </b><?php echo $fetch_product['item_price'];?></div>
               <input type="number" min="1" name="item_qty" value="1">
               <input class="form-control" type="hidden" name="item_name" value="<?php echo $fetch_product['item_name']; ?>">
               <input type="hidden" name="item_price" value="<?php echo $fetch_product['item_price']; ?>">
               <input type="hidden" name="user_id" visibility="hidden" value="<?php echo $user_id ?>">
               <input type="submit" style="margin-top:3px;" value="addToCart" name="addToCart" class="btn-primary mybtn">
      </form>
            </center>
               
            </div>
            
         </div>
         
   <?php
      };
   };
   ?>

   </div>

</div>

<div class="col-md-5 userCart">
	<center><h3><b>Your Cart items</b></h3></center>
	<table class="table table-bordered">
    <thead scope="row ">
         <th scope="col">name</th>
         <th scope="col">price</th>
         <th scope="col">quantity</th>
         <th scope="col">total price</th>
         <th scope="col">action</th>
      </thead>

      <tbody>
         <?php
            $cart_query = mysqli_query($conn, "SELECT * FROM `cart_items` WHERE user_id = '$user_id'") or die('query failed');
            $grand_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
         ?>
         <tr>
            <td><?php echo $fetch_cart['item_name']; ?></td>
            <td><?php echo $fetch_cart['item_price']; ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['item_qty']; ?>">
                  <input type="hidden" name="user_id" visibility="hidden" value="<?php echo $user_id ?>">
                  <input  type="submit" name="update_cart" value="update" class=" btn-primary mybtn">
               </form>
               <td><?php echo $sub_total = ($fetch_cart['item_price'] * $fetch_cart['item_qty']); ?></td>
               <td><a href="myApi.php?remove=<?php echo $fetch_cart['id']; ?>" class="btn-danger mybtn" onclick="return confirm('remove item from cart?');">remove</a></td>
            </td>
            

         </tr>
         <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="3">Total :</td>
         <td><b>Ksh : </b><?php echo $grand_total; ?></td>
      </tr>
      </tbody>  
   </table>
   <div class="cart-btn">  
      <center><a href="#" class="btn-primary mybtn" <?php echo ($grand_total > 1)?'':'disabled'; ?>>proceed to checkout</a></center>
   </div>
   
</div>
<center>
   <a href="#" id="myBtns" class="btn-success mybtn" <?php echo ($grand_total > 1)?'':'disabled'; ?>>Add Item</a>
   <a href="order.php" class="btn-warning mybtn" <?php echo ($grand_total > 1)?'':'disabled'; ?>>View Orders</a></center>

<div id="myModal" class="modal">
  <div class="modal-content">
      <span class="close">&times;</span>
      <div class="modal-body">
      <div class="col-md-12">
         <div class="col-md-6"style="width: 70%;">
            <h3><b>Add New Item</b></h3>
            <form action="myApi.php" method="post">
               <br>
               <label for="itemName">Item Name</label>
               <input id="itemName" type="text" placeholder="Item Name" name="name" class="form-control">
               <br>
               <label for="itemPrice">Item Price</label>
               <input id="itemPrice" type="text" placeholder="Item Price" name="price" class="form-control">
               <br>
               <a href="addItem.php"><input type="submit" class="btn-primary" name="newItem" value="Submit"></a>
            </form>
         </div>
      </div>
    </div>
    <div class="modal-footer"></div>
   </div>
</div>

<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtns");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>