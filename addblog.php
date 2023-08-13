<?php 
include_once "include/header.php";

if(isset($_SESSION['userId'])){
	$author = $_SESSION['userId']['0'];
}

$sql = "SELECT * FROM keywords";
$res1 = mysqli_query($conn, $sql); 

?>

<div class="container-fluid">
    <h5 class="mb- text-grey-800">Blogs</h5>
    <div class="row">
    	<div class="col-xl-7 col-lg-5">
    		<div class="card">
    <div class="card-header">
    	<h6 class="font-weight-bold text-primry mt-2">Publish blog/article</h6>
    </div>
    <div class="card-body">
        <form class="navbar-search" method="post" enctype="multipart/form-data">
        	<div class="mb-3">
        		<input type="text" class="form-control bg-white border-0 small"  name="title" placeholder="Title">
        	</div>
        	<div class="mb-3">
        		<label>Body/Description</label>
                <textarea class="form-control" name="body" rows="2" id="blog"></textarea>
        	</div>
              <div class="mb-3">
        	    <input type="file" name="image" class="form-control">
        	</div>
        	<div class="mb-3">
        		<select class="form-control" name="keyword" reuired>
        			<option>Select Keyword</option>
                    <?php while ($keys=mysqli_fetch_assoc($res1)) { ?>
        			<option value="<?= $keys['keyid']?>"><?= $keys['keyname']?></option>
        		<?php } ?>
        		</select>
        	</div>
        		<div class="input-group-append">
        		<button class="btn btn-primary" name="addblog" type="button">Add</button> 
        		<a href="blog.php" class="btn btn-primary">Back</a>
        	</div>
        </div>
        </form>
    </div>
</div>
<?php 

if(isset($_POST['addblog'])){
	$title = mysqli_real_escape_string($conn,$_POST['title']);
	$body = mysqli_real_escape_string($conn,$_POST['body']);
	$filename = $_FILES['image']['name'];
	$tempname = $_FILES['image']['tempname'];
	$size = $_FILES['image']['size'];
	$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	$allow = ['jpg','png','jpeg'];
	$dest = "upload/".$filename;
    $body = mysqli_real_escape_string($conn,$_POST['keyword']);


if(in_array($ext, $allow)){
  if ($size <= 2000000) {
  	move_uploaded_file($tempname, $dest);
  	$sql2="INSERT INTO blog(title, body, image, keyword, author)
   values('$title','$body','$image', 'keyword', 'author')";
   $res2 = mysqli_query($conn,$sql2);
   if($res2){
   	$msg= ['Post published successfully', 'alert-success'];
   	$_SESSION['msg'] = $msg;
   }
   else{
   	 echo "";
   	 $msg= ['Failed,please try again', 'alert-danger'];
   	 header("Location:". base_url('addblog.php'));
   }
  }
  else {
  	echo "";
   $msg= ['file size should not be greater than 2mb', 'alert-danger'];
  }
}
else {
	echo "File type is not allowed (only jpg, png and jpeg)";
}


}

?>
