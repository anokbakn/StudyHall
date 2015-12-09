<?php
/**
*@author: Kristen Massey
**/
session_start(); // connect to ongoing session
$AZClassList = $_SESSION['AZClassList'];
?>
<div class="col-md-12">
	<h3> CLASS LIST A-Z </h3>
	<p>Classes found: <span class="badge"><?php echo sizeof($_SESSION['AZClassList']); ?></span></p>
	

	<table class="table table-hover" style="clear:both; border-style:solid; border-width:2px; border-radius:5px; padding:10px; border-color:#800000"> 
	<tr><td><b>Class Name</b></td><td><b>Action</b></td></tr>
	<?php	

	
		for($x = 0; $x < sizeof($AZClassList); $x++)
		{
			echo '<tr><form action="../documents/docsByClass" method="post" class="form-inline" role="form"><td><input type="hidden" name="className" value="'.$AZClassList[$x].'">'.$AZClassList[$x].'</td><td><button type="submit" class="btn btn-primary" style="float:right">VIEW</button></td></form></tr>';
		
		}
	?>
	</table>
</div>