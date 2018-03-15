<?php
include('admin_header.php');

//check if already logged in
if( $user && $user->is_logged_in() ){ header('Location: index.php'); } 

?>

	<title>Admin Login</title>
<div class="container col-md-4 col-md-offset-4">

	<?php

	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if($user->login($username,$password)){ 

			//logged in return to index page
			header('Location: index.php');
			exit;

		} else {
			$message = '<p class="error">Wrong username or password</p>';
		}

	}//end if submit

	if(isset($message)){ echo $message; }
	?>
	<br><br><br>
	<form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Sign in</h2>
        <hr>
        <label class="sr-only">Email address</label>
        <input type="text" name="username" class="form-control" placeholder="Email address" required autofocus/>
        <br>
        <label class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required/>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" >Sign in</button>
	</form>
<br><br>
<?php include('admin_footer.php') ?>
</div>
