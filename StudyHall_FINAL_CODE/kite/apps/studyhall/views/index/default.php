<!--code written by Kristen Massey  -->
<!-- Begin page content -->
<div class="col-md-12">
<!--<div class="page-header"> -->

	<?php
	/**
	*@author Armand Nokbak (php code)
	**/
	
		session_start();
	
		if(isset($_SESSION['registrationErrorMessage'])){
			echo '<div class="alert alert-success"><strong>'. $_SESSION['registrationErrorMessage'] .'</strong></div>';
		
			unset($_SESSION['registrationErrorMessage']);//so this won't keep displaying
		}
	?>
	
        <h4 style="clear: right">Need Some Help Studying?
       
        </h4>
   <!-- </div> -->

	
	
    <p >StudyHall is a user driven study material sharing site.  Visitors can search and view uploaded class material submissions.  Registered users can create classes, add subjects, and upload their own study materials to share.  StudyHall aims to help connect you to the materials that you need to succeed in your educational endeavors.  Users can also rate the materials available on StudyHall, comment on posts, and interact with other users in the site <a href="#">Forums</a>.</p>
    <p >Not a user?  Want access to user privileges?  <a href="#">Register now</a>.</p>




<!-- end of code written by Kristen Massey  -->

</div>