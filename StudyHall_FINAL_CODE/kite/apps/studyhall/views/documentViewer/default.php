<?php
/**
*@author Jesse Ables
**/



/**
the following is to help reload the page
@author Armand Nokbak
**/
session_start();
if(!(isset($_SESSION['path']) && isset($_SESSION['subject']))){ /** if it is its first time loading this page **/
	/**
	*snippet from Jesse
	**/
	//necessary variables for use below
	//name and path are different -> path is what the file is saved as with extension. Name is database name.
	$path = $_POST['path'];
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$class = $_POST['class'];
	//end od snippet
	//echo $path.'<br>';

	$_SESSION['path'] = $path;
	$_SESSION['name'] = $name;
	$_SESSION['subject'] = $subject;
	$_SESSION['class'] = $class;
	
}
else{/** if it is not its first time loading this page, the session variables have been set **/
	$path = $_SESSION['path'];
	$name = $_SESSION['name'];
	$subject = $_SESSION['subject'];
	$class = $_SESSION['class'];
}

/**
*@author Jesse Ables
**/
//path to be used to get to the document
$view_path = 'Documents/' . $subject . '/' . $class . '/' . $path;

?>


<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<h2><?php echo $name ?></h2>
<!-- This is the ViewerJS Construct. The first part is the path to ViewerJS. The #.. tells ViewerJS to go back
	 to the directory the ViewerJS directory is in.  The last part is the path to the doc using above php -->
<iframe
src ="http://www.studyhallway.com/kite/apps/studyhall/ViewerJS/#../<?php echo $view_path; ?>"
width='800' height='600' allowfullscreen webkitallowfullscreen>
</iframe>
<body>
</body>
</html>

<script>
//script found at https://benmarshall.me/responsive-iframes/ because I would not have known how to do it otherwise
//this makes the iframe responsive to the screen size.

// Find all iframes
var $iframes = $( "iframe" );
 
// Find &#x26; save the aspect ratio for all iframes
$iframes.each(function () {
  $( this ).data( "ratio", this.height / this.width )
    // Remove the hardcoded width &#x26; height attributes
    .removeAttr( "width" )
    .removeAttr( "height" );
});
 
// Resize the iframes when the window is resized
$( window ).resize( function () {
  $iframes.each( function() {
    // Get the parent container&#x27;s width
    var width = $( this ).parent().width();
    $( this ).width( width )
      .height( width * $( this ).data( "ratio" ) );
  });
// Resize to fix all iframes on page load.
}).resize();
</script>


<!--
<iframe
src ="http://www.studyhallway.com/kite/apps/studyhall/ViewerJS/#../?php echo $view_path; ?>"
width='800' height='600' allowfullscreen webkitallowfullscreen>
</iframe>
-->

<!-- @author Armand Nokbak -->
<div class="col-md-6" style="margin-bottom: 20px; margin-top:20px; float:left">
	<form action="../documents/likeDoc"  class="form-inline" method="post" role="form" style="float:left; margin-right:10px">
		<input type="hidden" name="path" value="<?php echo $path;?>">
		<input type="hidden" name="name" value="<?php echo $name;?>">
		<button class="btn btn-primary">Like</button>
	</form>
	<form action="../documents/dislikeDoc" class="form-inline" method="post" role="form" style="float:left; margin-left:10px; margin-right:20px ">
		<input type="hidden" name="path" value="<?php echo $path;?>">
		<input type="hidden" name="name" value="<?php echo $name;?>">
		<button class="btn btn-primary">Dislike</button>
	</form>
	<p> likes: <span class="badge"><?php echo $_SESSION['upvotes']; ?></span> dislikes: <span class="badge"><?php echo $_SESSION['downvotes']; ?></span></p>
</div>
<div class="col-md-6"  style="margin-bottom: 20px; margin-top:20px">
	<form action="../documents/home" method="post" class="form-inline" role="form" style="float: right">
		<button type="submit" class="btn btn-primary" >Back to all documents</button>
	</form>
</div>

<div class="col-md-12"><!-- comments div-->
	<?php
		$commentsList = $_SESSION['commentsList'];
		if(isset($_SESSION['commentsList'])){
			for($x = 0; $x < sizeof($commentsList); $x++)
			{
				echo '<div class="well">'.$commentsList[$x]['comment_body'].' <i>Posted by: '.$commentsList[$x]['username'].'</i></div>';
				
			}
						
		}
	?>
</div>

<div class="col-md-12"  style="margin-bottom: 20px; margin-top:20px"> <!-- add comments div-->
	<form role="form"  method="post" action="../documents/addComment">
		  <div class="col-md-11">
		  
		  	<input type="textarea" class="form-control" id="comment" name="comment">
		  </div>
		  <div class="col-md-1">
		  	<button class="btn btn-primary" style="float:right">Comment</button>
		  </div>
	</form>
</div>