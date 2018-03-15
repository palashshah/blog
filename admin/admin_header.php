<?php include('../includes/config.php'); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" href="../style/normalize.css">
	<link rel="stylesheet" href="../style/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet"/>
	<script>
	      tinymce.init({
	          selector: "textarea",
	          plugins: [
	              "advlist autolink lists link image charmap print preview anchor",
	              "searchreplace visualblocks code fullscreen",
	              "insertdatetime media table contextmenu paste"
	          ],
	          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	      });
	</script>

	<script language="JavaScript" type="text/javascript">
	function delpost(id, title)
	{
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'index.php?delpost=' + id;
	  }
	}


	function deluser(id, title)
	{
		if (confirm("Are you sure you want to delete '" + title + "'"))
		{
			window.location.href = 'users.php?deluser=' + id;
		}
	}
	</script>
</head>
<body>
	<br>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="../index.php" target="_blank">Blog</a>

		    </div>
		    <ul class="nav navbar-nav">
			    <li class="nav-item"><a href="index.php">Home</a></li>
				<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 1) { ?>
				<li><a class="nav-item" href='users.php'>Users</a></li>
				<?php } ?>
				<li><a class="nav-item" href="../" target="_blank">Posts</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a class="nav-tem text-right" href='logout.php'>Logout</a></li>
		    </ul>
		  </div>
	</nav>
	<br>
	<br>