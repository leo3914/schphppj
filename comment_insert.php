<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
include('database.php');
if (isset($_POST['comment'])) {

    $options = array(
        'cluster' => 'us2',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        '61e8eaa62c726a6f2855',
        '06463585c4e0ba6ca92c',
        '1821833',
        $options
    );

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);

    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    mysqli_query($conn, "INSERT INTO comment (comment,user_id,post_id) VALUES ('$comment','" . $_SESSION['id'] . "','$post_id') ");
}
