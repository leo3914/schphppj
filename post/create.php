<?php
session_start();
include('../database.php');
if (isset($_POST)) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    if ($photo) {
        $ext = pathinfo($photo, PATHINFO_EXTENSION);
        $photo = uniqid() . "." . $ext;
        // echo $photo;
        move_uploaded_file($tmp, "../post/img/$photo");
    }
    mysqli_query($conn, "INSERT INTO posts (title,description,post_photo,user_id,created_at,updated_at) VALUES ('$title','$description','$photo','" . $_SESSION['id'] . "',now(),now()) ");
    header("location:../home.php");
}
