<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Logger Project</title>
    <link rel="stylesheet" href="./assets/register.css">
</head>
<body>
    <div class="container">
        <div class="register-form">
            <?php
            session_start();
            require_once('../config/database.php');
            require_once('../includes/functions.php');
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];

                $result = registerUser($username, $password, $fullname);

                if ($result) {
                    header('Location: login.php');
                    exit;
                } else {
                    $error = 'Registration failed. Please try again.';
                }
            }
            ?>

            <h2>Register</h2>
            <?php if (isset($error)) : ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="fullname" required>
                </div>
                <input type="submit" value="Register">
            </form>
            <p>Already have a user? <a href="login.php">Login here.</a></p>
        </div>
    </div>
</body>
</html>