<?php include('./database.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Lobelia</title>
	<?php include('cdn.php'); ?>

	<style type="text/css">
		.react {
			display: flex;
		}

		.react div {
			width: 33%;
			text-align: center;
		}
	</style>

</head>

<body style="background:#E9EBEE;">
	<?php include('nav.php'); ?>
	<div class="container-fluid" style="margin-top: 80px;">
		<div class="row">
			<div class="col-md-2">
				<?php include('leftside.php'); ?>
			</div>


			<div class="col-md-5">
				<div class="post_friend">
					<div class="card mb-3">
						<div class="card-header"><b>Create Posts</b></div>
						<div class="card-body">

							<div class="media">
								<img src="user/<?php echo $user['photo']; ?>" width="50px;" height="50px" class="mr-3 rounded-circle" alt="...">
								<div class="media-body">
									<textarea class="form-control" data-toggle="modal" data-target="#create_post_Modal"></textarea>
								</div>
							</div>

						</div>
						<div class="card-footer bg-white">
							<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_post_Modal"><i class="fas fa-images mr-1"></i>Photo/Video</button>
							<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_post_Modal"><i class="fas fa-plus-circle text-white mr-1"></i>Create</button>
							<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_post_Modal"><i class="far fa-smile mr-1"></i>Feeling/Activity</button>
						</div>
					</div>

					<?php

					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						$posts_sql = mysqli_query($conn, "SELECT posts.*,users.name,users.photo FROM posts INNER JOIN users ON posts.user_id=users.id WHERE posts.user_id='$id' ORDER BY posts.id DESC");
					} else {
						$posts_sql = mysqli_query($conn, "SELECT posts.*,users.name,users.photo FROM posts INNER JOIN users ON posts.user_id=users.id ORDER BY posts.id DESC");
					}

					while ($post = mysqli_fetch_assoc($posts_sql)) { ?>

						<div class="card mb-2">
							<div class="card-header bg-white">
								<a href="" class="card-link text-dark"><img src="user/<?php echo $post['photo']; ?>" width="30px" height="30px" class="rounded-circle mr-1">
									<b><?php $post['name'] ?></b></a>
								<div style="float: right;">
									<?php if ($_SESSION['id'] == $post['user_id']) { ?>
										<i class="ebtn fas fa-circle text-warning" data-toggle="modal" data-target="#edit_post_Modal" title="<?php echo $post['title']; ?>" description="<?php echo $post['description']; ?>" photo="<?php echo $post['post_photo']; ?>" post_id="<?php echo $post['id']; ?>"></i>
										<a href="post/delete.php?del=<?php echo $post['id']; ?>"><i class="fas fa-times-circle text-danger"></i></a>
									<?php } ?>
								</div>
							</div>
							<div class="card-body">
								<h5><?php echo $post['title']; ?></h5>
								<p class="text-justify"><?php echo $post['description']; ?></p>
								<?php
								if ($post['post_photo']) { ?>
									<img src="post/img/<?php echo $post['post_photo']; ?>" width="100%;">
								<?php } ?>
							</div>
							<div class="card-footer react bg-white">
								<div>

									<?php
									$sql2 = mysqli_query($conn, "SELECT * FROM like_data WHERE post_id='" . $post['id'] . "' AND user_id='" . $_SESSION['id'] . "'");

									if (mysqli_num_rows($sql2) > 0) { ?>
										<i class="unlike fas fa-thumbs-up mr-1 text-primary" post_id="<?php echo $post['id']; ?>"></i>
									<?php } else { ?>
										<i class="like fas fa-thumbs-up mr-1" post_id="<?php echo $post['id']; ?>"></i>
									<?php } ?>


									<span class="badge badge-light" id="like_area">
										<?php
										$sql1 = mysqli_query($conn, "SELECT * FROM like_data WHERE post_id = '" . $post['id'] . "'");

										echo mysqli_num_rows($sql1);
										?>
									</span>
								</div>
								<div><a href="comment.php?pid=<?php echo $post['id']; ?>" class="text-dark card-link"><i class="far fa-comment-alt mr-1"></i>Comment</a></div>
								<div><i class="fas fa-share mr-1"></i></i>Share</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>


			<div class="col-md-3">
				<?php include('popular.php'); ?>
			</div>

			<div class="col-md-2">
				<ul class="list-group side_right online_area">


				</ul>
			</div>
		</div>
	</div>

	<?php include('modal.php'); ?>
	<script>
		$(".ebtn").click(function() {
			var title = $(this).attr('title');
			var description = $(this).attr('description');
			var photo = $(this).attr('photo');
			var post_id = $(this).attr('post_id');

			$(".old_photo").val(photo);
			$(".id").val(post_id);
			$('.title').val(title);
			$('.description').val(description);
			$('.delete_photo').val("");

			if (photo) {
				$('.photo').attr('src', 'post/img/' + photo);
			} else {
				$('.photo').attr('src', '');
			}

			$('.delete_photo_btn').click(function() {
				$('.photo').hide();
				$('.delete_photo').val(photo)
			})
		})

		$(document).ready(function() {
			$('.like').click(function() {
				var post_id = $(this).attr('post_id');
				$(this).toggleClass('text-primary');
				$.ajax({
					type: "POST",
					url: "like_unlike/insert_delete.php",
					data: {
						post_id
					},
					success: function() {
						// console.log(post_id);
						likeCount(post_id);
					}
				});
			})
		});

		$('.unlike').click(function() {
			var post_id = $(this).attr('post_id');
			$(this).toggleClass('text-primary');
			$.ajax({
				url: "like_unlike/insert_delete.php",
				method: "POST",
				data: {
					post_id
				},
				success: function() {
					likeCount(post_id)
				}

			})
		})

		function likeCount(id) {
			$.ajax({
				url: "like_unlike/count.php",
				method: "POST",
				data: {
					id
				},
				success: function(result) {
					$("#like_area").text(result)
				}
			})
		}

		$('body').mousemove(function() {
			$.ajax({
				url: "request.php",
				success: function() {
					
				}
			})
		})
	</script>

	<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
	<script>
		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;

		var pusher = new Pusher('61e8eaa62c726a6f2855', {
			cluster: 'us2'
		});

		var channel = pusher.subscribe('my-channel');
		channel.bind('my-event', function(data) {
			// alert(JSON.stringify(data));
			$.ajax({
				url: "online_select.php",
				success: function(result) {
					$('.online_area').html(result)
				}
			});
		});
	</script>
</body>

</html>