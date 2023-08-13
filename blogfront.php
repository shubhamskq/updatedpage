<?php include_once "include/header.php";
$sql = "SELECT * FROM blog LEFT JOIN keywords ON blog.keyword = keywords.key_id LEFT JOIN user ON blog.author_id=user.user_id";
$run = mysqli_query($conn,$sql);
$row = mysqli_num_rows($run); 
?>
<div class="container mt-2">
	<div class="row">
		<div class="col-lg-8">
			<?php 
               if ($row) {
               	 while ($res=mysqli_fetch_assoc($run)) {
               	 	?>
               	 
			<div class="card shadow">
				<div class="card-body d-flex blog_flex">
					<div class="flex-part1">
						<a href=""> <img src="assets/images/test.jpg"> </a>
					</div>
					<div class="flex-grow-1 flex-part2">
						  <a href="" id="title"><?= $res['title']?></a>
						<p>
						  <a href="" id="body">
						  	Body
						  </a> <span><br>
                          <a href="" class="btn btn-sm btn-outline-primary">Continue Reading
                          </a></span>
                        </p>
						<ul>
							<li class="me-2"><a href=""> <span>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Author</a>
							</li>
							<li class="me-2">
								<a href=""> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span> Date </a>
							</li>
							<li>
								<a href=""> <span><i class="fa fa-tag" aria-hidden="true"></i></span> Category </a>
						    </li>
						</ul>
					</div>
				</div>
			</div>
		<?php } 
	} ?>
		</div>
		<div class="col-lg-4">
			<div class="card">
				<div class="card-body d-flex right-section">
					<div id="categories">
						<h6>Categories</h6>
						<ul>
							<li>Category Name</li>
						</ul>
					</div>
				    <div id="posts">
						<h6>Recent Posts</h6>
						<ul>
							<li>Blog Title</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
