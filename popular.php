<div class="alert bg-white pop">
	<b>Popular Posts/Authors</b>
	<hr>

	<?php
	$pop_sql = mysqli_query($conn, "SELECT post_id FROM like_data GROUP BY post_id ORDER BY count(post_id) DESC LIMIT 0,3");
	while ($pop = mysqli_fetch_assoc($pop_sql)) {
		$popular_sql = mysqli_query($conn, "SELECT posts.*,users.name,users.photo FROM posts INNER JOIN users ON posts.user_id=users.id WHERE posts.id='" . $pop['post_id'] . "' ");
		while ($popular = mysqli_fetch_assoc($popular_sql)) { ?>
			<div class="media border mb-2">
				<a href="" class="card-link text-dark">
					<div class="media-left">
						<?php
						if ($popular['post_photo']) { ?>
							<img src="post/img/<?php echo $popular['post_photo'] ?>" class="media-object my-2 ml-2" width="120px">
						<?php }
						?>
					</div>
					<div class="media-body ml-2">
						<h6 class="media-heading mt-3"><?php echo $popular['title'] ?></h6>
						<small><?php echo $popular['description'] ?></small>
				</a><br>

				<a href="" class="text-dark"><small>Posted by : <b><?php echo $popular['name'] ?></b></small>
					<img src="user/<?php echo $popular['photo'] ?>" class="rounded-circle float-right mr-2 mb-1" width="30px" height="30px">
				</a>
			</div>
</div>
<?php }
	}
?>

</div>