<?php include('admin_header.php');
?>

<div id="wrapper">

	<h2>Add User</h2>
	<hr>
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($password != $passwordConfirm){
			$error[] = 'Passwords do not match.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)') ;
				$stmt->execute(array(
					':username' => $username,
					':password' => $password,
					':email' => $email
				));

				//redirect to index page
				header('Location: users.php?action=added');
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

	<form action='' method='post'>

		<p><label>Username</label><br />
		<input type='text' name='username' required></p>

		<p><label>Password</label><br />
		<input type='password' name='password' required></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' required></p>

		<p><label>Email</label><br />
		<input type='email' name='email' required></p>
		
		<p><input type='submit' name='submit' value='Add User' class='btn btn-primary'></p>

	</form>

</div>


<?php include('admin_footer.php'); ?>