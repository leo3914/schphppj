<?php
include('../database.php');
if (isset($_GET)) {
    $del_id = $_GET['del'];

    // $delete_photo = mysqli_query($conn, "SELECT * FROM posts WHERE id='$del_id'");
    // var_dump($delete_photo);
    mysqli_query($conn, "DELETE FROM posts WHERE id=$del_id");
    header("location:../home.php");
}
