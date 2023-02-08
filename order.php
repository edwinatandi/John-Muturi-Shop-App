<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="col-md-12 userCart">
    <a href="index.php" class="btn-warning mybtn">Back</a>
  <center><h3><b>Orders</b></h3></center>
  <table class="table table-bordered">
    <thead scope="row ">
        <th scope="col">User Id</th>
         <th scope="col">name</th>
         <th scope="col">price</th>
         <th scope="col">quantity</th>
         <th scope="col">action</th>
      </thead>

      <tbody>
         <?php
         include 'connect_db.php';
            $cart_query = mysqli_query($conn, "SELECT * FROM `cart_items`") or die('query failed');
            $grand_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
         ?>
         <tr>
           <td><?php echo $fetch_cart['user_id']; ?></td>
            <td><?php echo $fetch_cart['item_name']; ?></td>
            <td><?php echo $fetch_cart['item_qty']; ?></td>    
            <td><?php echo $sub_total = ($fetch_cart['item_price'] * $fetch_cart['item_qty']); ?></td>
            <td><a href="#" class="btn-success mybtn" onclick="return confirm('Approve order?');">Approve</a></td>
            </td>
         </tr>
         <?php
      
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      </tbody>  
   </table>
</div>

</body>
</html>