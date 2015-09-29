


<?php
//Hello <?=$data['name']
//si la personne est deja connectee
if (isset($_SESSION['username'])) {
    // ajouter le header
    require_once 'header.php';
    echo 'Welcome ' . $_SESSION['username']. ' !';
} else {

    // ajouter le header
    require_once 'header.php';
    ?>
     <!-- Fixed navbar -->
          <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
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
                <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1"></span>
                        <!--<input type="text" class="form-control" placeholder="Search" aria-describedby="sizing-addon1"> -->
                        <form action="../home/indexLogin" method="POST">
                            <br>
                            <table>
                                <tr>
                                    <td><input type="text" name="username" placeholder="user name"></td>
                                    <td><input type="password" name="password" placeholder="password"></td>
                                    <td><input type="submit" value="Login"></td>
                                    <td>   or <a href="../home/showRegistration">Register</a></td>
                                </tr>
                            </table>
                            <br>
                        </form>
                    </div>
                  </div><!--/.nav-collapse -->
            </div>
          </div>

          <!-- Begin page content -->
          <div class="container">


            <div class="page-header">
              <h1>Need Some Help Studying?</h1>
            </div>
            <!-- sidebar -->
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <ul class="nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Subjects</a></li>
                  <li><a href="#">A-Z Class List</a></li>
                  <li><a href="#">Forums</a></li>              
                </ul>
            </div>
            <p class="lead">StudyHall is a user driven study material sharing site.  Visitors can search and view uploaded class material submissions.  Registered users can create classes, add subjects, and upload their own study materials to share.  StudyHall aims to help connect you to the materials that you need to succeed in your educational endeavors.  Users can also rate the materials available on StudyHall, comment on posts, and interact with other users in the site <a href="#">Forums</a>.</p>
            <p class="lead">Not a user?  Want access to user privileges?  <a href="#">Register now</a>.</p>
            <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p>
          </div>
        </div>

        <div id="footer">
          <div class="container">
            <p class="text-muted credit">StudyHall<sup>©</sup> 2015.</p>
          </div>
        </div>
    </body>
</html>

    <?php
}
?>