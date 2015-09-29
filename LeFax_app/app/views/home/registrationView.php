


<?php
//Hello <?=$data['name']
//si la personne est deja connectee
if (isset($_SESSION['username'])) {
    // ajouter le header
    require_once 'header.php';
    echo 'Welcome ' . $_SESSION['username']. ' you do not need to register.';
} else {

    // ajouter le header
    require_once 'header.php';
    
    ?>
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>

    
    <form action="../home/indexNewUser" method="POST">
        <table>
            <th>New user? Register</th>
            <tr><p>
                <?php
                    //error message
                    if(isset($_SESSION['error_message'])){
                        echo '<i style="color:red">'.$_SESSION['error_message'] . '</i>';
                        
                        //delete the error message from memory
                        unset($_SESSION['error_message']);
                    }
                ?>
                    </p></tr>
            <tr><td><p>First name: </p></td><td><input type="text" name="firstname" required></td></tr>
            <tr><td><p>Last name: </p></td><td><input type="text" name="lastname" required></td></tr>
            <tr><td><p>Email address: </p></td><td><input type="email" name="email" required></td></tr>
            <tr><td><p>City: </p></td><td><input type="text" name="city" required></td></tr>
            <tr><td><p>State: </p></td><td><input type="text" name="state" required></td></tr>
            <tr><td><p>Country </p></td><td><input type="text" name="country" required></td></tr>
            <tr><td><p>User name: </p></td><td><input type="text" name="username" required></td></tr>
            <tr><td><p>Password: </p></td><td><input type="password" name="password" required 
                                                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                                         title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></td></tr>
            <tr><td><input type="submit"></td><td><input type="reset"></td></tr>
        </table>
    </form>
    </div>
    </body>
    </html>

    <?php
}
?>