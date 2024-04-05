<?php
session_start(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "int4087";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
    // Insert the shopping item into the shopping_cart table
    $sql = $conn->prepare("INSERT INTO shopping_cart (customer_id, product_id, quantity, product_price) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ii", $customer_id, $product_id,$product_price);
    
    $customer_id = $_SESSION['user_id'];
    
    if ($sql->execute()) {
        // Insert successful
        echo "Item added to cart.";
    } else {
        // Insert failed
        echo "Failed to add item to cart.";
    }
}
    
?>