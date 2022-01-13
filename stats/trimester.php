<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
?>

<title>Home Page</title>

<style type="text/css">
#delete_popup{
	height: 0px;
	width: 300px;
	background: #ffffff;
	border: 2px solid #000000;
	margin: 0px auto;
	visibility: hidden;
}

#delete_popup:target{
	visibility: visible;
	height: 200px;
}

#edit_popup{
	height: 0px;
	width: 300px;
	background: #ffffff;
	border: 2px solid #000000;
	margin: 0px auto;
	visibility: hidden;
}

#edit_popup:target{
	visibility: visible;
	height: 200px;
}
</style>

</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php 
	$post_id=$_GET['post_id'];
	$select_post_query="SELECT * FROM all_post WHERE post_id=".$post_id;
	$select_post_query_result = $conn->query($select_post_query);
	
	while($select_post=mysqli_fetch_assoc($select_post_query_result)){
		$post_author_uid = $select_post['post_author_uid'];
		$post_title = $select_post['post_title'];
		$post_details = $select_post['post_details'];
	}
?>

<br />

<?php
	if($post_author_uid == $user_data['u_id']){
		?>
		<center>
			<a href="#edit_popup">Edit Post</a>
			<a href="#delete_popup">Delete Post</a>
		</center>
<?php
	}
 ?>
 
 
 <div id="edit_popup">
	<a href="">Close</a>
	<br />
	<br />
	<form action="full_post.php?post_id=<?php echo $post_id?>" method="POST">
		<input type="text" name="post_title_box" placeholder="Enter post title" value="<?php echo $post_title?>" />
		<br />
		<input type="text" name="post_details_box" placeholder="Enter post details" value="<?php echo $post_details?>"/>
		<br />
		<input type="submit" name="update_post" value="Update" />
	</form>
 </div>
 
 
 <?php 
 if(isset($_POST['update_post'])){
	 $update_id=$post_id;
	 $new_title = $_POST['post_title_box'];
	 $new_details = $_POST['post_details_box'];
	 $update_post_query="UPDATE all_post SET post_title='$new_title',post_details='$new_details' WHERE post_id=".$update_id;
	 $update_post_sql=$conn->query($update_post_query);
	 
	echo "<script>alert('Post Updated Successfully.');</script>";
	header("Refresh:0");
 }
 ?>
 
 
 <div id="delete_popup">
	<a href="?post_id=<?php echo $post_id?>&delete_id=<?php echo $post_id?>">Yes</a>
	<a href="">No</a>
 </div>
 
 <?php 
 if(isset($_GET['delete_id'])){
	 $delete_id=(int)$_GET['delete_id'];
	 $delete_post_query="DELETE FROM all_post WHERE post_id=".$delete_id;
	 $delete_post_sql=$conn->query($delete_post_query);
	 header('location:index.php');
 }
 ?>


<br />
<br />
<center>
	<b><?php echo $post_title ?></b>
	<br />
	<br />
	<b><?php echo $post_details ?></b>
</center>

</body>

</html>