<!DOCTYPE html>

<html>
    <head>
        <title>StudyHall Your study buddy</title>
<!-- from Kristen Massey  -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- end of code from Kristen Massey  -->
<!-- added by Armand Nokbak -->
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- end of code added by Armand Nokbak -->

<!-- code from Kristen Massey  -->
        <style>
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
            }
            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by its height */
                margin: 0 auto -60px;
                /* Pad bottom by footer height */
                padding: 0 0 60px;
            }
            /* Set the fixed height of the footer here */
            #footer {
                height: 60px;
                background-color: #f5f5f5;
            }
            /* Custom page CSS
            -------------------------------------------------- */
            /* Not required for template or sticky footer method. */
            #wrap > .container {
                padding: 60px 15px 0;
            }
            .container .credit {
                margin: 20px 0;
            }
            #footer > .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            code {
                font-size: 80%;
            }

            .navbar-header{
                padding-top: 15px;
            }
            .form-control{
                position:relative;
            }
            .form-group.required .control-label:after {
                content:"*";
                color:red;
            }
        </style>

    </head>
    <body>
        <!-- Wrap all page content here -->
        <div id="wrap">

            <!-- Fixed navbar -->
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- line below by Armand Nokbak  -->
                        <a class="navbar-brand" href="../home/index">StudyHall</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="../home/index">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <s></s>

                        <div class="input-group" style="float: right">
                            <?php
 //code below by Armand Nokbak
                            if (!isset($_SESSION['username'])) {
                                ?>

                                <form action="../home/indexLogin" method="POST" >
                                    <br>
                                    <table style="">
                                        <tr>
                                            <td><input type="text" name="username" placeholder="user name"></td>
                                            <td><input type="password" name="password" placeholder="password"></td>
                                            <td><input type="submit" value="Login"></td>
                                            <td>   or <a href="../home/showRegistration">Register</a></td>
                                        </tr>
                                    </table>
                                    <br>
                                </form>

                                <?php
                            } else {
                                ?>
                                <br>
                                <table style="">
                                    <tr>
                                        <td><?php echo 'Welcome ' . $_SESSION['username'] . ' ! '; ?></td>
                                        <td><?php echo '<a href="../home/logout">Logout</a>'; ?></td>
                                    </tr>
                                </table>

                                <?php
                            }
//end of code by Armand
                            ?>
                        </div>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
<!-- end of code from Kristen Massey  -->