<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "int4087";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (isset($_SESSION['password']) && isset($_SESSION['user_name'])) {
    #debugging
    #echo "success";
} else {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="../style.css" rel="stylesheet" type="text/css" />
    <style>
    img {
        height: 400px;
    }
    .footer {
        background-color: #020202;
        padding: 20px;
        text-align: center;
        font-size: 18px;
        color: #555;
        margin-top: 50px;
    }

    .footer p {
        margin-bottom: 10px;
        color:white;
    }

    .footer a {
        color: #007bff;
        text-decoration: none;
    }

    #credits {
        font-weight: bold;
    }

    #poll {
        margin-top: 20px;
    }

    #poll p {
        margin-bottom: 10px;
    }

    #poll input[type="radio"] {
        margin-right: 5px;
    }


    .social-icons {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .social-icons li {
        margin: 0 10px;
    }

    .social-icons a {
        color: #555;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #007bff;
    }
    </style>
    <script>
        function redirectToIndex() {
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 5000); // Redirect to index.php after 5 seconds
        }
    </script>
</head>
<body>
    <header>
      <div class="logo">
        <img src="../logo.jpg" alt="Website Logo">
      </div>

      <nav>
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../shop.php">Shop</a></li>
          <li><a href="../about.php">About</a></li>
          <?php
            if(isset($_SESSION["user_name"])){
              echo '<li><a href="../active/destroy.php">Logout</a></li>';
            }else{
              echo '<li><a href="../create_account.php">Login/Register</a></li>';
            }
          ?>
          <li><a href="../cart.php">Cart</a></li>
        </ul>
      </nav>
    </header>
    
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>
    
    <div class="checkout">
        <h2>Checkout</h2>
        <?php    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form data and complete the checkout
            $address = $_POST['address'];
            $payment_type = $_POST['payment_method'];
            $customer_id = $_SESSION['user_id'];
            $quantity = $_SESSION['quantity'];
            $product_id = $_SESSION['product_id'];
            
            $insertQuery = "INSERT INTO payment (payment_type, customer_id, customer_address)
                        VALUES ('$payment_type', '$customer_id', '$address')";

            
       
            if (mysqli_query($conn, $insertQuery)) {
                // Deleting data from shopping_cart and shopping_item tables
                $deleteCartQuery = "DELETE FROM shopping_cart WHERE customer_id = '$customer_id'";
                $deleteItemQuery = "DELETE FROM shopping_item";

                if (mysqli_query($conn, $deleteCartQuery) && mysqli_query($conn, $deleteItemQuery)) {
                    echo '<p>Thank you for your order!</p>';
                    echo '<img src="payment-successful.png" alt="Payment Successful">';
                    echo '<script>redirectToIndex();</script>'; // Call the JavaScript function to redirect after 5 seconds

                    #$result = $conn->query($sql);
                    $sql = "SELECT payment_id FROM payment WHERE customer_id = '$customer_id' ORDER BY payment_id DESC LIMIT 1";
                    $stmt = mysqli_prepare($conn, $sql);
                  
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $payment_id);
                        if (mysqli_stmt_fetch($stmt)) {

                            echo "Fetched payment_id: " . $payment_id; // Debugging line to ensure $payment_id is fetched
                        } else {
                            echo "No payment found for the specified customer.";
                        }
                    } else {
                        echo "Error executing statement: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt); 
                    $insertsql = "INSERT INTO transaction_report (customer_id, payment_id, product_id, quantity)
                                  VALUES ('$customer_id', '$payment_id', '$product_id', '$quantity')";
                    if ($conn->query($insertsql) === TRUE) {
                        echo "<br>Transaction reported created successfully.";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    /* #list all of data one record by one record
                    $payment_ids = array();
                    if (mysqli_stmt_fetch($stmt)) {
                         while (mysqli_stmt_fetch($stmt)) {
                            $payment_ids[] = $payment_id;
                        }
                        mysqli_stmt_close($stmt);
                        foreach ($payment_ids as $id) {
                            echo "Payment ID: " . $id . "<br>";
                        }
                    } else {
                        echo "No payment found for the specified customer.";
                    }*/
                    

                } else {
                    echo 'Error deleting cart and item data: ' . mysqli_error($conn);
                }
            }else {
                echo 'Error inserting payment data: ' . mysqli_error($conn);
            }
            
            mysqli_close($conn);
                
        } else {
            // Display the checkout form
            echo '<form method="POST" action="checkout.php">';
            echo '<label for="address">Address:</label>';
            echo '<textarea id="address" name="address" required></textarea><br>';
            echo '<label for="payment_method">Payment Method:</label>';
            echo '<select id="payment_method" name="payment_method" required>';
            echo '<option value="American Express">American Express</option>';
            echo '<option value="Visa Card">Visa Card</option>';
            echo '<option value="Mater Card">Mater Card</option>';
            echo '<option value="Apple Pay">Apple Pay</option>';
            echo '</select><br>';
            echo '<input type="submit" value="Pay">';
            echo '</form>';
            echo '<img src="payment.jpg" alt="payment">';
        }
        ?>
    </div>

</body>
</html>