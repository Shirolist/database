<?php
    session_start();
?>
<html>
<head>
    <title>Main page</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .slider-container {
            height: 200px;
            margin: 0 auto;
            position: relative;
        }

        .slider {
            display: flex;
            overflow: hidden;
        }

        .slide {
            flex: 0 0 100%;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .product-slider {
            display: flex;
            overflow: hidden;
            width: 100%; /* Added to ensure the slider occupies the full width */
        }

        .product-slide {
            flex: 0 0 100%;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-slide img {
            max-width: 100%;
            height: auto;
        }
        
        #prevBtn, #nextBtn {
            position: absolute;
            top: 20%;
            transform: translateY(-50%);
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #prevBtn {
            left: 0;
        }

        #nextBtn {
            right: 0;
        }
        
        .image-container {
          display: flex;
          flex-wrap: wrap;
        }

        .image-wrapper {
          position: relative;
          margin: 10px;
        }

        .image-wrapper img {
          width: 200px;
          height: auto;
          margin-bottom: 10px;
        }

        .rating {
          position: absolute;
          bottom: 10px;
          left: 0;
          right: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          font-size: 20px;
          color: gold;
        }
          
        .about {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            font-size: 18px;
          }
        .text {
            flex: 1;
          }
        .about-img {
            margin-right: 20px;
          }
          
        .about-img img {
            height: 250px;
            width: auto;
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
</head>
<body>
    <header id = "Header">
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
    
    <div class="slideshow-container">
        <div class="slider">
            <div class="slide">
                <img src="index_slideshow/image1.jpg" alt="Image 1">
            </div>
            <div class="slide">
                <img src="index_slideshow/image2.jpg" alt="Image 2">
            </div>
            <div class="slide">
                <img src="index_slideshow/image3.jpg" alt="Image 3">
            </div>
        </div>
        <button id="prevBtn">< </button>
        <button id="nextBtn">> </button>
    </div>
    
    <div class = "about">
        <div class = "text">
            <h1>ABOUT Online shoper</h1>
            <p>
            Online shoper is a computer devices shopping platform that 
            offers a wide range of innovative and high-quality products 
            to make your computer more efficient. With our cutting-edge 
            technology and user-friendly interface, you can easily control 
            your computer and peripheral products from our website, anytime. 
            Shop now and experience the convenience and comfort of Online shoper!</p>
        </div>
        <div class="about-img">
            <img src="home.webp" alt="Website Logo">
        </div>
    </div>

    <section class="productslide">
        <h2 class="product-category">Best selling</h2>
            <?php
                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "int4087";
                $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
                $query = "SELECT * FROM `product` ORDER BY product_rate DESC LIMIT 10;";
                $result = mysqli_query($conn, $query);
                
                echo '<div class="image-container">';

                while ($row = mysqli_fetch_assoc($result)) {
                    $productType = $row['product_type'];
                    $productName = $row['product_name'];
                    $productRate = $row['product_rate'];
                    $imagePath = "product/$productType/$productName.jpg"; 
                    echo '<div class="image-wrapper">';
                    echo '  <img src="' . $imagePath . '" alt="' . $productName . '">';
                    echo '      <span class="rating">';
                    for($j=0;$j<5;$j++ ){
                        if($j<$productRate){ 
                            echo "★";
                        }else{
                            echo "☆";
                        }
                    }
                    
                    #echo '      <img src="' . $imagePath . '" alt="' . $productName . '">';
                    echo "  </span>";
                    echo '</div>';
                }

                echo '</div>';
            ?>

    </section>
    <footer class="footer" id="Footer"></footer>
    
    <script>
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        const slider = document.querySelector(".slider");
        const slides = document.querySelectorAll(".slide");

        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? "block" : "none";
            });
        }

        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        });

        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        });

        showSlide(currentIndex);
    </script>

</body>
</html>

<script src="footer.js"></script>