<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
?>

<title>Trimester List</title>
<link rel="stylesheet" href="<?php echo CSS['modal.css'] ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php
$select_all_trimester_query = "SELECT * FROM trimesters WHERE u_id = " . $user_data['u_id'];
$select_all_trimester_query_result = $conn->query($select_all_trimester_query);
$total_trimester = mysqli_num_rows($select_all_trimester_query_result);
?>



<br />

<!-- <form method="GET" action="">
	<input name="post_search_keyword" type="text" placeholder="Search post" />
	<input name="search_submit" type="submit" value="Search" />
</form>
<br /> -->


<!-- Modal for New Trimester -->
<center><a href="#" onclick="toggleVisibility('open_trimester_creator_window')"><b>Create New Trimester</b></a></center>

<div id="open_trimester_creator_window" class="hide">
    <div class="modal-content">
    <a href="#" class="close" onclick="toggleVisibility('open_trimester_creator_window')">Close</a>

    <br />
    <br />
    <form action="index.php" method="POST">
        <input type="text" name="trimester_name" placeholder="Enter Trimester Title" />
        <br />
        <label for="is_trimester_running"> Running:
            <input type="checkbox" value="0" name="is_trimester_running" />
        </label>
        <br />

        <label for="trimester_start_date">Start Date: </label>
        <input type="date" name="trimester_start_date" />
        <br />

        <label for="trimester_end_date">End Date: </label>
        <input type="date" name="trimester_end_date" />
        <br />

        <input type="submit" name="submit_trimester" value="Add" />
    </form>
    </div>
</div>

<?php
if(isset($_POST['submit_trimester'])){
    $trimester_title = $_POST['trimester_name'];
    $trimester_start_date = $_POST['trimester_start_date'];
    $trimester_end_date = $_POST['trimester_end_date'];
    if (isset($_POST['is_trimester_running']))
        $is_trimester_running = 1;
    else
        $is_trimester_running = 0;
    $current_user_uid = $user_data['u_id'];

    $insert_sql="INSERT INTO trimesters (u_id, t_name, is_running, start_date, end_date)
                    VALUES($current_user_uid, '$trimester_title', $is_trimester_running, '$trimester_start_date', '$trimester_end_date')";
    $insert_query = $conn->query($insert_sql);
    echo "<script>alert('New Trimester Added Successfully.');</script>";
//    header("Refresh:0");
}
?>


<br />
<br />
<div class="all_post">
    <?php
    if ($total_trimester){
        ?>

        <?php
        while($select_all_trimester=mysqli_fetch_assoc($select_all_trimester_query_result))
        {
            ?>
            <center>
                <b> <a href="trimester.php?trimester_id=<?php echo $select_all_trimester['t_id']; ?>"><?php echo $select_all_trimester['t_name']; ?></a></b>
                <br />
            </center>
        <?php }

    } else {?>

        <center><b>No data found...</b></center>

    <?php } ?>
</div>

</body>

</html>