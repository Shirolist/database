<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "int4087";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
?>
 <?php

 $customer_id = $_GET["customer_id"];
 $sql = "SELECT * FROM `customer` where customer_id = $customer_id";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $customer_name = $row["customer_name"];
 $customer_email = $row["customer_email"];
 $customer_password = $row["customer_password"];
 $customer_address = $row["customer_address"];

        if (isset($_POST["submit"])){
            $customer_name = $_POST["customer_name"];
            $customer_email = $_POST["customer_email"];
            $customer_password = $_POST["customer_password"];
            $customer_address = $_POST["customer_address"];

            $sql = "update `customer` set customer_id = $customer_id, customer_name='$customer_name',
                                                                      customer_email='$customer_email',
                                                                      customer_password='$customer_password',
                                                                      customer_address='$customer_address' where customer_id = $customer_id";

            $result = mysqli_query( $conn, $sql );
            if($result) 
            { 
                header("location:crud_index.php");
            } else
            {
                die(mysqli_error($conn));
            }
        }
    ?>   
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <title>User Edit</title>
  </head>
  <body>
    <div class="container my-5">
    <form method="post">
    <div class="form-group">
        <label for="text">Name</label>
        <input type="name" class="form-control" placeholder="Enter your Name" name="customer_name" autocomplete="off" value="<?php echo $customer_name; ?>">
    </div>
    <div class="form-group">
        <label for="text">Email</label>
        <input type="email" class="form-control" placeholder="Enter your Email" name="customer_email" autocomplete="off" value="<?php echo $customer_email; ?>">
    </div>
    <div class="form-group">
        <label for="text">Password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="customer_password" autocomplete="off" value="<?php echo $customer_password; ?>">
    </div>
    <div class="form-group">
        <label for="text">Address</label>
        <input type="text" class="form-control" placeholder="Enter your Address" name="customer_address" autocomplete="off" value="<?php echo $customer_address; ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
    </div>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href);
    }
    </script>
  </body>
</html>