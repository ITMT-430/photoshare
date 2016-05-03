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

        $errors = $image->create($_FILES['image']);
        if($errors === true) {

            foreach($_POST['categories'] as $category) {
                $image->addTag($category);
            }
            echo "<script>window.location = \"http://localhost/photoshare/view.php?photo=$image->image_id\";</script>";
            die();
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

        
<button id="home" >Home</a></button>
    </div>

</div>
<form method="post" enctype="multipart/form-data">
   <div class="image-upload">
	<input type="file" accept="image/*" id="file"  class="inputfile"  data-multiple-caption="{count} files selected" multiple/>
	<label for="file"><span>Choose a file</span></label>
	<div id="file_name">
	<label for="image_name">Enter the name of the file:</label>
	<input name="image_name" id="image_name">
	</div>
	</div>


    <div class="container">
        <div id="output"></div>


        
        <?php
            if(is_array($errors)) {
                echo '<div id="errors">There was an error in your upload:<ul>';
                foreach($errors as $error) echo "<li>$error</li>";
                echo '</ul></div>';
            }
        ?>


	<h2>Please choose the Category</h2>
	    <div id="category" class="category_buttons">
		
		<div><input type="checkbox" name="categories[]" value="graduation">Graduation</div>
		<div><input type="checkbox" name="categories[]" value="events">Events</div>
		<div><input type="checkbox" name="categories[]" value="campus">Campus</div>
		<div><input type="checkbox" name="categories[]" value="international students">International Students</div>
		<div><input type="checkbox" name="categories[]" value="sports">Sports</div>
		<div><input type="checkbox" name="categories[]" value="student life">Student Life</div>
		<div><input type="checkbox" name="categories[]" value="ipro">IPRO</div>
		<div><input type="checkbox" name="categories[]" value="engineering">Armour College of Engineering</div>
		<div><input type="checkbox" name="categories[]" value="kent_law">Chicago-Kent College of Law</div>
		<div><input type="checkbox" name="categories[]" value="arch">College of Architecture</div>
		<div><input type="checkbox" name="categories[]" value="arch">College of Science</div>
		<div><input type="checkbox" name="categories[]" value="design">Institute of Design</div>
		<div><input type="checkbox" name="categories[]" value="food_safety">Institute for Food Safety and Health</div>
		<div><input type="checkbox" name="categories[]" value="humanities">Lewis College of Human Sciences</div>
		<div><input type="checkbox" name="categories[]" value="biomedical">Pritzker Institute of Biomedical Science and Engineering</div>
		<div><input type="checkbox" name="categories[]" value="sat">School of Applied Technology</div>
		<div><input type="checkbox" name="categories[]" value="stuart">Stuart School of Business</div>
		<div><input type="checkbox" name="categories[]" value="wiser">WISER</div>
		

    </div>
        <button type="submit" id="submit_upload">SUBMIT</button>
</form>
</div>


<div class="footer">


</div>




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


		var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( '\\' ).pop();

		if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});

</script>
</body>
</html>
