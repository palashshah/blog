<?php

include('admin_header.php');

?>

<div id="wrapper">

	<h2>Add Post</h2>
	<hr>
	<?php
	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_posts (memberID,postTitle,postDesc,postCont,postDate,thumbnail) VALUES (:memberID, :postTitle, :postDesc, :postCont, :postDate, :thumbnail)') ;
				$stmt->execute(array(
					':memberID' => $_SESSION['memberID'],
					':postTitle' => $postTitle,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s'),
					':thumbnail' => $target_file
				));

				//redirect to index page
				header('Location: index.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post' enctype='multipart/form-data'>

		<p><label>Title</label><br>
		<input type='text' name='postTitle' required></p>

		<p><label>Thumbnail</label><br>
		<input type="file" name="fileToUpload" id="fileToUpload" required></p>

		<p><label>Description</label><br>
		<textarea name='postDesc' cols='60' rows='10' ><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

		<p><label>Content</label><br>
		<textarea name='postCont' cols='60' rows='10' ><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

		<p><input type='submit' name='submit' value='Submit' class='btn btn-primary'></p>

	</form>

</div>

<?php include('admin_footer.php') ?>