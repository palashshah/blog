<?php //include config
include('admin_header.php');
?>
<div id="wrapper">

	<h2>Edit Post</h2>


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
		if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				//insert into database
				if($uploadOk == 1){
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont, thumbnail = :thumbnail WHERE postID = :postID') ;
					$stmt->execute(array(
						':postTitle' => $postTitle,
						':postDesc' => $postDesc,
						':postCont' => $postCont,
						':postID' => $postID,
						':thumbnail' => $target_file
					));
				}
				else{
					$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
					$stmt->execute(array(
						':postTitle' => $postTitle,
						':postDesc' => $postDesc,
						':postCont' => $postCont,
						':postID' => $postID
					));	
				}
				// redirect to index page
				header('Location: index.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont, thumbnail FROM blog_posts WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post' enctype='multipart/form-data'>
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br>
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p><br>

		<p><label>Thumbnail</label><br>
		<input type="file" name="fileToUpload" id="fileToUpload" ></p><br>

		<p><label>Description</label><br>
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p><br>

		<p><label>Content</label><br>
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p><br>

		<p><input type='submit' name='submit' value='Update' class="btn btn-primary"></p><br>

	</form>

</div>

<?php include('admin_footer.php') ?>
