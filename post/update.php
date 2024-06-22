<?php
include('../database.php');
if (isset($_POST)) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $old_photo = $_POST['old_photo'];
    $delete_photo = $_POST['delete_photo'];

    if ($photo) {
        unlink("../post/img/" . $old_photo);
        move_uploaded_file($tmp, "../post/img/$photo");
        mysqli_query($conn, "UPDATE posts SET title='$title',description='$description',post_photo='$photo',updated_at=now() WHERE id='$id' ");
    } else if ($delete_photo) {
        unlink("../post/img/" . $old_photo);
        mysqli_query($conn, "UPDATE posts SET title='$title',description='$description',post_photo='',updated_at=now() WHERE id='$id' ");
    } else {
        mysqli_query($conn, "UPDATE posts SET title='$title',description='$description',updated_at=now() WHERE id='$id' ");
    }
    header("location:../home.php");
}
