<?php
/**
*@author: Armand Nokbak
**/
session_start(); // connect to ongoing session
?>
<div class="col-md-12">
	
	<?php
		
		if(isset($_SESSION['forumsErrorMessage'])){
			echo '<div class="alert alert-success"><strong>'. $_SESSION['forumsErrorMessage'] .'</strong></div>';
		
			unset($_SESSION['forumsErrorMessage']);//so this won't keep displaying
		}
		
		if(isset($_SESSION['forumsList'])){
			$forumsList = $_SESSION['forumsList'];
		?>	
			<table class="table table-bordered">
			    <thead>
			      <tr>
			        <th>Forum Name</th>
			        <th>Owner</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>
		<?php
		
		
		for($x = 0; $x < sizeof($forumsList); $x++)
		{
		
			//for admin
			if(isset($_SESSION['role']) && $_SESSION['role']==='admin' && $forumsList[$x]['blocked']==0){
				echo '
			      <tr>
			        <td>'.$forumsList[$x]['topic_name'].'</td>
			        <td>'.$forumsList[$x]['username'].'</td>
			        <td><form role="form" method="POST" action="../forums/viewForum" style="float:left; margin-right:10px">
			        	<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
			        	<input type="hidden" name="topic_name" value="'.$forumsList[$x]['topic_name'].'">
			        	<input type="hidden" name="username" value="'.$forumsList[$x]['username'].'">
			        	<input type="hidden" name="description" value="'.$forumsList[$x]['topic_description'].'">
			        	<button type="submit" class="btn btn-primary">View</button></form>
			        	<form role="form" action="../forums/blockForum" style="float:left; margin-right:10px" method="POST">
			        		<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
			        		<button type="submit" class="btn btn-primary">Block</button>
			        	</form>
			        	<form role="form" action="../forums/deleteForum" method="POST">
			        		<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
			        		<button type="submit" class="btn btn-primary">Delete</button>
			        	</form>
			        </td>
			      </tr>
			      ';
				
			}
			//for admin
			else if(isset($_SESSION['role']) && $_SESSION['role']==='admin' && $forumsList[$x]['blocked']==1){
				echo '
			      <tr>
			        <td>'.$forumsList[$x]['topic_name'].'</td>
			        <td>'.$forumsList[$x]['username'].'</td>
			        <td><form role="form" method="POST" action="../forums/viewForum" style="float:left; margin-right:10px">
			        	<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
			        	<input type="hidden" name="topic_name" value="'.$forumsList[$x]['topic_name'].'">
			        	<input type="hidden" name="username" value="'.$forumsList[$x]['username'].'">
					<input type="hidden" name="description" value="'.$forumsList[$x]['topic_description'].'">
			        	<button type="submit" class="btn btn-primary">View</button></form>
			        	<form role="form" action="../forums/unblockForum" style="float:left; margin-right:10px" method="POST">
			        		<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
			        		<button type="submit" class="btn btn-primary">UnBlock</button>
			        	</form>
			        	<form role="form" action="../forums/deleteForum" method="POST">
			        		<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
			        		<button type="submit" class="btn btn-primary">Delete</button>
			        	</form>
			        </td>
			      </tr>
			      ';
				
			}
			else if($forumsList[$x]['blocked']==0){
				echo '
				      <tr>
				        <td>'.$forumsList[$x]['topic_name'].'</td>
				        <td>'.$forumsList[$x]['username'].'</td>
				        <td><form role="form" method="POST" action="../forums/viewForum" style="float:left; margin-right:10px">
				        	<input type="hidden" name="topic_id" value="'.$forumsList[$x]['topic_id'].'">
				        	<input type="hidden" name="topic_name" value="'.$forumsList[$x]['topic_name'].'">
				   		<input type="hidden" name="description" value="'.$forumsList[$x]['topic_description'].'">
				        	<input type="hidden" name="username" value="'.$forumsList[$x]['username'].'">
				        	<button type="submit" class="btn btn-primary">View</button></form>
				        	
				        </td>
				      </tr>
				      ';
			}
		}
			     
		?>
			    </tbody>
			</table>
			
			<?php
		}
		
	?>
	<form role="form" action="../forums/createForumTopic" method="POST">
		  <button type="submit" class="btn btn-primary">Create forum topic</button>
  	</form>
</div>