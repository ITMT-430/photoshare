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
	<link rel="stylesheet" href="lightbox/lightbox2-master/dist/css/lightbox.min.css">
	<title>IIT Photoshare Site</title>
</head>

<body>

	<div class="main-header" id="banner">
		<h1 id="hawkstagram"><span>Hawks</span>tagram</h1>
		<div>
      <img src="images/search-icon-white.png" alt="search_icon" id="search" />

      <?php
      if(phpCAS::isAuthenticated()){
        echo '<input type="button" value="'.phpCAS::getUser().'"/>';
      }
      else {
        echo '<a href="index.php?signin=true"><input type="button" value="SIGN IN" id="signin" /></a>';
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




	<div class='main-header' id="before_search">
		<img src="images/search-icon-white.png"alt="search_icon">
		<h2>Search for pictures:</h2>
	</div>
  <form id="searchbox" action="">

		<input id="search_pic" type="text" placeholder="Type here">
   	 <input id="submit" type="submit" value="Search">

  </form>



	<!--<h2>Categories:</h2>-->
  <section class="category">
	<div>
    	<a class="example-image-link" href="images/graduation.jpg" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard."><img class="example-image" src="images/graduation.jpg" alt="" /></a>

	</div>
	<div>
	    <a class="example-image-link" href="images/international.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image" src="images/international.jpg" alt=""/></a>
	</div>
	<div>
	    <a class="example-image-link" href="images/mtcc.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="images/mtcc.jpg" alt="" /></a>

	</div>
	<div>
    	<a class="example-image-link" href="images/ramn.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="images/ramn.jpg" alt="" /></a>
	</div>
	<div>
		<a class="example-image-link" href="images/stuart-lab.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="images/stuart-lab.jpg" alt="" /></a>
    </div>
	<div>
		<a class="example-image-link" href="images/sport.jpg" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="images/sport.jpg" alt="" /></a>

	</div>



    </section>


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

<script src="lightbox/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
<script>
	var search_top = document.getElementById('search');
	search_top.addEventListener('click',function(){
	document.getElementById('searchbox').scrollIntoView();
	});
</script>
</body>
</html>
