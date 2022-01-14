<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
    if(!isset($_GET['trimester_id']))
        header('location:'.PAGES['stats']);
?>
<title>Course Page</title>

<link rel="stylesheet" href="<?php echo CSS['modal.css'] ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php
    $user_id = $user_data['u_id'];
	$trimester_id=$_GET['trimester_id'];
	$select_course_query="SELECT * FROM courses WHERE t_id = $trimester_id";
	$select_course_query_result = $conn->query($select_course_query);
    $total_course = mysqli_num_rows($select_course_query_result);
	
//	while($select_course=mysqli_fetch_assoc($select_course_query_result)){
//		$course_id = $select_course['c_id'];
//		$course_name = $select_course['c_name'];
//        $course_credit = $select_course['credit'];
//        $course_section = $select_course['section'];
//	}
?>

<div class="trimester-container">
    <!--  Edit Trimester / Add Courses -->
    <div class="trimester-control">
        <button onclick="toggleVisibility('add-course-popup')"> Add Course </button>
    </div>

    <!--  View Course  -->
    <div id="add-course-popup" class="hide">
        <div class="modal-content">
        <button onclick="toggleVisibility('add-course-popup')" class="close"> x </button>
        <br />
        <br />
        <form action="trimester.php?trimester_id=<?php echo $trimester_id?>" method="POST">
            <input type="text" name="course_name" placeholder="Course Name" />
            <br>
            <input type="text" name="course_credit" placeholder="Credit" />
            <br>
            <input type="text" name="course_section" placeholder="Section (Optional)" />
            <br>
            <input type="text" name="course_total_mark" placeholder="Total Mark" />
            <br>
            <input type="text" name="course_expected_mark" placeholder="Expected Mark (optional)" />
            <br>
            <input type="submit" name="add_course" value="Add" />
        </form>
    </div>
    </div>
</div>

<div class="all_post">
    <?php
    if ($total_course){
        ?>

        <?php
        while($select_all_course=mysqli_fetch_assoc($select_course_query_result))
        {
            ?>
            <center>
                <b> <a href="course.php?course_id=<?php echo $select_all_course['c_id']; ?>"><?php echo $select_all_course['c_name']; ?></a></b>
                <br />
            </center>
        <?php }

    } else {?>

        <center><b>No data found...</b></center>

    <?php } ?>
</div>



<?php
if(isset($_POST['add_course'])){
    $course_name = $_POST['course_name'];
    $course_credit = $_POST['course_credit'];
    $course_section = $_POST['course_section'];
    $course_total_mark = $_POST['course_total_mark'];
    $course_expected_mark = $_POST['course_expected_mark'];

    $insert_sql="INSERT INTO courses (t_id, c_name, credit, section, total_marks, expected_marks)
                    VALUES($trimester_id, '$course_name', $course_credit, '$course_section', $course_total_mark, $course_expected_mark)";
    $insert_query = $conn->query($insert_sql);
    echo "<script>alert('New Course Added Successfully.');</script>";
//    header("Refresh:0");
}
?>


<br />
<!-- Edit Option -->
<?php
//	if($post_author_uid == $user_data['u_id']){
//		?>
<!--		<center>-->
<!--			<a href="#edit_popup">Edit Post</a>-->
<!--			<a href="#delete_popup">Delete Post</a>-->
<!--		</center>-->
<?php
//	}
// ?>


<!-- Update -->
<!-- <div id="edit_popup">-->
<!--	<a href="">Close</a>-->
<!--	<br />-->
<!--	<br />-->
<!--	<form action="full_post.php?post_id=--><?php //echo $post_id?><!--" method="POST">-->
<!--		<input type="text" name="post_title_box" placeholder="Enter post title" value="--><?php //echo $post_title?><!--" />-->
<!--		<br />-->
<!--		<input type="text" name="post_details_box" placeholder="Enter post details" value="--><?php //echo $post_details?><!--"/>-->
<!--		<br />-->
<!--		<input type="submit" name="update_post" value="Update" />-->
<!--	</form>-->
<!-- </div>-->
 

<!-- --><?php //
// if(isset($_POST['update_post'])){
//	 $update_id=$post_id;
//	 $new_title = $_POST['post_title_box'];
//	 $new_details = $_POST['post_details_box'];
//	 $update_post_query="UPDATE all_post SET post_title='$new_title',post_details='$new_details' WHERE post_id=".$update_id;
//	 $update_post_sql=$conn->query($update_post_query);
//
//	echo "<script>alert('Post Updated Successfully.');</script>";
//	header("Refresh:0");
// }
// ?>
 
<!-- Delete -->
<!-- <div id="delete_popup">-->
<!--	<a href="?post_id=--><?php //echo $post_id?><!--&delete_id=--><?php //echo $post_id?><!--">Yes</a>-->
<!--	<a href="">No</a>-->
<!-- </div>-->
 
 <?php 
 if(isset($_GET['delete_id'])){
	 $delete_id=(int)$_GET['delete_id'];
	 $delete_post_query="DELETE FROM all_post WHERE post_id=".$delete_id;
	 $delete_post_sql=$conn->query($delete_post_query);
	 header('location:index.php');
 }
 ?>

</body>

</html>