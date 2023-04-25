<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if ($_SESSION['role'] == 'worker') {
        header('Location: public/index.php');
        exit;
    } elseif ($_SESSION['role'] == 'manager') {
        header('Location: public/view_logs.php');
        exit;
    }
} else {
    header('Location: public/login.php');
}
?>