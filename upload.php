<?php
    require_once('cas_setup.php');
    require_once('config.php');
    require_once('classes.php');
//    phpCAS::logout();
    if(!phpCAS::isAuthenticated()) {
        phpCAS::forceAuthentication();
    }

    if(isset($_FILES['image'])) {
        $image = new Image();
        #TODO validate/secure user submitted data
        $image->name = $_POST['image_name'];
        $image->uid = phpCAS::getUser();

        if($errors = $image->create($_FILES['image']) === true) {
            foreach($_POST['categories'] as $category) {
                $image->addTag($category);
            }
            echo "<script>window.location = \"http://localhost/photoshare/view.php?photo=$image->image_id\";</script>";
        }
        else {
            print_r($errors);
        }
}
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
<!--<div class="main-header" id="banner">
    <h1 id="hawkstagram"><span>Hawks</span>tagram</h1>
    <div>
        <img src="search-icon-white.png" alt="search_icon" id="search">
        <button id="sign_in" >Sign In</button>
    </div>
</div>
s
<form action="connect.php" method="POST" enctype="multipart/form-data">
    <label for="image_ID">Select image to upload:</label>
    <input type="submit" name="image" id="imageToUpload" size="30"/>
</form> <br>
<form>
    <label >Name: <input type="text" name="fname" /></label>
</form>

<h2>Categories</h2>
<button type="button">Graduation</button>
<button type="button">Sports</button>
<button type="button">IPRO</button><br>
<button type="button">Events</button>
<button type="button">College Life</button>
<button type="button">Graduation</button><br>
<button type="button">Graduation</button>
<button type="button">Graduation</button>
<button type="button">Graduation</button><br><br>
<input type="submit" value="Submit"/>



<h1>Welcome <?php /*echo $login_session; */?></h1>
<h2><a href = "index.html">Sign Out</a></h2>-->


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

        <img src="images/search-icon-white.png"alt="search_icon" id="search" >

    </div>

</div>
<form method="post" enctype="multipart/form-data">
    <div class="image-upload">
        <label for="file">
            <img src="images/upload_icon.png"/>
        </label>

        <input name="image" type="file" class="file-input" id="file" placeholder="Choose the file from your device"/>
        <input name="image_name">
    </div>


    <div class="container">
        <div id="output"></div>

        <h2>Please choose the Category</h2>
        <ul id="category" class="category_buttons">

            <li><input type="checkbox" name="categories[]" value="graduation">Graduation</li>
            <li><input type="checkbox" name="categories[]" value="events">Events</li>
            <li><input type="checkbox" name="categories[]" value="campus">Campus</li>
            <li><input type="checkbox" name="categories[]" value="international students">International Students</li>
            <li><input type="checkbox" name="categories[]" value="sports">Sports</li>
            <li><input type="checkbox" name="categories[]" value="student life">Student Life</li>
            <li><input type="checkbox" name="categories[]" value="ipro">IPRO</li>
            <li><input type="checkbox" name="categories[]" value="engineering">Armour College of Engineering</li>
            <li><input type="checkbox" name="categories[]" value="kent_law">Chicago-Kent College of Law</li>
            <li><input type="checkbox" name="categories[]" value="arch">College of Architecture</li>
            <li><input type="checkbox" name="categories[]" value="science">College of Science</li>
            <li><input type="checkbox" name="categories[]" value="design">Institute of Design</li>
            <li><input type="checkbox" name="categories[]" value="food_safety">Institute for Food Safety and Health</li>
            <li><input type="checkbox" name="categories[]" value="humanities">Lewis College of Human Sciences</li>
            <li><input type="checkbox" name="categories[]" value="biomedical">Pritzker Institute of Biomedical Science and Engineering</li>
            <li><input type="checkbox" name="categories[]" value="sat">School of Applied Technology</li>
            <li><input type="checkbox" name="categories[]" value="stuart">Stuart School of Business</li>
            <li><input type="checkbox" name="categories[]" value="wiser">WISER</li>

        </ul>
    </div>
        <button type="submit">SUBMIT</button>
</form>





<script>

    function handleFileSelect(evt) {
        var fileList = evt.target.files;
        console.log(fileList);

        for (var i = 0; i < fileList.length; i++) {
            //fileList[i]
            if (fileList[i].type.match('image.*')) {
                renderImage(fileList[i]);
            }
        };
    }
    function renderImage(aFile){
        var reader = new FileReader();
        reader.onload = function(evt){
            var outputDiv = document.getElementById('output');
            console.log(evt);
            var dataUrl = evt.target.result;

            var img = document.createElement('img');
            img.src = dataUrl;
            img.height = '200';
            outputDiv.appendChild(img);
        };
        reader.readAsDataURL(aFile);
    }

    document.getElementById('file').addEventListener('change', handleFileSelect, false);


</script>
</body>
</html>
