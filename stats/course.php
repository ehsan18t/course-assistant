<!DOCTYPE html>

<html lang="en">
<?php
require_once '../header.php';
$user_data = check_login($conn);
require_once INCLUDES['result-calculation-function'];
if(!isset($_GET['course_id']))
    header('location:'.PAGES['trimester']);
?>
<title>Course Details</title>

<link rel="stylesheet" href="<?php echo CSS['modal.css']."?".time(); ?>">
<link rel="stylesheet" href="<?php echo CSS['stats.css']."?".time(); ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php
    $user_id = $user_data['u_id'];
    $course_id=$_GET['course_id'];
    $select_asses_query="SELECT * FROM assessments WHERE course_id = $course_id ORDER BY type, assess_id";
    $select_asses_query_result = $conn->query($select_asses_query);
    $select_asses_query_result_copy = $conn->query($select_asses_query);
    $total_asses = mysqli_num_rows($select_asses_query_result);
?>

<div class="course-container">
    <!--  Edit course / Add Courses -->
    <div class="course-control">
        <center>
            <button onclick="toggleVisibility('add-asses-popup')" class="new-post-btn"> Add Assessments </button>
        </center>
    </div>

    <!--  Add Course  -->
    <?php
    if(isset($_POST['add_asses'])){
        $asses_name = $_POST['asses_name'];
        $asses_type = $_POST['asses_type'];
        $asses_total_mark = $_POST['asses_total_mark'];
        $asses_expected_mark = $_POST['asses_expected_mark'];
        $asses_obtained_mark = $_POST['asses_obtained_mark'];
        $asses_count = $_POST['asses_count'];

        $insert_sql="INSERT INTO assessments (course_id, asses_name, type, total_marks, expected_marks, obtained_marks, count)
                    VALUES($course_id, '$asses_name', '$asses_type', $asses_total_mark, $asses_expected_mark, $asses_obtained_mark, $asses_count)";
        if ($conn->query($insert_sql)) {
            update_all_by_assess($conn->insert_id, $conn);
            echo "<script>alert('New Assessment Added Successfully.');</script>";
        }
        else
            echo "<script>alert('FAILED!');</script>";
    header("Refresh:0");
    }
    ?>

    <div id="add-asses-popup" class="hide">
        <div class="modal-content">
            <button onclick="toggleVisibility('add-asses-popup')" class="close"> Close </button>
            <form action="course.php?course_id=<?php echo $course_id?>" method="POST">
                <input type="text" name="asses_name" placeholder="Assessment Name" />
                <input type="text" name="asses_type" placeholder="Assessment Type" />
                <input type="text" name="asses_total_mark" placeholder="Total Mark" />
                <input type="text" name="asses_expected_mark" placeholder="Expected Mark" />
                <input type="text" name="asses_obtained_mark" placeholder="Obtained Mark" />
                <input type="text" name="asses_count" placeholder="Best Count" />
                <input type="submit" name="add_asses" value="Add" />
            </form>
        </div>
    </div>
</div>

<!--PIE CHART START-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Course Code', 'GPA'],
            <?php
            $arr = array();
            while($course_cg=mysqli_fetch_assoc($select_asses_query_result_copy)) {
//            if ($course_cg['obtained_marks'] == null) continue;
                $cg = get_grade_by_mark($course_cg['obtained_marks']);
                $arr[$course_cg['c_code']] = $cg;
            }
            foreach ($arr as $key => $val) {
                echo "['".$key."', ".$val."],";
            }
            ?>
        ]);

        var options = {
            title: 'Courses'
        };

        var chart = new google.visualization.PieChart(document.getElementById('course_piechart'));

        chart.draw(data, options);
    }
</script>
<!--     Actual Chart       -->
<div id="course_piechart"></div>

<!--PIE CHART END-->


<!-- Show Assessments -->
<div class="post-container">
    <br>
    <?php
    if ($total_asses){
        while($select_all_asses=mysqli_fetch_assoc($select_asses_query_result)){ ?>
<!--            <a href="course.php?course_id=--><?php //echo $select_all_asses['assess_id']; ?><!--">-->
                <div class="post-card">
                    <div class="post-text-container">
                        <div class="post-title-style">
                            <?php echo $select_all_asses['asses_name']; ?>
                        </div>
                        <span class="post-tag"><?php echo $select_all_asses['type']; ?></span>
                        <div class="post-author">
                            <?php echo "Expected: ".$select_all_asses['expected_marks']."/".$select_all_asses['total_marks']; ?>
                        </div>
                        <div>
                            <p class="post-text-style">
                                <?php echo "Obtained: ".$select_all_asses['obtained_marks']."/".$select_all_asses['total_marks']; ?>
                            </p>
                        </div>
                    </div>
                </div>
<!--            </a>-->
        <?php }

    } else {?>

        <center><b>No data found...</b></center>

    <?php } ?>
</div>




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