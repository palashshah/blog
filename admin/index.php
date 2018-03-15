<?php
//include config
include('admin_header.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
} 

?>
	<div id="wrapper">
	<hr>
	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Post '.$_GET['action'].'.</h3>'; 
	} 
	?>


	<table class="table table-hover table-bordered text-center table-responsive">
	<tr>
		<th>Title</th>
		<th>Author</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			if($_SESSION['role'] != 1)
				$stmt = $db->query('SELECT * FROM blog_posts bp, blog_members bm WHERE bp.memberID = bm.memberID and bm.memberID = '.$_SESSION['memberID'].' ORDER BY postID DESC');
			else
				$stmt = $db->query('SELECT * FROM blog_posts bp, blog_members bm WHERE bp.memberID = bm.memberID ORDER BY postID DESC');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>
	<br>

	<p align="center"><a href='add-post.php' class='btn btn-primary'>Add Post</a></p>

</div>

<?php include('admin_footer.php') ?>
