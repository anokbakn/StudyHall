    <?php

/**
 * @author Armand Nokbak
 */

if (isset($_SESSION['username'])) {
    // ajouter le header
   // require_once 'header.php';
    //echo 'Welcome ' . $_SESSION['username']. ' you do not need to register.';
} else {

    
    
    ?>
    <div class="col-md-4">
	</div>
    
    <div class="col-md-4" >
    <form action="../home/indexLogMeIn" method="POST" class="form-horizontal"  role="form">
                                    <div class="form-group">
                                    	<label class="control-label col-sm-5">Please Log in:</label>
                                    </div>
                                    <div class="form-group">
                                    
                                    	<label class="control-label col-sm-5">Username:</label>
                                    	<div class="col-sm-7">
                                        	<input type="text" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="control-label col-sm-5">Password:</label>
                                    	<div class="col-sm-7">
                                        	<input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<div class="col-sm-5">
                                    	</div>
                                        <div class="col-sm-7">
                                        	<input type="submit" class="btn btn-primary" value="Login" style="float:right">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<div class="col-sm-5">
                                    	</div>
                                        <label class="control-label col-sm-7" style="color:red"><?php if(isset($_SESSION['errorMessage'])){ echo '<i>'. $_SESSION['errorMessage'] . '</i>'; $_SESSION['errorMessage']='';} ?></label>
                                    
                                    </div>
    </form>
    
       

    
    <form action="../home/registerNewUser" method="POST" class="form-horizontal"  role="form">
        <div class="form-group">
        	<label>New user? Register</label>
        </div>
        <div class="form-group">
        	<label class="control-label col-sm-5">
                <?php
                    //error message
                    if(isset($_SESSION['error_message'])){
                        echo '<i style="color:red">'.$_SESSION['error_message'] . '</i>';
                        
                        //delete the error message from memory
                        unset($_SESSION['error_message']);
                    }
                ?>
         </label>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">First name: </label>
            <div class="col-sm-7">
            	<input type="text" class="form-control" name="firstname" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">Last name: </label>
            <div class="col-sm-7">
            	<input type="text" class="form-control" name="lastname" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">Email address: </label>
            <div class="col-sm-7">
            	<input type="email" class="form-control" name="email" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">City: </label>
            <div class="col-sm-7">
            	<input type="text" class="form-control" name="city" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">State: </label>
            <div class="col-sm-7">
            	<input type="text" class="form-control" name="state" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">Country: </label>
            <div class="col-sm-7">
            	<input type="text" class="form-control" name="country" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">User name: </label>
            <div class="col-sm-7">
            	<input type="text" class="form-control" name="username" required>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-5">Password: </label>
            <div class="col-sm-7">
            	<input type="password" class="form-control" name="password" required 
                                                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                                         title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
           </div>
         </div>
         <div class="form-group">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
            	<input type="submit" value="Register" class="btn btn-primary" style="float:right">
            </div>
         </div>
        
    </form>
    
    </div> <!--  end of forms div-->
    
    
    <div class="col-md-4">
	</div>
    
    <br>
    <p><br></p>
    
   

    <?php
}
?>




<!-- end of code written by Kristen Massey  -->