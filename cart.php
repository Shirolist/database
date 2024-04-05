<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "int4087";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
// Get the item picture element
$itemImg = "";

if (isset($_SESSION['password']) && isset($_SESSION['user_name'])) {
#debugging
} else {
    header("Location: index.php");
    exit();
}

if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];

    // Remove the item from the shopping_item table
    $delete_query = "DELETE FROM shopping_item WHERE product_id = $product_id";
    mysqli_query($conn, $delete_query);
    
    $delete_query = "DELETE FROM shopping_cart WHERE product_id = $product_id";
    mysqli_query($conn, $delete_query);
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>

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
</head>
<body>
    <header>
      <div class="logo">
        <img src="logo.jpg" alt="Website Logo">
      </div>

      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="about.php">About</a></li>
          <?php
            if(isset($_SESSION["user_name"])){
              echo '<li><a href="active/destroy.php">Logout</a></li>';
            }else{
              echo '<li><a href="create_account.php">Login/Register</a></li>';
            }
          ?>
          <li><a href="cart.php">Cart</a></li>
        </ul>
      </nav>
    </header>
    
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>
    
    <div class="cart-items">
        <h2>Shopping Cart</h2>
        <?php
        // Fetch items from the shopping_item table with product details
        $query = "SELECT
                    p.product_id,
                    p.product_name,
                    si.product_price,
                    sc.quantity,
                    (si.product_price * sc.quantity) AS total_cost
                  FROM
                    product p
                  JOIN
                    shopping_cart sc ON p.product_id = sc.product_id
                  JOIN
                    shopping_item si ON p.product_id = si.product_id;";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <tr>
                        <th>Product Name</th>
                        <th>Price(each)</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                    </tr>';
            
            $totalCostSum = 0;
            
            while ($row = mysqli_fetch_assoc($result)) {
                
                $product_id = $row['product_id'];
                $_SESSION['product_id'] = $row['product_id'];
                $product_name = $row['product_name'];
                $price = $row['product_price'];
                $quantity = $row['quantity'];
                $_SESSION['quantity'] = $row['quantity'];
                $cost = $row['total_cost'];
                $totalCostSum += $cost;

                echo "<tr>";
                echo "<td>$product_name</td>";
                echo "<td>$price</td>";
                echo "<td>$quantity</td>";
                echo "<td>$cost</td>";
                echo "<td><button onclick='removeItem($product_id)'>Remove</button></td>";
                echo "</tr>";
            }
            
            echo '</table>';
            
            echo '<div class="total-cost">
                    <p>Total Cost: $'.$totalCostSum.'</p>
                  </div>';
            
            echo '<button onclick=location.href="payment/checkout.php">Checkout</button>';
            
        } else {
            echo "Your cart is empty.";
        }
        

        ?>

        <script>
        function removeItem(productId) {
            // Send an AJAX request to the server to remove the item from the cart
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Reload the page to update the cart items
                    location.reload();
                }
            };
            xhr.send("remove=true&product_id=" + productId);
        }
        </script>
    </div>
</body>
</html>