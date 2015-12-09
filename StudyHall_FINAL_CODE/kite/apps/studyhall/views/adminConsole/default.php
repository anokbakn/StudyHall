<!-- ALTERNATIVE -->

<div class="well" style="text-align: center"><h3>DOCUMENTS TABLE</h3></div>

<table id= "docTable" class="table table-hover" style="clear:both; border-style:solid; border-width:2px; border-radius:5px; padding:10px; border-color:#800000"> <!-- DOCUMENTS TABLE -->
<tr>
<td><b>#</b></td>
<td><b>Username</b></td>
<td><b>Class Code</b></td>
<td><b>Subject</b></td>
<td><b>Document Name</b></td>
<!--<td><b>Path</b></td>-->
<td><b>Up</b></td>
<td><b>Down</b></td>
<td><b>Action</b></td>
</tr>
<?php	

	$documentsList = $_SESSION['documentsList'];
	

	
	for($x = 0; $x < sizeof($documentsList); $x++)
	{	
		
echo '<tr>
<td>'.$documentsList[$x]['doc_id'].'</td>
<td>'.$documentsList[$x]['username'].'</td>
<td>'.$documentsList[$x]['class_name'].'</td>
<td>'.$documentsList[$x]['subject'].'</td>
<td>'.$documentsList[$x]['doc_name'].'</td>
<!--<td>'.$documentsList[$x]['path_to_doc'].'</td>-->
<td>'.$documentsList[$x]['upvotes'].'</td>
<td>'.$documentsList[$x]['downvotes'].'</td>
<td>
<div class="btn-group">'; 
if(($documentsList[$x]['blocked'] == NULL) || ($documentsList[$x]['blocked'] == 0)){
echo '
<form action="../documents/blockDoc" method="POST" role="form" class="form-group">
	<input type="hidden" name="doc_id" value="'.$documentsList[$x]['doc_id'].'">
	<button class="btn btn-primary">BLOCK</button>
</form>'; }
else {
 echo '
<form role="form" method="POST" action="../documents/unBlockDoc" class="form-group">
	<input type="hidden" name="doc_id" value="'.$documentsList[$x]['doc_id'].'">
	<button class="btn btn-primary">UNBLOCK</button>
</form>'; }
echo '
<form role="form" method="POST" action="../documents/deleteDoc" class="form-group">
	<input type="hidden" name="doc_id" value="'.$documentsList[$x]['doc_id'].'">
	<button class="btn btn-primary">DELETE</button>
</form>
</div>
</td>
</tr>';
		
	}
?>
</table> <!-- DOCUMENTS TABLE -->

<div class="well" style="text-align: center"><h3>USERS TABLE</h3></div>

<table id= "docTable" class="table table-hover" style="clear:both; border-style:solid; border-width:2px; border-radius:5px; padding:10px; border-color:#800000"> <!-- USERS TABLE -->
<tr>
<td><b>#</b></td>
<td><b>Username</b></td>
<td><b>email</b></td>
<td><b>First Name</b></td>
<td><b>Last Name</b></td>
<!--<td><b>Admin</b></td>-->
<td><b>Blocked Date</b></td>
<td><b>Action</b></td>
</tr>
<?php	

	
	$usersList = $_SESSION['usersList'];

	
	for($x = 0; $x < sizeof($usersList); $x++)
	{	
		
echo '<tr>
<td>'.$usersList[$x]['username'].'</td>
<td>'.$usersList[$x]['email'].'</td>
<td>'.$usersList[$x]['first_name'].'</td>
<td>'.$usersList[$x]['last_name'].'</td>
<td>'.$usersList[$x]['admin'].'</td>
<td>'.$usersList[$x]['blocked_date'].'</td>
<td>
<div class="btn-group">'; 
if(($usersList[$x]['blocked_date'] == NULL) || ($usersList[$x]['blocked_date'] == 0)){
echo '
<form action="../home/blockUser" method="POST" role="form" class="form-group">
	<input type="hidden" name="username" value="'.$usersList[$x]['username'].'">
	<button class="btn btn-primary">BLOCK</button>
</form>'; }
else {
 echo '
<form role="form" method="POST" action="../home/unblockUser" class="form-group">
	<input type="hidden" name="username" value="'.$usersList[$x]['username'].'">
	<button class="btn btn-primary">UNBLOCK</button>
</form>'; }
echo '
<form role="form" method="POST" action="../home/deleteUser" class="form-group">
	<input type="hidden" name="username" value="'.$usersList[$x]['username'].'">
	<button class="btn btn-primary">DELETE</button>
</form>
</div>
</td>
</tr>';
		
	}
?>
</table> <!-- UserS TABLE -->



<!-- END OF ALTERNATIVE -->

