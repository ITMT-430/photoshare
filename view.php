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
	
		<button id="home"onclick="location.href='index.php';" >Home</button> 



<?php
require_once('cas_setup.php');
require_once('config.php');
require_once('classes.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if(!isset($_GET['photo'])) {
    header("Location: http://$host$uri/index.php");
    die();
}

$image = new Image();
$image->image_id = intval($_GET['photo']);
$image->get();
//#TODO throw error if photo id doesn't point to real photo
?>
	<div class="container">
<h1><?php echo $image->name; ?></h1>
<img src="<?php echo $image->getURL() ?>"/>
<?php
//this checks to see if the person viewing the image is logged in as the user who uploaded the image
if(phpCAS::isAuthenticated() && phpCAS::getUser() == $image->uid) {
    echo '<form method="get" action="delete_image.php" onsubmit="return confirm(\'Are you sure you want to delete this image?\')">
    <button type="submit">DELETE IMAGE</button>
    <input type="hidden" name="image_id" value="'.$_GET['photo'].'"/></form>';
}

echo '<div id="tags">';
foreach($image->tags as $tag) {
    echo "<div>$tag->category</divS>";
}
echo '</div>';
?>

</div>
</body>
</html>
