<?php
include('../database.php');
session_start();
if (isset($_POST['post_id'])) {
    $id = $_POST['post_id'];
    $sql = mysqli_query($conn, "SELECT * FROM like_data WHERE post_id='$id' AND user_id='" . $_SESSION['id'] . "' ");
    if (mysqli_num_rows($sql) > 0) {
        mysqli_query($conn, "DELETE FROM like_data WHERE post_id='$id' AND user_id='" . $_SESSION['id'] . "'");
    } else {
        mysqli_query($conn, "INSERT INTO like_data (user_id,post_id) VALUES ('" . $_SESSION['id'] . "','$id')");
    }
}
