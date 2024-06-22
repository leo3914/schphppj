<?php
$all_sql = mysqli_query($conn, "SELECT * FROM posts");
$all = mysqli_num_rows($all_sql);

$own_sql = mysqli_query($conn, "SELECT * FROM posts WHERE user_id='" . $_SESSION['id'] . "' ");
$own = mysqli_num_rows($own_sql);

$friend_sql = mysqli_query($conn, "SELECT * FROM users WHERE id!='" . $_SESSION['id'] . "' ");


$friend = mysqli_num_rows($friend_sql);
?>
<ul class="list-group side_left mb-3">
	<li class="list-group-item"><a href="" class="card-link text-dark"><i class="fas fa-home"></i> NewFeeds</a></li>
	<li class="list-group-item"><a href="home.php" class="card-link text-dark"><i class="fas fa-clipboard-list"></i> All Posts <span class="badge badge-info"><?php echo $all; ?></span></a></li>
	<li class="list-group-item"><a href="./home.php?id=<?php echo $_SESSION['id']; ?>" class="card-link text-dark"><i class="fas fa-server"></i> Own Posts <span class="badge badge-info">3</span></a></li>
	<li class="list-group-item"><a href="friend.php" class="card-link text-dark"><i class="fas fa-user-friends"></i> Friends <span class="badge badge-info">3</span></a></li>
</ul>