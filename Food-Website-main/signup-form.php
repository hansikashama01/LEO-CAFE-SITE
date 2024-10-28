<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Signup Form</title>
</head>
<body>

<div class="signup-container">
    <form id="signupForm" action="registration.php" method = "post">
        <h2>Create an Account</h2>
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" id="name" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" id="name" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="address" name = "address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="Phone" name = "number">Phone Number</label>
            <input type="number" id="phone" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="email" name = "email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password" name = "password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="signup-btn">Sign Up</button>
    </form>
    <div class="illustration"></div>
</div>

<script src="script.js"></script>
</body>
</html>

</body>
</html>