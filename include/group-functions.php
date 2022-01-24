<?php

// With current table structure it's impossible to check.
// Even if it's possible it will be a terrible code.
function is_group_exist($course_id, $uid, $conn) {
    $course = mysqli_fetch_assoc($conn->query("SELECT * FROM courses WHERE c_id=$course_id"));
    $trimester = mysqli_fetch_assoc($conn->query("SELECT * FROM trimesters WHERE t_id=".$course['t_id']));
    $date = date_parse($trimester['start_date']);
    $start_year = $date['year'];
    $start_month = $date['month'];
    $c_code = $course['c_code'];
    $c_sec = $course['section'];
    $sql = "";
}

// This function is correct and works 100% time. Don't think about it so much... :/
function is_user_in_group($course_id, $uid, $conn) {
    return mysqli_num_rows($conn->query("SELECT *
                                            FROM participants
                                            WHERE course_id = $course_id
                                            AND user_id = $uid"));
}

function create_group($course_id, $conn) {
//    if (is_group_exist($course_id))
    // Getting info
    $course = mysqli_fetch_assoc($conn->query("SELECT * FROM courses WHERE c_id=$course_id"));
    $section = $course['section'];
    $course_code = $course['c_code'];
    $g_name = $course_code.' ['. $section .'] '.' Study Group ';

    // Creating group
    $date = new DateTime('now');
    $date->modify('+5 month');
    $date = $date->format('Y-m-d h:i:s');
    $conn->query("INSERT INTO study_group(group_name, close_date) VALUES ('$g_name', '$date')");

    // last inserted id in group table
    $g_id = $conn->insert_id;

    // Finding Users
    $user_arr = array();
    $selected_course = $conn->query("SELECT * FROM courses WHERE c_code LIKE '$course_code' AND section LIKE '$section'");
    while ($c=mysqli_fetch_assoc($selected_course)) {
        $t_id = $c['t_id'];
        $selected_trimesters = $conn->query("SELECT * FROM trimesters WHERE is_running = 1 AND t_id = $t_id");
        while ($t=mysqli_fetch_assoc($selected_trimesters)) {
            $u_id = $t['u_id'];
            $user_arr[$u_id] = $c['c_id'];
        }
    }

    foreach($user_arr as $x => $y){
        $conn->query("INSERT INTO participants(user_id, course_id, group_id) VALUES($x, $y, $g_id)");
    }
}


