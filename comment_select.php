<?php

include("./database.php");
if (isset($_POST['post_id'])) {
    $id = $_POST['post_id'];
    $comment_sql = mysqli_query($conn, "SELECT comment.*,users.name,users.photo FROM comment INNER JOIN users ON comment.user_id=users.id WHERE comment.post_id='$id'");
    while ($comment = mysqli_fetch_assoc($comment_sql)) {
        echo '<div class="media mb-2">
			  			<div class="media-left">
			    		<img src="user/' . $comment['photo'] . '" class="media-object rounded-circle m-2" width="35px" height="35px">
			  		</div>
			  			<div class="media-body">
			  			<h6>' . $comment['name'] . '</h6>
			    		<p>' . $comment['comment'] . '</p>
			  				</div>
							</div>';
    }
}
