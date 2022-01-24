<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
    require_once INCLUDES['result-calculation-function'];

    // Delete trimester
    if(isset($_POST['delete'])){
        delete_trimester($_POST['t_id'], $conn);
        header("Location: " . PAGES['stats']);
    }


    if (isset($_POST['submit_trimester'])) {
        $trimester_title = $_POST['trimester_name'];
        $trimester_start_date = $_POST['trimester_start_date'];
        $trimester_end_date = $_POST['trimester_end_date'];
        if (isset($_POST['is_trimester_running']))
            $is_trimester_running = 1;
        else
            $is_trimester_running = 0;
        $current_user_uid = $user_data['u_id'];

        $insert_sql = "INSERT INTO trimesters (u_id, t_name, is_running, start_date, end_date)
                        VALUES($current_user_uid, '$trimester_title', $is_trimester_running, '$trimester_start_date', '$trimester_end_date')";
        if ($conn->query($insert_sql)) {
            echo "<script>alert('New Trimester Added Successfully.');</script>";
            header("Refresh:0");
        } else {
            echo "<script>alert('Operation Failed!');</script>";
        }
    }


?>

<title>Trimester List</title>
<link rel="stylesheet" href="<?php echo CSS['modal.css']."?".time(); ?>">
<link rel="stylesheet" href="<?php echo CSS['stats.css']."?".time(); ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php
$select_all_trimester_query = "SELECT * FROM trimesters WHERE u_id = " . $user_data['u_id'] . " ORDER BY YEAR(start_date) DESC";
$select_all_trimester_query_copy = "SELECT * FROM trimesters WHERE u_id = " . $user_data['u_id'] . " ORDER BY YEAR(start_date) ASC";
$select_all_trimester_query_result = $conn->query($select_all_trimester_query);
$select_all_trimester_query_result_copy = $conn->query($select_all_trimester_query_copy);
$total_trimester = mysqli_num_rows($select_all_trimester_query_result);
?>

<!-- Modal for New Trimester -->
<center><button type="submit" onclick="toggleVisibility('open_trimester_creator_window')" class="new-post-btn"><b>Create New Trimester</b></button></center>

<div id="open_trimester_creator_window" class="hide">
    <div class="modal-content">
    <a href="#" class="close" onclick="toggleVisibility('open_trimester_creator_window')">Close</a>
    <form action="index.php" method="POST">
        <label for="is_trimester_running"> Name </label>
        <input type="text" name="trimester_name" placeholder="Enter Trimester Title" />

        <label class="checkbox-label" for="is_trimester_running">
            <input type="checkbox" value="0" name="is_trimester_running" /> Currently Running
        </label>

        <label for="trimester_start_date">Start Date </label>
        <input type="date" name="trimester_start_date" />

        <label for="trimester_end_date">End Date </label>
        <input  type="date" name="trimester_end_date" />

        <input type="submit" name="submit_trimester" value="Add" />
    </form>
    </div>
</div>


<!-- Chart Start -->


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script>


        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Trimester');
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


                if ($_year > $prev_year && $prev_year != 0)
                    $count = 1;
                else
                    $count++;
                $prev_year = $_year;
                $_year = ($_year * 10) + $count;

//                if ($start_y == 0) {
                    $start_y = $_year;
//                }
                $_name = $trimester_graph['t_name'];
                $_expectation = $trimester_graph['expected_cgpa'];
                $_reality = $trimester_graph['cgpa'];
//                echo "[{v: ".$_year.", f: '".$_name."'}, ".$_expectation.", ".$_reality."],";
                echo "['".$_year."', ".$_expectation.", ".$_reality."],";
                $x++; }} ?>
            ]);

            // Y exis
            var options = {
                title: 'Result History',
                hAxis: {
                    title: 'Trimester'
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


    <!--     Actual Chart       -->
    <div id="trimester_chart"></div>
</div>


<!-- Chart End -->

<div class="post-container">
    <br />
    <?php
    if ($total_trimester){
        ?>

        <?php
        while($select_all_trimester=mysqli_fetch_assoc($select_all_trimester_query_result))
        {
            $s_date = date_create($select_all_trimester['start_date']);
            $e_date = date_create($select_all_trimester['end_date']);
            ?>
                <a href="<?php echo PAGES['courses']; ?>?trimester_id=<?php echo $select_all_trimester['t_id']; ?>">
                    <div class="post-card">
                        <div class="post-text-container">
                            <div class="post-title-style">
                                <?php echo $select_all_trimester['t_name']; ?>
                            </div>
                            <span class="post-tag"><?php echo date_format($s_date,"d-M-Y")." - ".date_format($e_date,"d-M-Y"); ?></span>
                            <div class="post-author">
                                <?php echo "Expected: ".$select_all_trimester['expected_cgpa']?>
                            </div>
                            <div>
                                <p class="post-text-style">
                                    <?php echo "Obtained: ".$select_all_trimester['cgpa']; ?>
                                </p>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="t_id" value="<?php echo $select_all_trimester['t_id']; ?>">
                                <?php
                                //                                echo "<input class='post-cm-btn' onclick='toggleVisibility(\"edit-post-popup\")' type='submit' value='Edit'>";
                                echo "<input class='post-cm-btn' style='margin-left: 0.25rem' onclick='return confirm(\"Are you sure you want to delete this item?\")' type='submit' name='delete' value='Delete'>";
                                ?>
                            </form>
                        </div>
                    </div>
                </a>
        <?php }

    } else {?>

        <center><b>No data found...</b></center>

    <?php } ?>
    <br>
</div>
</body>


</html>