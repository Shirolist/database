<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Validate the form data, customer must need to put all in the field
    if (empty($username) || empty($email) || empty($hash)) {
        echo "Please fill in all the fields.";
    } else {
        // Connect to your database (Replace database credentials with your own)
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "int4087";
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

        // Check the database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the username or email already exists in the database
        $checkQuery = "SELECT * FROM customer WHERE customer_name='$username' OR customer_email='$email'";
        $result = $conn->query($checkQuery);
        if ($result->num_rows > 0) {
            echo "Username or email already exists.";
        } else {
            //Insert the user data into the database
            $insertQuery = "INSERT INTO `customer` (`customer_name`, `customer_email`, `customer_password`) 
                            VALUES ('$username', '$email', '$hash');";
            echo "$insertQuery";
            if ($conn->query($insertQuery) === TRUE) {
                echo "Account created successfully.";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
        /*
          // Close the database connection
          $conn->close(); */
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <style>
        #register {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 480px;
            padding: 56px;
            box-sizing: border-box;
            border: 1px solid #dadce0;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }

        input {
            padding: 3px;
            box-shadow: 3px 3px 5px grey;
            font-size: 14px;
            font-weight: 600;
            width: 300px;
        }
        label {
            color: #ffcc00;
            font-weight: bold;
            width: 130px;
            float: left;
            font-size: 20px;
        }
        .loginbutton {
            border: none;
            outline: none;
            color: blue;
            background-color: whitesmoke;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            float: none;
        }
        input[type="submit"] {
            border: none;
            outline: none;
            color: #fff;
            background-color: #1a73e8;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
        }
        input[type="submit"]:hover {
            background-color: #287ae6;
            box-shadow: 0 1px 1px 0 rgba(66,133,244,0.45), 0 1px 3px 1px rgba(66,133,244,0.3);
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
                    <li><a href="create_account.php">Login/Register</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </nav>
        </header>

        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>

        <h2>Create Account</h2>
        <form id="register" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <fieldset>
                <label>Username:</label>
                <input type="text" name="username" required><br><br>

                <label>Email:</label>
                <input type="email" name="email" required><br><br>

                <label>Password:</label>
                <input type="password" name="password" required><br><br>

                <button class="loginbutton" type="button" onclick="location.href = 'login.php';">Log in</button>
                <input type="submit" value="Create Account">
            </fieldset>
        </form>
    </body>
</html>