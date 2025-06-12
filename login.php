<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-commerce Site</title>
    <style>
        
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome Back</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="loginpro.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="forgot-password">
                <a href="forgot-password.php">Forgot password?</a>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <div class="register-link">
            Don't have an account? <a href="registration_form.php">Register</a>
        </div>
    </div>
</body>
</html>
