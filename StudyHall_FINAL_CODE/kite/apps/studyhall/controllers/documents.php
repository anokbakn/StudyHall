<?php
/**
 * @author Armand Nokbak
 *
 * The documents controller
 *
 */


class Documents extends Kite {

	function home(){
		session_start(); //connect to the ongoing session
		
		$documentsManager = $this->getmodel('DocumentsManager');
		//echo '<p>'.$documentsManager->showDocuments()[0][0].'</p>';
		$documentsList = $documentsManager->showDocuments();
		//var_export($documentsList);
		//echo $documentsList["0"];
		unset($_SESSION['path']);
		unset($_SESSION['name']);
		unset($_SESSION['subject']);
		unset($_SESSION['class']);
		
		
		$_SESSION['documentsList'] = $documentsList;
		
		
		
		$this->render('showAllDocs');
	}
	
    function viewMyDocs(){
    	session_start();
    	
    	if(isset($_SESSION['username'])){
    		//INSERT CODE HERE
    	
    		$this->render('viewMyDocuments');
    	}
    	else{	/** If the user is not logged in, make them log in **/
    		$this->render('registrationForm');
    	}
    
    }

    function subjects(){
    	session_start();
    		//INSERT CODE HERE
		//Get Subjects from model (in array)
		$subjectModel = $this->getmodel('Subject');
		$subjectArray = $subjectModel->getAZSubjects();
		
		//put subjectArray in session
		$_SESSION['subjectArray'] = $subjectArray;
    	
    		$this->render('subjects');
    
    }

    function classesAZ(){
    	session_start();
    		//INSERT CODE HERE

                //Get Classes from model (in an array)
	        $classesModel = $this->getmodel('Classes');
		$classesAZList = $classesModel->getAZClassList();

		//set session data for classes
		$_SESSION['AZClassList'] = $classesAZList;
    	
    		$this->render('classAZList');
    
    }

    function classesBySubject(){
	session_start();
	$subject = $_POST['subject'];
	//get classes by subject
	$classesModel = $this->getmodel('Classes');
	$classesBySubject = $classesModel->getClassBySubject($subject);

	//set classesBySubject in session
	$_SESSION['classesBySubject'] = $classesBySubject;
    	$this->render('classesBySubject');
    }

    function docsByClass(){
	session_start();
	$className = $_POST['className'];
	//get documents for class
	$documentManager = $this->getmodel('DocumentsManager');
	$docsForClass = $documentManager->searchDocByClass($className);
	//set docsForClass in session
	$_SESSION['docsForClass'] = $docsForClass;
	$this->render('docsByClass');
    }

    
    function deleteDoc(){
    	session_start();
    	if(isset($_POST['doc_id'])){
    		$docModel = $this->getmodel('Document');
    		$docModel->deleteDocumentByDocId($_POST['doc_id']);
    		
    		//updating page
    		$documentsManager = $this->getmodel('DocumentsManager');
		
		$documentsList = $documentsManager->showAllDocuments();
		$_SESSION['documentsList'] = $documentsList;
    	
    	}
    	
    	$this->render('adminConsole');
    }
    
     function blockDoc(){
    	session_start();
    	if(isset($_POST['doc_id'])){
	    	$docModel = $this->getmodel('Document');
	    	$docModel->blockDocbyId($_POST['doc_id']);
	    	
	    	//updating page
    		$documentsManager = $this->getmodel('DocumentsManager');
		
		$documentsList = $documentsManager->showAllDocuments();
		$_SESSION['documentsList'] = $documentsList;
    	}
    	$this->render('adminConsole');
    }
    
     function unBlockDoc(){
    	session_start();
    	if(isset($_POST['doc_id'])){
	    	$docModel = $this->getmodel('Document');
	    	$docModel->unblockDocbyId($_POST['doc_id']);
	    	
	    	//updating page
    		$documentsManager = $this->getmodel('DocumentsManager');
		
		$documentsList = $documentsManager->showAllDocuments();
		$_SESSION['documentsList'] = $documentsList;
    	}
    	$this->render('adminConsole');
    }
    
    public function likeDoc(){
        session_start();
    	if(isset($_POST['path']) && isset($_POST['path'])){
	    	$docModel = $this->getmodel('Document');
		$docModel->likeDocByPath($_POST['path'], $_POST['name']);
		$_SESSION['upvotes'] = $_SESSION['upvotes'] + 1; //increment count on view page
	    	
	    	$this->docViewer();
    	}
    	else{//the users bypassed some steps, send them back to the document home page
    		$this->home();
    	}
    }
    public function dislikeDoc(){
    	session_start();
    	if(isset($_POST['path']) && isset($_POST['path'])){
	    	$docModel = $this->getmodel('Document');
		$docModel->dislikeDocByPath($_POST['path'], $_POST['name']);
		
		$_SESSION['downvotes'] = $_SESSION['downvotes'] + 1; //increment count on view page
	    	
	    	$this->docViewer();
    	}
    	else{//the users bypassed some steps, send them back to the document home page
    		$this->home();
    	}
    }
    
    public function addComment(){
    	session_start();
    	if(isset($_SESSION['username'])){ /** If the user is logged in **/
    		if(isset($_SESSION['doc_id'])){
    			$doc_id = $_SESSION['doc_id'];
    			$commentModel = $this->getmodel('Comment');
			$commentModel->createComment($doc_id, $_SESSION['username'], $_POST['comment']);
			$docModel = $this->getmodel('Document');
			$_SESSION['commentsList'] = $docModel->displayDocComments($doc_id);
    			$this->render('documentViewer');
    		}
    		else{
    			$this->home();
    		}
    	}
    	else{ /** If the user is not logged in, make them log in **/
    		$this->render('registrationForm');    	
    	}
    }
    
    function addDocsForm(){
    	session_start();
    	
    	if(isset($_SESSION['username'])){
    		//INSERT CODE HERE
    	
    		//$this->render('addDocsForm');
    		$this->uploadView();
    	}
    	else{	/** If the user is not logged in, make them log in **/
    		$this->render('registrationForm');
    	}
    
    }
	

    function addDocument($role, $username, $path){

    }

    function docViewer(){
    
    		session_start(); //connects to ongoing session
    		
		unset($_SESSION['name']);
		//unset($_SESSION['downvotes']);
		//unset($_SESSION['upvotes']);
		
    		
    		if(isset($_POST['doc_id'])){
    			//echo $_POST['doc_id'];
	    		$docModel = $this->getmodel('Document');
	    		// passing variables for rating
			$docModel->getDislikesById($_POST['doc_id']);
			$docModel->getlikesById($_POST['doc_id']);
			$_SESSION['doc_id'] = $_POST['doc_id'];
			$_SESSION['commentsList'] = $docModel->displayDocComments($_POST['doc_id']);
		}
		/**
		else{
			$docModel = $this->getmodel('Document');
			$docModel->getDislikesById($_SESSION['doc_id']);
			$docModel->getlikesById($_SESSION['doc_id']);
		}
    		**/
    		$this->render('documentViewer');
    }
    	
    function uploadView(){
        $this->render('uploadForm');
    }


    function uploadDoc(){
        $this->render('uploadDoc');
    }

    
    

}