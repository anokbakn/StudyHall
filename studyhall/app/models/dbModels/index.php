<!DOCTYPE html>
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
        function __autoload($class_name){
            include $class_name . '.php';
        }
        
        $user = new RegisteredUser();        
        $user->register('kmassey', 'abc123', 'km1035@msstate.edu', 'Kristen', 'Massey', 'MS', 'Jackson');
        ?>
    </body>
</html>
