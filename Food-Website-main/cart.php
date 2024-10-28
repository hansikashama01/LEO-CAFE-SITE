<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .cart-container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .cart-section {
            padding: 20px;
        }

        .cart-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .ordered-items {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .ordered-item {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .delete-button {
            background-color: #ff5555;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cart-summary {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 10px;
        }

        select, button {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
    </style>
    <title>Cart</title>
</head>
<body>
    <div class="cart-container">
        <div class="cart-section">
            <h1 class="cart-title">Ordered Items</h1>
            <div class="ordered-items">
            <?php
                // Assuming you have a database connection established
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "restaurant_website";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Start the session
                session_start();

                // Check if the user_id key exists in the session
                if (isset($_SESSION['user_id'])) {
                    // Fetch user ID from the session
                    $userId = $_SESSION['user_id'];

                    // Fetch data from the cart table for the logged-in user
                    $sql = "SELECT * FROM cart WHERE user_id = $userId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="ordered-item">';
                            echo '<p>Quantity: ' . $row['quantity'] . '</p>';
                            echo '<p>Item Name: ' . $row['item_name'] . '</p>';
                            echo '<p>Unit Price: Rs. ' . $row['price'] . '</p>';
                            echo '<p>Total Price: Rs. ' . ($row['quantity'] * $row['price']) . '</p>';
                            echo '<form method="post" action="">';
                            echo '<input type="hidden" name="cart_id" value="' . $row['cart_id'] . '">';
                            echo '<button type="submit" name="delete" class="delete-button">Delete</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No items in the cart.</p>';
                    }

                    // Handle delete request
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
                        $cartItemId = $_POST['cart_id'];

                        // Delete the item from the cart table
                        $deleteQuery = "DELETE FROM cart WHERE cart_id = '$cartItemId'";
                        
                        if ($conn->query($deleteQuery) === TRUE) {
                            echo '<p>Item deleted from the cart successfully.</p>';
                            // Reload the page after deletion
                            echo '<script>window.location.reload();</script>';
                        } else {
                            echo '<p>Error deleting item from the cart: ' . $conn->error . '</p>';
                        }
                    }
                } else {
                    echo '<p>User ID not found in the session.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <div class="cart-summary">
        <h2>Order Summary</h2>
        <?php
    // Assuming you have a database connection established
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the cart table for the logged-in user
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $sql = "SELECT SUM(quantity * price) AS total, GROUP_CONCAT(cart_id) AS cart_ids FROM cart WHERE user_id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalAmount = $row['total'];
        $cartIds = $row['cart_ids'];
        echo '<p>Total Payable Amount: Rs. ' . $totalAmount . '</p>';
    } else {
        echo '<p>No items in the cart.</p>';
    }
    ?>
        <form method="post" action="">
            <label for="payment">Select Payment Method:</label>
            <select name="payment" id="payment">
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select>
            <button type="submit" name="submitPayment">Confirm Payment</button>
        </form>

        <?php
    // Handle payment submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitPayment"])) {
        $selectedPaymentMethod = $_POST['payment'];

        // Insert payment data into the payment table
        $insertPaymentQuery = "INSERT INTO payment (user_id, cart_id, total_payment, payment_type) 
                               VALUES ('$userId', '$cartIds', '$totalAmount', '$selectedPaymentMethod')";

        // Perform the payment insertion query
        if ($conn->query($insertPaymentQuery) === TRUE) {
            echo '<p>Payment successful!</p>';
            
            // Delete existing cart items
            $deleteCartItemsQuery = "DELETE FROM cart WHERE user_id = $userId";
            if ($conn->query($deleteCartItemsQuery) === TRUE) {
                echo '<p>Cart items deleted successfully.</p>';
            } else {
                echo '<p>Error deleting cart items: ' . $conn->error . '</p>';
            }

            // Redirect to index_2.php
            header("Location: index_logged.php");
            exit();
        } else {
            echo '<p>Error inserting payment data: ' . $conn->error . '</p>';
        }
    }

    // Close connection after the payment query
    $conn->close();
    ?>
    </div>
</body>
</html>
