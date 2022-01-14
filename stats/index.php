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
$select_all_trimester_query = "SELECT * FROM trimesters WHERE u_id = " . $user_data['u_id'] . " ORDER BY YEAR(start_date) DESC";
$select_all_trimester_query_result = $conn->query($select_all_trimester_query);
$select_all_trimester_query_result_copy = $conn->query($select_all_trimester_query);
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


<!-- Chart Start -->


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script>


        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Trimester');
            data.addColumn('number', 'Expectation');
            data.addColumn('number', 'Reality');

            // X exis
            // v: vertics, f: name, expected, reality
            data.addRows([
                <?php
                if ($total_trimester){

                function getYear($dateTime) {
                    $datetime = new DateTime($dateTime);
                    return $datetime->format('y');
                }
                $start_y = 0;
                $x = 0;
                $count = 0;
                $prev_year = 0;
                while($trimester_graph=mysqli_fetch_assoc($select_all_trimester_query_result_copy))
                {

                if ($trimester_graph['cgpa'] == null || $trimester_graph['expected_cgpa'] == null) continue;

                $_year = (int)getYear($trimester_graph['start_date']);


                if ($prev_year > $_year && $prev_year != 0)
                    $count = 0;
                else
                    $count++;
                $prev_year = $_year;
                $_year = ($_year * 10) + $count;

                if ($start_y == 0) {
                    $start_y = $_year - 1;
                }
                $_name = $trimester_graph['t_name'];
                $_expectation = $trimester_graph['expected_cgpa'];
                $_reality = $trimester_graph['cgpa'];
                echo "[{v: ".$_year.", f: '".$_name."'}, ".$_expectation.", ".$_reality."],";
                $x++; }} ?>
            ]);

            // Y exis
            var options = {
                title: 'Result History',
                trendlines: {
                    0: {type: 'linear', lineWidth: 5, opacity: .3},
                    1: {type: 'exponential', lineWidth: 10, opacity: .3}
                },
                hAxis: {
                    title: 'Year',
                    viewWindow: {
                        min: [<?php echo $start_y; ?>],
                        max: [<?php echo ($start_y + 11); ?>]
                    }
                },
                vAxis: {
                    viewWindow: {
                        min: [0.00],
                        max: [4.00]
                    },
                    title: 'Results (0 - 4.00)'
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('trimester_chart'));

            chart.draw(data, options);
        }

    </script>

<?php
echo $start_y." ".($start_y  + 11);
?>

    <!--     Actual Chart       -->
    <div id="trimester_chart"></div>
</div>


<!-- Chart End -->

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
                <b> <a href="trimester.php?trimester_id=<?php echo $select_all_trimester['t_id']; ?>">
                        <?php echo $select_all_trimester['t_name']; ?>
                    </a>
                </b>
                <br />
            </center>
        <?php }

    } else {?>

        <center><b>No data found...</b></center>

    <?php } ?>
</div>

</body>


</html>