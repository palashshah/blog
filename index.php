<?php include('includes/header.php'); ?>

<div id="wrapper">
	<?php
		try {
			echo '<div class="container">
					<div class="index-content">
					<h1>Blog</h1>
					<hr>';
			$stmt = $db->query('SELECT * FROM blog_posts bp, blog_members bm WHERE bp.memberID = bm.memberID ORDER BY postID DESC');
			while($row = $stmt->fetch()){
				echo '<div class="row">

				        <!--Grid column-->
				        <div class="col-lg-5 col-xl-5 pb-3">
				            <!--Featured image-->
				            <div class="view overlay rounded z-depth-2">
				            	<a href="viewpost.php?id='.$row['postID'].'">
				                <img src="admin/'.$row['thumbnail'].'" alt="Image Not Found"
				                    class="thumbnail img-responsive img-fluid">
				                </a>
				            </div>
				        </div>
				        <!--Grid column-->

				        <!--Grid column-->
				        <div class="col-lg-7 col-xl-7">
				            <!--Excerpt-->
				            <h3 class="mb-4 font-weight-bold dark-grey-text">
				                <strong>'.$row['postTitle'].'</strong>
				            </h3>
				            <p>'.$row['postDesc'].'</p>
				            <p>by
				                <a>
				                    <strong>'.$row['username'].'</strong>
				                </a>, '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>
				            <a href="viewpost.php?id='.$row['postID'].'" class="btn btn-success btn-md mb-3">Read more</a>
				        </div>
				        <!--Grid column-->

				    </div>
				    <hr>';


				
			}
			echo '</div>
				</div>';

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>

</div>

<?php include('includes/footer.php') ?>