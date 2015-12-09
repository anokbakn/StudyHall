
<?php 
session_start();
//print_r($_SESSION); 
?> 


<?php
	
	foreach (glob("apps/studyhall/models/*.php") as $filename)
	{
	   	include_once $filename;
	}

	$subject = new Subject();
	$all_subs = $subject->getAZSubjects();

	$classes = new Classes();

	$dict = [];

	foreach($all_subs as $s){
		$dict[$s] = $classes->getClassBySubject($s);
	}

?>


<form role="form" action="../documents/uploadDoc" method="post" enctype="multipart/form-data">
	<TABLE>
	<TR>
		<TD>Document Subject:</TD>
		<TD>
			<div class="form-group">
			  	<label for="sel1"></label>
			  	<select class="form-control" id="sel1" name="subject">
			  		<option value="lel" selected>---Select Subject---</option>
			  		 <?php foreach($all_subs as $subs){
			  		    	echo "<option value='". $subs ."'>" . $subs . "</option>";
			  			 }?>
			  		<option value="Subject Not Listed">Subject Not Listed</option>
				</select>
			</div>
		</TD>
		<TD><input type="text" name="subject_not_found" class="form-control" id="snf"></TD>
	</TR>
	<TR>
		<TD>Document Class:</TD>  
		<TD>
			<div class="form-group">
			  	<label for="sel2"></label>
			  	<select class="form-control" id="sel2" name="class">
			  		<option value="" selected>---Select Class---</option>
				</select>
			</div>
		</TD>
		<TD><input type="text" name="class_not_found" class="form-control" id="cnf"></TD>
	</TR>
	<TR>
		<TD>Document Name:</TD>
		<TD><input type="text" id="doc_name" name="name" class="form-control"  required></TD>
	</TR>
	<TR>
    	<TD>Select image to upload:</TD>
    	<TD><input type="file" name="uploadedfile" id="fileToUpload" required class="btn btn-default"></TD>
    	<TD>.pdf, .ods, .odt, .odp only</TD>
    </TR>
    <TR>
    	<TD><input type="submit" value="Upload Document" name="submit" class="btn btn-primary"></TD>
    </TR>
    </TABLE>
</form>


<script> 

	//variable holds all classes in a dict
	var all_classes = <?php echo json_encode($dict); ?>;

	//hide and change value of text boxes
	$('#snf').hide();
	$('#snf').val('');
	$('#cnf').hide();
	$('#cnf').val('');

	//form onchange listener for first select box
	$('#sel1').on('change', function() {

		if(this.value == "Subject Not Listed"){
	  	
			$('#snf').show();
	  		$('#snf').prop('required',true);
		}else{
	  		$('#snf').hide();
	  		$('#snf').prop('required',false);
	  	}

	   	var select = $('#sel2');
	  	select.empty().append('<option value="">---Select Class---</option>');
	  	if(this.value != "Subject Not Listed"){
		  	$.each(all_classes[this.value], function( index, value ) {
		  	select.append('<option value="' + value + '">' + value + '</option>');
	    	});
	  	}	
	  	select.append('<option value="Class Not Listed">Class Not Listed</option>');
	});

	//onchange listener for select box 2
	$('#sel2').on('change', function() {

	  	if(this.value == "Class Not Listed"){
	  		$('#cnf').show();
	  		$('#cnf').prop('required',true);
	  	}else{
	  		$('#cnf').hide();
	  		$('#cnf').prop('required',false);
	  	}

	});


</script>


