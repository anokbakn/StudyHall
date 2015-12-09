<?php
/**
*@author: Armand Nokbak
**/
session_start(); // connect to ongoing session
?>
<div class="col-md-12">
	
	<div class="alert alert-info">
		<?php
			echo '<strong>'.$_SESSION['topic_name'].'</strong>';
		?>
		<div class="col-md-3" style="float:right; text-align:right">
			
				<?php
					echo '@author '.$_SESSION['topic_username'];
				?>
			
		</div>
		

	</div>
	
	<div class="well">
  			<?php
				echo '<strong>Description : </strong>'.$_SESSION['description'];
			?>
	</div>
	
	<div class="col-md-11">
		<form role="form" method="POST" action="../forums/addPost">
		<input type="text" class="form-control" name="forum_post" placeholder="enter post ...">
	</div>
	
	<div class="col-md-1">
		<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<div class="col-md-12" style="top-margin=20px">
		<br>
	</div>
	<?php
		$postList = $_SESSION['forumPostList'];
		for($x = 0; $x < sizeof($postList); $x++)
		{
			echo '<div class="col-md-12"><div class="well">'.$postList[$x]['post_content'].'<i> Posted by '.$postList[$x]['username'].'</i></div></div>';
		}
	
	
	
	?>
	
	<div class="col-md-2" style="float:left">
		<form role="form" method="POST" action="../forums/home">
			<button type="submit" class="btn btn-primary">Back to forum topics</button>
		</form>
	</div>
	
</div>