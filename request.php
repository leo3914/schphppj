<?php
require __DIR__ . '/vendor/autoload.php';

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
