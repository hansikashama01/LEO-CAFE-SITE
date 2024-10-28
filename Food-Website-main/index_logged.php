<?php
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the username is not set
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant_website";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission for order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order"])) {
    // Get the form data
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $unit_price = $_POST['unit_price'];
    $quantity = $_POST['quantity'];
    $total_price = $unit_price * $quantity;

    // Fetch user_id based on the username from the user table
    $username = $_SESSION['username'];
    $userQuery = "SELECT user_id FROM user WHERE first_name = '{$_SESSION['username']}'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $user_id = $userData['user_id'];

        // Insert data into the cart table
        $insertQuery = "INSERT INTO cart (user_id, item_id, item_name, quantity, price) VALUES ('$user_id', '$item_id', '$item_name', '$quantity', '$unit_price')";

        if ($conn->query($insertQuery) === TRUE) {
            echo '<p>Item added to the cart successfully.</p>';
        } else {
            echo '<p>Error adding item to the cart: ' . $conn->error . '</p>';
        }
    } else {
        echo '<p>Error fetching user data.</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    
    <link rel="icon" href="image/favicon.png">

</head>
<body>

<!-- header section starts  -->

<header class="header">

<a href="#" class="logo"> <i class="fas fa-hamburger"></i> LEO CAFE </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#popular">popular</a>
        <a href="#menu">menu</a>
        <a href="#order">order</a>
        <a href="#blogs">blogs</a>
    </nav>

    <div class="icons" style="display: flex;flex-direction: row;">
    <div id="menu-btn" class="fas fa-bars"></div>
    <div id="search-btn" class="fas fa-search"></div>
    <div style = " background-color: rgb(243, 243, 243); transition: color 0.3s, background-color 0.3s;" onmouseover="this.style.color='white'; this.style.backgroundColor='#27ae60'" onmouseout="this.style.color='#27ae60'; this.style.backgroundColor=' rgb(243, 243, 243)'">    <a href = "cart.php" class= "fas fa-shopping-cart"  style="font-size: 20px; color: #27ae60; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#27ae60'" ></a></div>
    <div style = " background-color: rgb(243, 243, 243); transition: color 0.3s, background-color 0.3s;" onmouseover="this.style.color='white'; this.style.backgroundColor='#27ae60'" onmouseout="this.style.color='#27ae60'; this.style.backgroundColor=' rgb(243, 243, 243)'">    <a href = "index.php" class= "fas fa-sign-out-alt"  style="font-size: 20px; color: #27ae60; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#27ae60'" ></a></div>
</div>

</header>

<!-- header section ends  -->

<!-- search-form  -->

<section class="search-form-container">

    <form action="">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>

</section>

<!-- shopping-cart section  -->

<section class="shopping-cart-container">

    <div class="products-container">

        <h3 class="title">your products</h3>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="image/menu-1.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <span> quantity : </span>
                    <input type="number" name="" value="1" id="">
                    <br>
                    <span> price : </span>
                    <span class="price"> $40.00 </span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="image/menu-2.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <span> quantity : </span>
                    <input type="number" name="" value="1" id="">
                    <br>
                    <span> price : </span>
                    <span class="price"> $40.00 </span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="image/menu-3.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <span> quantity : </span>
                    <input type="number" name="" value="1" id="">
                    <br>
                    <span> price : </span>
                    <span class="price"> $40.00 </span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="image/menu-4.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <span> quantity : </span>
                    <input type="number" name="" value="1" id="">
                    <br>
                    <span> price : </span>
                    <span class="price"> $40.00 </span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="image/menu-5.png" alt="">
                <div class="content">
                    <h3>delicious food</h3>
                    <span> quantity : </span>
                    <input type="number" name="" value="1" id="">
                    <br>
                    <span> price : </span>
                    <span class="price"> $40.00 </span>
                </div>
            </div>

        </div>

    </div>

    <div class="cart-total">

        <h3 class="title"> cart total </h3>

        <div class="box">

            <h3 class="subtotal"> subtotal : <span>$200</span> </h3>
            <h3 class="total"> total : <span>$200</span> </h3>

            <a href="#" class="btn">proceed to checkout</a>

        </div>

    </div>

</section>

<!-- login-form  -->

<div class="login-form-container">

    <form action="login.php">
        <h3>Login Form</h3>
        <input type="username" name="" placeholder="enter your username" id="" class="box">
        <input type="password" name="" placeholder="enter your password" id="" class="box">
        <div class="remember">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me">remember me</label>
        </div>
        <input type="submit" value="login now" class="btn">
        <p>Forget password? <a href="#">Click here</a></p>
        <p>Don't have an account? <a href="signup-form.html">Create one</a></p>
    </form>

</div>




<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <span>welcome LEO CAFE</span>
        <h3>spices for various tastes</h3>
        <p>Discover the Genuine Charm of LEO CAFE. Indulge in the Delectable Flavors of LEO CAFE.</p>
        <a href="#" class="btn">order now</a>
    </div>

    <div class="image">
        <img src="image/home-img.png" alt="" class="home-img">
        <img src="image/home-parallax-img.png" alt="" class="home-parallax-img">
    </div>

</section>

<!-- home section ends  -->

<!-- category section starts  -->

<section class="category">
   <a href="#" class="box">
      <img src="image/cat-3.png" alt="">
      <h3>burger</h3>
   </a>

   <a href="#" class="box">
       <img src="image/cat-5.png" alt="">
       <h3>dinner</h3>
   </a>

    <a href="#" class="box">
        <img src="image/cat-2.png" alt="">
        <h3>pizza</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-4.png" alt="">
        <h3>chicken</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-6.png" alt="">
        <h3>coffee</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-1.png" alt="">
        <h3>combo</h3>
    </a>

</section>

<!-- category section ends -->


<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="image/about-img.png" alt="">
    </div>

    <div class="content">
        <span>why choose us?</span>
        <h3 class="title">what's make our food delicious!</h3>
        <p>It's all about the smell, the taste, how it looks, is it crunchy and how does it feel in mouth. </p>
        <a href="#" class="btn">read more</a>
        <div class="icons-container">
            <div class="icons">
                <img src="image/serv-1.png" alt="">
                <h3>fast delivery</h3>
            </div>
            <div class="icons">
                <img src="image/serv-2.png" alt="">
                <h3>fresh food</h3>
            </div>
            <div class="icons">
                <img src="image/serv-3.png" alt="">
                <h3>best quality</h3>
            </div>
            <div class="icons">
                <img src="image/serv-4.png" alt="">
                <h3>24/7 support</h3>
            </div>
        </div>
    </div>

</section>

<!-- about section ends -->

<!-- popular section starts  -->


<!-- popular section ends -->

<!-- banner section starts  -->

<section class="banner">

    <div class="row-banner">
        <div class="content">
            <span>double cheese</span>
            <h3>burger</h3>
            <p>with fries and cocacola</p>
            <a href="#" class="btn">order now</a>
        </div>
    </div>

    <div class="grid-banner">
        <div class="grid">
            <img src="image/banner-1.png" alt="">
            <div class="content">
                <span>special offer</span>
                <h3>upto 20% off</h3>
                <a href="#" class="btn">order now</a>
            </div>
        </div>
        <div class="grid">
            <img src="image/banner-2.png" alt="">
            <div class="content center">
                <span>special offer</span>
                <h3>upto 50% extra</h3>
                <a href="#" class="btn">order now</a>
            </div>
        </div>
        <div class="grid">
            <img src="image/banner-3.png" alt="">
            <div class="content">
                <span>limited offer</span>
                <h3>100% cashback</h3>
                <a href="#" class="btn">order now</a>
            </div>
        </div>
    </div>

</section>

<!-- banner section ends -->

<!-- menu section starts  -->

<section class="menu" id="menu">

    <div class="heading">
        <span>our menu</span>
        <h3>our dishes</h3>
    </div>

<?php
    // Fetch food items from the database
    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="box-container">'; // Start of the container

        while ($row = $result->fetch_assoc()) {
            // Generate image path based on food name
            $imagePath = 'image/' . $row['item_name'] . '.png';

            // Display each food item using a loop
            echo '<div class="box">';
            echo '<img src="' . $imagePath . '" alt="' . $row['item_name'] . '" class="food-img">';
            echo '<div class="content">';
            echo '<h3>' . $row['item_name'] . '</h3>';
            echo '<div class="price">Rs.' . $row['price'] . '</div>';
            echo '<form method="post" action="">'; // Assuming you have a separate script for processing orders

            // Hidden input fields to pass data to the processing script
            echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
            echo '<input type="hidden" name="item_name" value="' . $row['item_name'] . '">';
            echo '<input type="hidden" name="unit_price" value="' . $row['price'] . '">';

            // Quantity selector
            echo '<label for="quantity">Quantity:</label>';
            echo '<input type="number" name="quantity" value="1" min="1" style="width: 90px;">';

            // Order Now button
            echo '<button type="submit" name="order" style="background-color:#27ae60;color:black;margin-top:20px;border-radius:20px;padding:10px">Order Now</button>';

            echo '</form>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>'; // End of the container
    } else {
        echo '<p>No food items available.</p>';
    }

    $conn->close();
?>



</section>

<!-- menu section ends -->

<!-- order section starts  -->

<section class="order" id="order">

    <div class="heading">
        <span>order now</span>
        <h3>fastest home delivery</h3>
    </div>

    <div class="icons-container">

        <div class="icons">
            <img src="image/icon-1.png" alt="">
            <h3>8:00am to 11:00pm</h3>
        </div>

        <div class="icons">
            <img src="image/icon-2.png" alt="">
            <h3>++94 767018488</h3>
        </div>

        <div class="icons">
            <img src="image/icon-3.png" alt="">
            <h3>Kandy,Sri lanka  - 27800</h3>
        </div>

    </div>

    <form action="">

        <div class="flex">
            <div class="inputBox">
                <span>Enter your name</span>
                <input type="text" placeholder="Enter customer's name" name="" id="">
            </div>
            <div class="inputBox">
                <span>Enter your number</span>
                <input type="number" placeholder="Enter customer's number" name="" id="">
            </div>
        </div>

        <div class="flex">
            <div class="inputBox">
                <span>Enter your order</span>
                <input type="text" placeholder="Enter food you want" name="" id="">
            </div>
            <div class="inputBox">
                <span>Enter how much</span>
                <input type="number" placeholder="Enter number or orders" name="" id="">
            </div>
        </div>

        <div class="flex">
            <div class="inputBox">
                <span>Enter your details</span>
                <input type="text" placeholder="Enter your message" name="" id="">
            </div>
            <div class="inputBox">
                <span>Enter time</span>
                <input type="datetime-local">
            </div>
        </div>

        <div class="flex">
            <div class="inputBox">
                <textarea placeholder="Enter your address" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="inputBox">
                 <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d302505.9279915257!2d80.77179421830126!3d7.612665551436988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae32b616dbd7463%3A0xf2cc3c90b6ef7403!2sSri%20Lanka!5e0!3m2!1sen!2sin!4v1634657480465!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>

            </div>
        </div>

        <input type="submit" value="proceed to order" class="btn">

    </form>

</section>

<!-- order section ends -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <div class="heading">
        <span>our blogs</span>
        <h3>our stories</h3>
    </div>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <h3> <i class="fas fa-calendar"></i> 19th December, 2021 </h3>
                <img src="image/blog-1.jpg" alt="">
            </div>
            <div class="content">
                <div class="tags">
                    <a href="#"> <i class="fas fa-tag"></i> food / </a>
                    <a href="#"> <i class="fas fa-tag"></i> burger / </a>
                    <a href="#"> <i class="fas fa-tag"></i> pizza  </a>
                </div>
                <h3>Chicken Burgers</h3>
                <p>Bread crumbs and milk keep these chicken burgers unbelievably moist and flavourful.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <h3> <i class="fas fa-calendar"></i> 15th February, 2022 </h3>
                <img src="image/blog-4.png" alt="">
            </div>
            <div class="content">
                <div class="tags">
                    <a href="#"> <i class="fas fa-tag"></i> food / </a>
                    <a href="#"> <i class="fas fa-tag"></i> burger / </a>
                    <a href="#"> <i class="fas fa-tag"></i> pizza  </a>
                </div>
                <h3>Delicious Pizza</h3>
                <p>Pizza with a topping of chicken pieces loaded with extra cheese</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <h3> <i class="fas fa-calendar"></i> 25th April, 2022 </h3>
                <img src="image/blog-3.jpg" alt="">
            </div>
            <div class="content">
                <div class="tags">
                    <a href="#"> <i class="fas fa-tag"></i> food / </a>
                    <a href="#"> <i class="fas fa-tag"></i> burger / </a>
                    <a href="#"> <i class="fas fa-tag"></i> pizza  </a>
                </div>
                <h3>Burger with Fries</h3>
                <p>Burger with chicken slice and delicious cheese layered on top, plus a side of fries</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

    </div>

</section>

<!-- blogs section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="newsletter">
        <h3>newsletter</h3>
        <form action="">
            <input type="email" name="" placeholder="Enter your email" id="">
            <input type="submit" value="subscribe">
        </form>
    </div>

    <div class="box-container">

        <div class="box">
            <h3>menu</h3>
            <a href="#"><i class="fas fa-arrow-circle-right"></i> pizza</a>
            <a href="#"><i class="fas fa-arrow-circle-right"></i> burger</a>
            <a href="#"><i class="fas fa-arrow-circle-right"></i> chicken</a>
            <a href="#"><i class="fas fa-arrow-circle-right"></i> pasta</a>
            <a href="#"><i class="fas fa-arrow-circle-right"></i> and more...</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#home"> <i class="fas fa-arrow-circle-right"></i> home</a>
            <a href="#about"> <i class="fas fa-arrow-circle-right"></i> about</a>
            <a href="#popular"> <i class="fas fa-arrow-circle-right"></i> popular</a>
            <a href="#menu"> <i class="fas fa-arrow-circle-right"></i> menu</a>
            <a href="#order"> <i class="fas fa-arrow-circle-right"></i> order</a>
            <a href="#blogs"> <i class="fas fa-arrow-circle-right"></i> blogs</a>
        </div>

        <div class="box">
            <h3>additional links</h3>
            <a href="#"> <i class="fas fa-arrow-circle-right"> </i> my order</a>
            <a href="#"> <i class="fas fa-arrow-circle-right"> </i> my account</a>
            <a href="#"> <i class="fas fa-arrow-circle-right"> </i> my favorite</a>
            <a href="#"> <i class="fas fa-arrow-circle-right"> </i> terms of use</a>
            <a href="#"> <i class="fas fa-arrow-circle-right"> </i> privary policy</a>
        </div>

        <div class="box">
            <h3>opening hours</h3>
            <p>monday : 8:00am to 11:00pm</p>
            <p>tuesday : 8:00am to 11:00pm</p>
            <p>wednesday : 8:00am to 11:00pm</p>
            <p>thursday : 8:00am to 11:00pm</p>
            <p>friday : 8:00am to 11:00pm</p>
            <p>saturday and sunday closed</p>
        </div>

    </div>

    <div class="bottom">

        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>

        <div class="credit"> &copy;1948<span> LEO CAFE</span>  all rights reserved </div>

    </div>

</section>

<!-- footer section ends -->

















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
