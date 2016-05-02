<?php
require_once('cas_setup.php');
require_once('config.php');
require_once('classes.php');
$image = new Image();
$image->image_id = intval($_GET['image_id']);
$image->get();
if(phpCAS::isAuthenticated() && phpCAS::getUser() == $image->uid) {
    $image->delete();
    echo 'Image has been deleted. You will be redirected home in 10 seconds';
    echo '<script>window.setTimeout(function(){
        window.location = "https://ada040.rice.iit.edu";
    },10000);</script>';
}
else {
    echo 'You must be authenticated as the user who uploaded the image to delete it.<br/>You will be redirected home in 10 seconds';
    echo '<script>window.setTimeout(function(){
        window.location = "https://ada040.rice.iit.edu";
    },10000);</script>';
}
?>
