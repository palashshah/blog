<?php 
	$file1 = 'includes/config.php';
	if(file_exists($file1))
		include($file1); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="index.php">Blog</a>
		    </div>
		    <ul class="nav navbar-nav">
			    <li><a href="index.php">Home</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		    	<?php 
				if(isset($_SESSION['memberID'])) { ?>
				<li class="text-right"><a href="admin/index.php" target="_blank">Dashboard</a></li>
				<li class="text-right"><a href="admin/logout.php">Logout</a></li>
		  		<?php } else {?>
		  		<li class="text-right"><a href="admin/login.php">Login</a></li>
		  		<?php } ?>
		    </ul>
		  </div>
	</nav>