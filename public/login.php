<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Logger Project</title>
    <link rel="stylesheet" href="./assets/login.css">
</head>
<body>

<div class="container">
    <div class="login-form">
        <?php
        session_start();
        require_once('../config/database.php');
        require_once('../includes/functions.php');

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = authenticateUser($username, $password);

            if ($user) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($_SESSION['role'] == 'worker') {
                    header('Location: index.php');
                    exit;
                } else {
                    header('Location: view_logs.php');
                    exit;
                }
            } else {
                $error = 'Invalid username or password.';
            }
        }
        ?>

        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <p>Don't have a user? <a href="register.php">Register here.</a></p>
    </div>
</div>

</body>
</html>