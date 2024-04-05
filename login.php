<?php
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (empty($username) || empty($password)) {
        echo "Please fill in all the fields.";
    } else {
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "int4087";
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if (password_verify($password, $row['customer_password'])) {
                $_SESSION['user_id'] = $row['customer_id'];
                $_SESSION['user_name'] = $row['customer_name'];
                $_SESSION['email'] = $row['customer_email'];
                $_SESSION['password'] = $password;
                header("location: cart.php");
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            $stmt = $conn->prepare("SELECT * FROM manager WHERE manager_id = ? AND manager_password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['manager_id'] = $username;
                header("location: livesearch/livesearch_index.php");
                exit();
            } else {
                echo "User not found.";
            }
        }

        $stmt->close();
        $conn->close();
    }
}

    
?>
<html>
<head>
    <title>Create Account</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

</head>
<style>
#login {
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
    <h2>Login form</h2>
        <form id="login" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Login Account">
        </fieldset>
    </form>
</body>
</html>
    