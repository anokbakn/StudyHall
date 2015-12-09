<?php
/**
*@author: Kristen Massey and Armand Nokbak
**/
session_start(); // connect to ongoing session
$docsForClass = $_SESSION['docsForClass'];
?>
<div class="col-md-12">
	<h3> DOCUMENTS </h3>
	<p>Documents found: <span class="badge"><?php echo sizeof($docsForClass); ?></span></p>

	
</div>

<table class="table table-hover" style="clear:both; border-style:solid; border-width:2px; border-radius:5px; padding:10px; border-color:#800000"> <!-- DOCUMENTS TABLE -->
<tr><td><b>Document Name</b></td><td><b>Subject</b></td><td><b>Class Code</b></td><td><b>Action</b></td></tr>
<?php	
	
	for($x = 0; $x < sizeof($docsForClass); $x++)
	{
	
		echo '<tr><form action="../documents/docViewer" method="post" class="form-inline" role="form"><td><input type="hidden" name="name" value="'.$docsForClass[$x]['doc_name'].'">'.$docsForClass[$x]['doc_name'].'</td><td><input type="hidden" name="subject" value="'.$docsForClass[$x]['subject'].'">'.$docsForClass[$x]['subject'].'</td><td><input type="hidden" name="class" value="'.$docsForClass[$x]['class_name'].'">'.$docsForClass[$x]['class_name'].'</td><td><input type="hidden" name="path" value="'.$docsForClass[$x]['path_to_doc'].'"><input type="hidden" name="upvotes" value="'.$docsForClass[$x]['upvotes'].'"><input type="hidden" name="downvotes" value="'.$docsForClass[$x]['downvotes'].'"><input type="hidden" name="doc_id" value="'.$docsForClass[$x]['doc_id'].'"><button type="submit" class="btn btn-primary" style="float:right">VIEW</button></td></form></tr>';
		
	}
?>
</table> <!-- DOCUMENTS TABLE -->


</div>

<div class="col-md-12" style="margin-bottom: 20px">
	<form action="../documents/viewMyDocs" method="post" class="form-inline" role="form" style="float:left">
		<button type="submit" class="btn btn-primary" >View My Documents</button>
	</form>
	
	<form action="../documents/addDocsForm" method="post" class="form-inline" role="form" style="float:right">
		<button type="submit" class="btn btn-primary" >Add Document</button>
	</form>
</div>