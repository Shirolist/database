
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>About</title>
</head>
<style>
    /* Set dark background color for the page */

    .content {
      padding: 20px;
      background-color: #292929;
    }

    .content h2 {
      font-size: 24px;
      margin-bottom: 10px;
      color:white ;
    }

    .content p {
      margin-bottom: 20px;
      color:white ;
    }

    .content ul {
      margin-bottom: 20px;
      color:white;
    }

    .content li {
      list-style-type: disc;
      margin-left: 20px;
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
    <div class="content">
        <h2>Welcome to our website!</h2>
        <p>We are a team of passionate individuals who are dedicated to providing the best possible service to our customers.</p>

        <h2>Our Mission</h2>
        <p>Our mission is to provide high-quality products and services to our customers while maintaining the highest standards of professionalism and integrity.</p>

        <h2>Our Team</h2>
        <p>We have a team of 3 highly skilled professionals who are committed to providing excellent customer service and delivering exceptional results. Each member of our team brings a unique set of skills and experiences to the table, allowing us to offer a diverse range of products and services.</p>

        <h2>Contact Us</h2>
        <p >If you have any questions or comments, please feel free to contact us using the information below:</p>
        
        <h2 >Contact Us</h2>
        <p>If you have any questions or comments, please feel free to contact us using the information below:</p>
        <ul>
          <li>Phone: 54-0-88 </li>
          <li>Email: 54088@ourcompany.com</li>
          <li>10 Lo Ping Road, Tai Po, New Territories, Hong Kong</li>
        </ul>

        <h2>Our Location</h2>
        <p>We are located in the heart of 10 Lo Ping Road, Tai Po, New Territories, Hong Kong, just a few blocks away from the main square. Stop by and say hello!</p>
        <a href="https://www.google.com/maps">Get Directions</a>

        <h2>Our Hours</h2>
        <p>Monday - Friday: 9am - 5pm</p>
        <p>Saturday: 10am - 2pm</p>
        <p>Sunday: Closed</p>
    </div>
    <footer class="footer" id="Footer"></footer>
</body>
</html>
<script src="footer.js"></script>