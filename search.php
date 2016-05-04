<?php
    require_once('cas_setup.php');
    require_once('config.php');
    require_once('classes.php');

    if(isset($_POST['submitted'])) {
        global $db;
        //if both are specified
        if((isset($_POST['name']) && trim($_POST['name']) != '') && (isset($_POST['categories']) && sizeof($_POST['categories']) > 0)) {
            $query = "SELECT * FROM images_table JOIN tags_table ON images_table.image_ID = tags_table.image_ID WHERE category IN (";
            foreach($_POST['categories'] as $index=>$category) {
                $query .= '"'.$category.'"';
                if($index != sizeof($_POST['categories'])-1) $query .= ",";
            }
            $query .= ') AND name LIKE "%'.trim($_POST['name']).'%" ';

            $query .= "GROUP BY images_table.image_ID HAVING COUNT(*) = ".sizeof($_POST['categories']);

            $result = $db->query($query);
            $result = $result->fetch_all();

        }
        //if only categories are selected
        elseif(isset($_POST['categories']) && sizeof($_POST['categories']) > 0) {
            $query = "SELECT * FROM images_table JOIN tags_table ON images_table.image_ID = tags_table.image_ID WHERE category IN (";
            foreach($_POST['categories'] as $index=>$category) {
                $query .= '"'.$category.'"';
                if($index != sizeof($_POST['categories'])-1) $query .= ",";
            }
            $query .= ') ';

            $query .= "GROUP BY images_table.image_ID HAVING COUNT(*) = ".sizeof($_POST['categories']);

            $result = $db->query($query);
            $result = $result->fetch_all();

        }
        //if only name is specified
        elseif(isset($_POST['name']) && trim($_POST['name']) != '') {
            $query = "SELECT * FROM images_table WHERE name LIKE \"%".trim($_POST['name']).'%" ';

            $result = $db->query($query);
            $result = $result->fetch_all();
        }
        $results = array();
        foreach($result as $r) {
            $i = new Image();
            $i->image_id = $r[0];
            $i->get();
            $results[] = $i;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
body: { 
background-color: #333; 
color: ghost-white;}
</style>
</head>
<body>
<div class="main-header" id="banner">
<h1 id="hawkstagram"><span>Hawk</span>tagram</h1>
<button id="home"onclick="location.href='index.php';">Home</button>
</div>
<h1>Search</h1>
<form method="post">
    Name:<input type="text" name="name"
    <?php if(isset($_POST['name'])) echo 'value="'.$_POST['name'].'"'; ?>
    /><br/>
    Category:
    <ul id="category">
        <li><input type="checkbox" name="categories[]" value="graduation" <?php if(isset($_POST['categories']) && is_int(array_search('graduation',$_POST['categories']))) echo 'checked'; ?>>Graduation</li>
        <li><input type="checkbox" name="categories[]" value="events" <?php if(isset($_POST['categories']) && is_int(array_search('events',$_POST['categories']))) echo 'checked'; ?>>Events</li>
        <li><input type="checkbox" name="categories[]" value="campus" <?php if(isset($_POST['categories']) && is_int(array_search('campus',$_POST['categories']))) echo 'checked'; ?>>Campus</li>
        <li><input type="checkbox" name="categories[]" value="international students" <?php if(isset($_POST['categories']) && is_int(array_search('international students',$_POST['categories']))) echo 'checked'; ?>>International Students</li>
        <li><input type="checkbox" name="categories[]" value="sports" <?php if(isset($_POST['categories']) && is_int(array_search('sports',$_POST['categories']))) echo 'checked'; ?>>Sports</li>
        <li><input type="checkbox" name="categories[]" value="student life" <?php if(isset($_POST['categories']) && is_int(array_search('student life',$_POST['categories']))) echo 'checked'; ?>>Student Life</li>
        <li><input type="checkbox" name="categories[]" value="ipro" <?php if(isset($_POST['categories']) && is_int(array_search('ipro',$_POST['categories']))) echo 'checked'; ?>>IPRO</li>
        <li><input type="checkbox" name="categories[]" value="engineering" <?php if(isset($_POST['categories']) && is_int(array_search('engineering',$_POST['categories']))) echo 'checked'; ?>>Armour College of Engineering</li>
        <li><input type="checkbox" name="categories[]" value="kent_law" <?php if(isset($_POST['categories']) && is_int(array_search('kent_law',$_POST['categories']))) echo 'checked'; ?>>Chicago-Kent College of Law</li>
        <li><input type="checkbox" name="categories[]" value="arch" <?php if(isset($_POST['categories']) && is_int(array_search('arch',$_POST['categories']))) echo 'checked'; ?>>College of Architecture</li>
        <li><input type="checkbox" name="categories[]" value="science" <?php if(isset($_POST['categories']) && is_int(array_search('science',$_POST['categories']))) echo 'checked'; ?>>College of Science</li>
        <li><input type="checkbox" name="categories[]" value="design" <?php if(isset($_POST['categories']) && is_int(array_search('design',$_POST['categories']))) echo 'checked'; ?>>Institute of Design</li>
        <li><input type="checkbox" name="categories[]" value="food_safety" <?php if(isset($_POST['categories']) && is_int(array_search('food_safety',$_POST['categories']))) echo 'checked'; ?>>Institute for Food Safety and Health</li>
        <li><input type="checkbox" name="categories[]" value="humanities" <?php if(isset($_POST['categories']) && is_int(array_search('humanities',$_POST['categories']))) echo 'checked'; ?>>Lewis College of Human Sciences</li>
        <li><input type="checkbox" name="categories[]" value="biomedical" <?php if(isset($_POST['categories']) && is_int(array_search('biomedical',$_POST['categories']))) echo 'checked'; ?>>Pritzker Institute of Biomedical Science and Engineering</li>
        <li><input type="checkbox" name="categories[]" value="sat" <?php if(isset($_POST['categories']) && is_int(array_search('sat',$_POST['categories']))) echo 'checked'; ?>>School of Applied Technology</li>
        <li><input type="checkbox" name="categories[]" value="stuart" <?php if(isset($_POST['categories']) && is_int(array_search('stuart',$_POST['categories']))) echo 'checked'; ?>>Stuart School of Business</li>
        <li><input type="checkbox" name="categories[]" value="wiser" <?php if(isset($_POST['categories']) && is_int(array_search('wiser',$_POST['categories']))) echo 'checked'; ?>>WISER</li>
    </ul>
    <input type="hidden" name="submitted" value="true"/>
    <input type="submit">
</form>

<?php
if(isset($_POST['submitted'])) {
    echo '<div id="results"><h1>RESULTS</h1>';
    if(sizeof($results) == 0) echo 'No results. Try modifying query';
    else {
        foreach($results as $image) {?>
            <h2><?php echo $image->name; ?></h2>
            <img src="<?php echo $image->getURL() ?>"/>
            <?php
            //this checks to see if the person viewing the image is logged in as the user who uploaded the image
            if(phpCAS::isAuthenticated() && phpCAS::getUser() == $image->uid) {
                echo '<form method="get" action="delete_image.php" onsubmit="return confirm(\'Are you sure you want to delete this image?\')">
                <button type="submit">DELETE IMAGE</button>
                <input type="hidden" name="image_id" value="'.$image->image_id.'"/></form>';
            }

            echo '<ul id="tags">';
            foreach($image->tags as $tag) {
                echo "<li>$tag->category</li>";
            }
            echo '</ul>';
          }
    }
    echo '</div>';
}
?>
</body>
</html>
