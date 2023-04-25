<?php
function authenticateUser($username, $password) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            return array(
                'id' => $user['id'],
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'role' => $user['role'],
            );
        }
    }

    return false;
}

function registerUser($username, $password, $fullname) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $fullname = mysqli_real_escape_string($conn, $fullname);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, fullname, role) VALUES ('$username', '$hashed_password', '$fullname', 'worker')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}