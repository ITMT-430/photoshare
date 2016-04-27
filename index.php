<?php
/**
 * Created by PhpStorm.
 * User: Marilyn
 * Date: 4/26/2016
 * Time: 6:04 PM
 */
require_once('cas_setup.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>IIT Photoshare Site</title>
</head>

<body>

	<div class="main-header" id="banner">
		<h1 id="hawkstagram"><span>Hawks</span>tagram</h1>
		<div>
      <img src="search-icon-white.png" alt="search_icon" id="search" />
      <?php
      if(phpCAS::isAuthenticated()){
        echo '<input type="button" value="'.phpCAS::getUser().'"/>';
      }
      else {
        echo '<a href="index.php?signin=true"><input type="button" value="SIGN IN" id="big_signin" /></a>';
      }
      ?>
    </div>
	</div>

	<div>
		<div id="center">
			<div class="wrapper">


        <h2>Where Illinois Tech Hawks share pictures</h2>
        <p>Here students can upload,search,organize, and share your pictures.	</p>
        <?php
        if(phpCAS::isAuthenticated()){
         echo 'Welcome, Upload Your Pictures Here!';

        }
        else {
          echo '<a href="index.php?signin=true"><input type="button" value="SIGN IN" id="big_signin" /></a>';
        }
        ?>

        <?php
        if(phpCAS::isAuthenticated()){
          echo '<a href="upload.php">Upload Picture</a>';

        }
        ?>

      </div>
		</div>
	</div>




  <form id="searchbox" action="">
    <input id="search_pic" type="text" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
  </form>



	<!--<h2>Categories:</h2>-->
  <div class="category">
    <div class="navigate">
      <img src="images/international.jpg"/>
    </div>
    <div>
      <img src="images/graduation.jpg" >
    </div>
    <div>
      <img src="images/mtcc.jpg" >
    </div>
      <img src="images/sport.jpg" >
      <img src="images/ramn.jpg" >
      <img src="images/stuart-lab.jpg">
  </div>



  <div id="footer">
  	<nav>
 		 <ul>
       <?php
       if(phpCAS::isAuthenticated()){
         echo '<input type="button" value="'.phpCAS::getUser().'"/>';
       }
       else {
         echo '<a href="index.php?signin=true"><input type="button" value="SIGN IN" id="big_signin" /></a>';
       }
       ?>
       <li class="active"><a href="#searchbox">Search</a></li>
       <li><a href="#">Suggestions</a></li>
       <li><a href="#">Team Members</a></li>
  	 </ul>
	 </nav>
	</div>


  	<div class="Copyright">
		<p>&copy; Hawkstagram.com<p>
  	</div>

<!--  <script>-->
<!--    var btn_signin = document.getElementById('sign_in');-->
<!--    btn_signin.addEventListener('click', function(){-->
<!--      document.location = 'signin.php';-->
<!--    });-->
<!--  </script>-->

</body>
</html>
