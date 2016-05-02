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
<h1><?php echo $image->name; ?></h1>
<img src="<?php echo $image->getURL() ?>"/>
<?php
//this checks to see if the person viewing the image is logged in as the user who uploaded the image
if(phpCAS::isAuthenticated() && phpCAS::getUser() == $image->uid) {
    echo '<form method="get" action="delete_image.php" onsubmit="return confirm(\'Are you sure you want to delete this image?\')">
    <button type="submit">DELETE IMAGE</button>
    <input type="hidden" name="image_id" value="'.$_GET['photo'].'"/></form>';
}

echo '<ul id="tags">';
foreach($image->tags as $tag) {
    echo "<li>$tag->category</li>";
}
echo '</ul>';
?>
