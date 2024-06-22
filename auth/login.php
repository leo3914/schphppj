<?php
include('../database.php');
date_default_timezone_set('Asia/Yangon');
$time = time();
if (isset($_POST['name']) && $_POST['password']) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE name = '$name' AND password = '$password' ");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['login_date'] = date('Y-m-d h:i:s');
        mysqli_query($conn, "INSERT INTO online_user (user_id,login_date,active_date) VALUES ('" . $_SESSION['id'] . "','" . $_SESSION['login_date'] . "','$time')");
        header("location:../home.php");
    } else {
        echo '<script>alert("Login Failed,Try again!");location.href="../index.php";</script>';
    }
};
