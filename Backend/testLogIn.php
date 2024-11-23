<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
</head>

<body>
    <h2>Login</h2>
    <?php if (isset($_GET['message'])): ?>
    <p>
        <?php echo htmlspecialchars($_GET['message']); ?>
    </p>
    <?php endif; ?>
    <form action="../includes/signin.php" method="POST">
        <label for="login-email">Email:</label>
        <input type="email" id="login-email" name="email" required><br><br>
        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <h2>Register</h2>
    <form action="../includes/register.php" method="POST">
        <label for="register-email">Email:</label>
        <input type="email" id="register-email" name="email" required><br><br>
        <label for="register-password">Password:</label>
        <input type="password" id="register-password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>

</html>