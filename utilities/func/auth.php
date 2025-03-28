<?php
session_start();

function register($username, $password, $role) {
    global $conn;
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = password_hash(mysqli_real_escape_string($conn, $password), PASSWORD_BCRYPT);
    $role = mysqli_real_escape_string($conn, $role);
    
    $query = "INSERT INTO tb_user (username, password, role, createdAt, updatedAt) VALUES (?, ?, ?, NOW(), NOW())";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "sss", $username, $password, $role);
    
    if (mysqli_stmt_execute($statement)) {
        echo "<script>alert('Success');document.location.href='./';</script>";
        exit();
    } else {
        echo "Failed: " . mysqli_stmt_error($statement);
    }
    
    mysqli_stmt_close($statement);
}

function login($username, $password) {
    global $conn;
    
    $username = mysqli_real_escape_string($conn, $username);
    
    $query = "SELECT * FROM tb_user WHERE username = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['login_time'] = time();
            header("Location: main/?page=dashboard");
            exit();
        } else {
            echo "<script>alert('Wrong credential!');document.location.href='./';</script>";
        }
    } else {
        echo "<script>alert('User not found!');document.location.href='./';</script>";
    }
    
    mysqli_stmt_close($statement);
}

function logout() {
    session_unset();
    session_destroy();
    echo "<script>alert('You have successfully logged out');document.location.href='../';</script>";
    exit();  
}
?>
