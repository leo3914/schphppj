<?php
include('./database.php');
session_start();
$time = time();
// echo $time;
mysqli_query($conn, "UPDATE online_user SET active_date='$time' WHERE user_id='" . $_SESSION['id'] . "' AND login_date='" . $_SESSION['login_date'] . "' ");

$sql = mysqli_query($conn, "SELECT online_user.*,users.name,users.photo FROM online_user INNER JOIN users ON online_user.user_id=users.id WHERE online_user.active_date>'$time'-5 GROUP BY online_user.user_id");

$data = "";
$data .= '<li class="list-group-item"><i class="fas fa-circle text-danger" style="font-size:12px;"></i> <b>Active Users</b> <span class="badge badge-info">' . mysqli_num_rows($sql) . '</span></li>';

while ($online = mysqli_fetch_array($sql)) {
    $data .= '<li class="list-group-item border-top-0 border-bottom-0"><img src="user/' . $online['photo'] . '" class="rounded-circle" width="35px" >' . $online['name'] . '</li>';
}
echo $data;
