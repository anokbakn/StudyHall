<?php
/**
 * @author Armand Nokbak
 *
 * The forums controller
 *
 */


class Forums extends Kite {

	function home(){
		session_start();
		$forumManager = $this->getmodel('ForumManager');
		$_SESSION['forumsList'] = $forumManager->showTopics();
		
		$this->render('forumsHome');
	}
	
	public function createForumTopic(){
		session_start(); //connect to ongoing session
		
		if(isset($_SESSION['username'])){
		
			$this->render('addForumTopic');	
		}
		else{
			$this->render('registrationForm');
		}
	}
	
	public function processNewTopic(){
		session_start(); //connect to ongoing session
		
		if(isset($_SESSION['username'])){
		
			if(isset($_POST['forumName'])){//to make sure that they filled out the form
				$forumModel = $this->getmodel('ForumTopic');
				$forumModel->createForum($_SESSION['username'], $_POST['forumName'], $_POST['forumDescription']);
				
				//this actualizes the forums page
				$forumManager = $this->getmodel('ForumManager');
				$_SESSION['forumsList'] = $forumManager->showTopics();
				
				$_SESSION['forumsErrorMessage'] = 'Your forum topic was successfully created.<br> Thank you!'; /** If creation is successful **/
				$this->render('forumsHome');
			}
			else{
				$this->render('registrationForm');
			}
		
				
		}
		else{
			
			$this->render('registrationForm');
		}
	
	}
	
	public function viewForum(){
		session_start(); //connect to ongoing session
		if((isset($_POST['topic_id'])) && (isset($_POST['topic_name'])) && (isset($_POST['username']))){
			
			$_SESSION['topic_name'] = $_POST['topic_name'];
			$_SESSION['topic_id'] = $_POST['topic_id'];
			$_SESSION['topic_username'] = $_POST['username'];
			$_SESSION['description'] = $_POST['description'];
			//to get the list of forum posts
			$_SESSION['forumPostList']= $this->getmodel('ForumManager')->getPostsByTopic($_SESSION['topic_id']);
			
			$this->render('displayForum');
		}
		else{
			$this->home();
		}
	}
	
	public function addPost(){
		session_start(); //connect to ongoing session
		$_SESSION['forumPostList']=array();
		//echo 'topic id: '.$_SESSION['topic_id'].'<br>';
		if(isset($_SESSION['username']) && isset($_POST['forum_post'])){
			$forumPost = $this->getmodel('ForumPost')->createPost($_SESSION['topic_id'], $_SESSION['username'], $_POST['forum_post']);
			$_SESSION['forumPostList']= $this->getmodel('ForumManager')->getPostsByTopic($_SESSION['topic_id']);
			//var_dump($_SESSION['forumPostList']);
			$this->render('displayForum');
		}
		else{
			$this->render('registrationForm');
		}
	}
	
	public function deleteForum(){
		if(isset($_POST['topic_id'])){
			$forumTopic = $this->getmodel('ForumTopic')->deleteForum($_POST['topic_id']);
			$this->home();
		}
		else{
			$this->home();
		}
	}
	
	public function blockForum(){
		if(isset($_POST['topic_id'])){
			$forumTopic = $this->getmodel('ForumTopic')->block($_POST['topic_id']);
			$this->home();
		}
		else{
			$this->home();
		}
	}
	
	public function unblockForum(){
		if(isset($_POST['topic_id'])){
			$forumTopic = $this->getmodel('ForumTopic')->unblock($_POST['topic_id']);
			$this->home();
		}
		else{
			$this->home();
		}
	}


}

?>