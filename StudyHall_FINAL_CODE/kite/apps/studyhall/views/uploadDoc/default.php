<?php
    session_start();
    
    //import files
    foreach (glob("apps/studyhall/models/*.php") as $filename)
    {
        include_once $filename;
    }

    $subject = $_POST['subject'];
    $class = $_POST['class'];
    $name = $_POST['name'];

    $snf = $_POST['subject_not_found'];
    $cnf = $_POST['class_not_found'];

    if($subject == "Subject Not Listed"){
        //for now assume that subject that is input is not a folder
        $subject = $snf;
        mkdir("apps/studyhall/Documents/" . $subject, 0777);
        $add_subject = new Subject();
        $add_subject->addSubject($subject);
    }

    if($class == "Class Not Listed"){
        //same as above
        $class = $cnf;
        mkdir("apps/studyhall/Documents/" . $subject . "/" . $class, 0777);
        $add_class = new Classes();
        $add_class->addClass($class, $subject);
    }



    //this is the path created to place the document in the correct folder
    $target_path = "apps/studyhall/Documents/" . $subject . "/" . $class . "/";

    //this adds the file name and extension to the end of the path
    $target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

    $ext = pathinfo($target_path,PATHINFO_EXTENSION);
    //echo $ext;
    //only certain file types can be uploaded (constraint from ViewerJS)

    
    if($ext == 'pdf' || $ext == 'ods' || $ext == 'odp' || $ext == 'odt'){
        //file that is uploaded is a temporary file.  Need to copy the temp file to correct location
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
            " has been uploaded";
        } else{
            echo "There was an error uploading the file, please try again!";
        }

        //allow for view after upload
        $view_path = 'Documents/' . $subject . '/' . $class . '/' . basename($_FILES['uploadedfile']['name']);

    
        $new_doc = new Document();
        $new_doc->createDocument($_SESSION['username'], 
                                $class,
                                $subject,
                                $name,
                                $ext,
                                basename($_FILES['uploadedfile']['name']));
    }else{
        echo "Please upload the correct file type. PDF, ODS, ODP, ODT.";
    }
        

    




?>


<h2><?php echo $name ?></h2>
<iframe
		src ="http://www.studyhallway.com/kite/apps/studyhall/ViewerJS/#../<?php echo $view_path; ?>"
		width='800' height='600' allowfullscreen webkitallowfullscreen>
</iframe>


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