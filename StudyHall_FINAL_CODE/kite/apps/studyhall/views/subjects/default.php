<?php
/**
*@author: Armand Nokbak and Kristen Massey
**/
session_start(); // connect to ongoing session
$subjectArray = $_SESSION['subjectArray']
?>
<div class="col-md-12">
	<h3> SUBJECTS </h3>
	<p>Subjects found: <span class="badge"><?php echo sizeof($_SESSION['subjectArray']); ?></span></p>
	

	<table class="table table-hover" style="clear:both; border-style:solid; border-width:2px; border-radius:5px; padding:10px; border-color:#800000"> 
	<tr><td><b>Subject</b></td><td><b>Action</b></td></tr>
	<?php	

	
		for($x = 0; $x < sizeof($subjectArray); $x++)
		{
			echo '<tr><form action="../documents/classesBySubject" method="post" class="form-inline" role="form"><td><input type="hidden" name="subject" value="'.$subjectArray[$x].'">'.$subjectArray[$x].'</td><td><button type="submit" class="btn btn-primary" style="float:right">VIEW</button></td></form></tr>';
		
		}
	?>
	</table>
</div>