<!DOCTYPE html>
use DocumentsManager;
use ForumManager;
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        foreach(glob("./*.php") as $filename){
            include_once $filename;
        }
        
        
        ////////////////////////////////
        //RegisteredUser UNIT TESTS
        ////////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING RegisteredUser UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        $user = new RegisteredUser();
        
        //register new user
        $user->register("armand", "abc123", "anokbak@something.com", "Armand", "Nokbak", "MS", "Starkville");
        unset($user);
        
        //get existing user
        $user = new RegisteredUser('armand');  
        
        //get existing user data
        $email = $user->getEmail();
        printf("Armand's email is %s\n", $email);
        
        //get existing user
        $user2 = new RegisteredUser("armand5");
        
        //login successful (print true)
        $loginSuccess = $user2->login("armand5", "abc123");
        if(is_null($loginSuccess)){
            $pass_fail = "fail";
        }
        else {
            $pass_fail = $loginSuccess;
        }
        printf("User %s logged in successfully: %s\n", "armand5", $pass_fail);
        
        //login unsuccessful (print false)
        $loginSuccess2 = $user2->login("armand5", "abc12"); 
        if(is_null($loginSuccess2)){
            $pass_fail = "fail";
        }
        else {
            $pass_fail = $loginSuccess2;
        }
        printf("User %s logged in successfully: %s\n", "armand5", $pass_fail);
        
        
        //delete user
        $user->deleteUser();
        
        
        //block user
        $user2->block();
        $isBlocked = $user2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("User is blocked: %s\n", $bool_str);
        
        //unblock user
        $user2->unblock();
        $isBlocked2 = $user2->isBlocked();
        $bool_str2 = $isBlocked2 ? "true" : "false";
        printf("User is blocked: %s\n", $bool_str2);

        
        unset($user);
        unset($user2);
        
        
        ////////////////////////////
        //Subject UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING Subject UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct subject
        $subject = new Subject();
        
        //add subject
        $subject->addSubject("Math");
        
        //get subject
        $subject_string = $subject->getSubject();
        printf("Got Subject: %s\n", $subject_string);
        
        //get AZSubjectArray
        $orderedArray = $subject->getAZSubjects();
        printf("Ordered Subjects: \n");
        foreach($orderedArray as $subject_val){
            printf("%s\n", $subject_val);
        }
        

        ////////////////////////////
        //Classes UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING Classes UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct empty class
        $class = new Classes();
        
        //add a class
        $class->addClass("Calculus I", "Math");
        
        unset($class);
        
        //get class from db
        $class2 = new Classes("Calculus I");
        
        //get subject for class
        $my_subject = $class2->getSubject();
        printf("Calculus I subject is: %s\n", $my_subject);
        
        //get A to Z class list
        $orderedArray = $class2->getAZClassList();
        printf("Ordered Classes: \n");
        foreach($orderedArray as $class_val){
            printf("%s\n", $class_val);
        }
        
        //get A to Z class list for specific subject
        $orderedArray = $class2->getClassBySubject("Math");
        printf("Ordered Classes by Subject - Math: \n");
        foreach($orderedArray as $class_val){
            printf("%s\n", $class_val);
        }
        

        
        ////////////////////////////
        //Document UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING Document UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct empty document
        $document = new Document();
        
        //add a document
        $document->createDocument("kmassey", "Distributed Client Server Prog", "Computer Science", "Test 1 Study Guide", ".pdf", "fake/path");
        
        //delete document
        $document->deleteDocument();

        //get document info
        $doc_id = $document->getDocID();
        printf("Document's ID: %d\n", $doc_id);
        
        //new document from ID
        $document2 = new Document(1083097730);
        
        //get name from doc
        $doc_name = $document2->getDocName();
        printf("Doc name retrieved: %s\n", $doc_name);
        
        //get current document scores
        printf("Upvotes: %d\n", $document2->getUpvotes());
        printf("Downvotes: %d\n", $document2->getDownvotes());
        
        //upvote
        printf("Upvoting...\n");
        $document2->rate(1);
        
        //downvote
        printf("Downvoting...\n");
        $document2->rate(0);
        
        //get new document scores
        printf("New Upvotes: %d\n", $document2->getUpvotes());
        printf("New Downvotes: %d\n", $document2->getDownvotes());
        
        //block document
        printf("Blocking %s\n", $doc_name);
        $document2->block();
        $isBlocked = $document2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("%s is blocked:  %s\n", $doc_name, $bool_str);
        
        
        //unblock document
        printf("Unblocking %s\n", $doc_name);
        $document2->unblock();
        $isBlocked = $document2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("%s is blocked: %s\n", $doc_name, $bool_str);
        
        
        ////////////////////////////
        //DocumentManager UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING DocumentManager UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //show all documents
        printf("Show all documents\n");
        $documents = DocumentsManager::showDocuments();
        while($row = $documents->fetch_assoc()){
            printf("%s\n", $row['doc_name']);
        }
        
        //search doc by class
        printf("Show all documents by class - Distributed Client Server Prog: \n");
        $documents = DocumentsManager::searchDocByClass("Distributed Client Server Prog");
        while($row = $documents->fetch_assoc()){
            printf("%s\n", $row['doc_name']);
        }
        
        //search doc by subject
        printf("Show all documents by subject - Computer Science: \n");
        $documents = DocumentsManager::searchDocBySubject("Computer Science");
        while($row = $documents->fetch_assoc()){
            printf("%s\n", $row['doc_name']);
        }
        
        //search comment by doc
        printf("Show all comments by document - Test 1 Study Guide: \n");
        $comments = DocumentsManager::searchCommentByDoc(1083097730);
        while($row = $comments->fetch_assoc()){
            printf("%s\n", $row['comment_body']);
        }
        
        //show all users
        printf("Show all users:\n");
        $users = DocumentsManager::showUsers();
        while($row = $users->fetch_assoc()){
            printf("%s\n", $row['username']);
        }
       
        ////////////////////////////
        //Comment UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING Comment UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct empty comment
        $comment = new Comment();
        
        //add comment
        $comment->createComment(1083097730, "kmassey", "I love this studyguide.");
        
        //delete comment
        $comment->deleteComment();
        
        //fetch existing comment
        $comment2 = new Comment(255494673);
        
        //fetch body of existing comment
        $comment_body = $comment2->getCommentBody();
        printf("Fetched Comment: %s\n", $comment_body);
        
        //block comment
        printf("Blocking comment %d\n", 255494673);
        $comment2->block();
        $isBlocked = $comment2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("Comment %d is blocked:  %s\n", 255494673, $bool_str);
        
        
        //unblock comment
        printf("Unblocking comment %d\n", 255494673);
        $comment2->unblock();
        $isBlocked = $comment2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("Comment %d is blocked: %s\n", 255494673, $bool_str);
        
        
        ////////////////////////////
        //ForumTopic UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING ForumTopic UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct empty forum topic
        $forumTopic = new ForumTopic();
        
        //add topic
        $forumTopic->createForum("kmassey", "Dummy Topic", "Dummy question");
        
        //delete topic
        $forumTopic->deleteForum();
        
        //fetch existing forumTopic
        $forumTopic2 = new ForumTopic(1895578464);
        
        //fetch description of existing forum Topic
        $topic_description = $forumTopic2->getTopicDescription();
        printf("Fetched Topic description: %s\n", $topic_description);
        

        //block forum topic
        printf("Blocking topic %d\n", 1895578464);
        $forumTopic2->block();
        $isBlocked = $forumTopic2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("Forum Topic %d is blocked:  %s\n", 1895578464, $bool_str);
        
        
        //unblock forum topic
        printf("Unblocking topic %d\n", 1895578464);
        $forumTopic2->unblock();
        $isBlocked = $forumTopic2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("Forum Topic %d is blocked: %s\n", 1895578464, $bool_str);
        
        ////////////////////////////
        //ForumPost UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING ForumPost UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct empty forum post
        $forumPost = new ForumPost();
        
        //add post
        $forumPost->createPost(1895578464, "kmassey", "This is a forum post.");
        
        //delete post
        $forumPost->deletePost();
        
        //fetch existing forumPost
        $forumPost2 = new ForumPost(1667447439);
        
        //fetch content of existing forum post
        $post_content = $forumPost2->getPostContent();
        printf("Fetched Post: %s\n", $post_content);
        
        
        //block forum post
        printf("Blocking post %d\n", 1667447439);
        $forumPost2->block();
        $isBlocked = $forumPost2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("Forum Post %d is blocked:  %s\n", 1667447439, $bool_str);
        
        
        //unblock forum post
        printf("Unblocking post %d\n", 1667447439);
        $forumPost2->unblock();
        $isBlocked = $forumPost2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("Forum Post %d is blocked: %s\n", 1667447439, $bool_str);
        
        ////////////////////////////
        //DocumentManager UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING ForumManager UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //show all topics
        printf("Show all forum topics:\n");
        $topics = ForumManager::showTopics();
        while($row = $topics->fetch_assoc()){
            printf("%s\n", $row['topic_name']);
        }
        
        //search posts by topic
        $topic_id = 1895578464;
        printf("Show all forum posts for topic %d\n", $topic_id);
        $posts = ForumManager::getPostsByTopic($topic_id);
        while ($row = $posts->fetch_assoc()){
            printf("%s\n", $row['post_content']);
        }
        ?>
    </body>
</html>
