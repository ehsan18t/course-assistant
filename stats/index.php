<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
?>


<style type="text/css">
    #open_trimester_creator_window{
        height: 0px;
        width: 900px;
        background: #ffffff;
        border: 2px solid #000000;
        margin: 0px auto;
        visibility: hidden;
    }

    #open_trimester_creator_window:target{
        visibility: visible;
        height: 400px;
    }


    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
</style>

<title>Trimster List</title>
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
<center><a href="#open_trimester_creator_window"><b>Create New Trimester</b></a></center>

<div id="open_trimester_creator_window">
    <a href="">Close</a>

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