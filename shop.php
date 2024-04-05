<html>
    <head>
        <title>Shopping now</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <style>
        .categories {
            background-color: #f7f7f7;
            padding: 20px;
        }

        .categories h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .categories ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .categories li {
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .categories li a {
            display: block;
            padding: 8px 16px;
            background-color: #f0c14b;
            color: #111;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .item-picture {
            margin-top: 20px;
            text-align: center;
        }

        .item-picture img {
            max-width: 200px;
        }
        .add-to-cart {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
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
                    session_start();
                    if (isset($_SESSION["user_name"])) {
                        echo '<li><a href="active/destroy.php">Logout</a></li>';
                    } else {
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

        <div class="categories">
            <h2>Categories</h2>
            <ul>
                <li><a href="?category=cpu">CPU</a></li>
                <li><a href="?category=motherboard">Motherboard</a></li>
                <li><a href="?category=ram">RAM</a></li>
                <li><a href="?category=hard-drive">Hard Drive</a></li>
                <li><a href="?category=graphics-card">Graphics Card</a></li>
                <li><a href="?category=power-supply">Power Supply</a></li>
                <li><a href="?category=monitor">Monitor</a></li>
                <li><a href="?category=keyboard">Keyboard</a></li>
                <li><a href="?category=mouse">Mouse</a></li>
            </ul>
        </div>
        <?php
        
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "int4087";
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        // Get the item picture element
        $itemImg = "";

        // Check if a category is selected
        if (isset($_GET['category'])) {
            $category = $_GET['category'];

            // Map the category to the corresponding folder
            $categoryFolder = "";

            switch ($category) {
                case "cpu":
                    $categoryFolder = "CPU";
                    break;
                case "motherboard":
                    $categoryFolder = "Motherboard";
                    break;
                case "ram":
                    $categoryFolder = "RAM";
                    break;
                case "hard-drive":
                    $categoryFolder = "Hard Drive";
                    break;
                case "graphics-card":
                    $categoryFolder = "Graphics Card";
                    break;
                case "power-supply":
                    $categoryFolder = "Power Supply";
                    break;
                case "monitor":
                    $categoryFolder = "Monitor";
                    break;
                case "keyboard":
                    $categoryFolder = "Keyboard";
                    break;
                case "mouse":
                    $categoryFolder = "Mouse";
                    break;
            }

            $dir = 'product/' . $categoryFolder . '/';
            $scanned_directory = array_diff(scandir($dir), array('..', '.'));

            print_r($scanned_directory);
            // only debugging
            // Generate the image source path
            //$itemImg = "product/" . $categoryFolder . "/" . $_GET['category'] . ".jpg"; // Replace "images/" with your image directory
            //echo $itemImg;

            $rowCounter = 0;
            echo '<div class="row">'; // Start the first row
            foreach ($scanned_directory as $t) {
                // Retrieve the product_picture based on the selected $t from the 'product' table
                $query = "SELECT product_picture FROM product WHERE product_picture = '$t'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the product_picture from the result
                    $row = mysqli_fetch_assoc($result);
                    $itemImg = $row['product_picture'];
                    $image = "product/". $categoryFolder ."/$t";

                    echo '<div class="item-picture">';
                    echo '  <img id="item-img" src="'. $image .'" alt="Item Picture">';
                    echo '  <form method="POST" action="shop.php">'; // Add a form around the button
                    echo '      <input type="hidden" name="product_picture" value="' . $itemImg . '">'; // Pass the product_picture as a hidden input
                    echo '      <input name="quantity" type="number" value="1" min="1">';
                    echo '      <button class="add-to-cart" type="submit" name="add_to_cart">Add to Cart</button>';
                    echo '  </form>';
                    echo '</div>';

                    $rowCounter++;
                    if ($rowCounter % 4 == 0) { // Start a new row after every 4 items
                        echo '</div>'; // Close the current row
                        echo '<div class="row">'; // Start a new row
                    }
                }
            }
            echo '</div>'; // Close the last row
        }
        if(isset($_SESSION['user_id'])){
           
            // Check if the "Add to Cart" button is clicked and the product_picture is submitted
            if (isset($_POST['add_to_cart']) && isset($_POST['product_picture'])) {
                $product_picture = $_POST['product_picture'];

                // Retrieve the product_id and product_price based on the selected product_picture from the 'product' table
                $query = "SELECT product_id, product_price FROM product WHERE product_picture = '$product_picture'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the product_id and product_price from the result
                    $row = mysqli_fetch_assoc($result);
                    $product_id = $row['product_id'];
                    $product_price = $row['product_price'];

                    // Check if the product_id already exists in the 'shopping_item' table
                    $check_query = "SELECT COUNT(*) as count FROM shopping_item WHERE product_id = '$product_id'";
                    $check_result = mysqli_query($conn, $check_query);

                    if ($check_result) {
                        $check_row = mysqli_fetch_assoc($check_result);
                        $count = $check_row['count'];
                        $customer_id = $_SESSION['user_id'];
                        $quantity = $_POST['quantity'];

                        if ($count > 0) {
                            // The product_id already exists in the cart
                            echo "Product was already added.";
                        } else {
                            // Insert the product_id and product_price into the 'shopping_item' table
                            $insert_query = "INSERT INTO shopping_item (product_id, product_price) VALUES ('$product_id', '$product_price')";
                            $insert_query2 = "INSERT INTO shopping_cart (customer_id, product_id, quantity) VALUES ('$customer_id', '$product_id', '$quantity')";
                            $insert_result = mysqli_query($conn, $insert_query);
                            $insert_result2 = mysqli_query($conn, $insert_query2);

                            if ($insert_result && $insert_result2) {
                                // The product was successfully added to the cart
                                echo "Product added to cart!";
                            } else {
                                // There was an error inserting the product into the cart
                                echo "Error adding product to cart: " . mysqli_error($conn);
                            }
                        }
                    } else {
                        // Error occurred while checking the existence of the product_id in the cart
                        echo "Error checking product in cart: " . mysqli_error($conn);
                    }
                } else {
                    // Product with the specified product_picture was not found
                    echo "Product not found!";
                }
            }
        
        }else{
            echo '<script>alert("Please go to login first")</script>'; 
        }

        mysqli_close($conn);
        ?>
        <footer class="footer" id="Footer"></footer>
    </body>
</html>
<script src="footer.js"></script>
