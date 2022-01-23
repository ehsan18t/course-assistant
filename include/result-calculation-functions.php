<?php

function get_grade_by_mark($mark) {
    $grades = array(
        '55' => '0.00',
        '58' => '1.00',
        '62' => '1.33',
        '66' => '1.67',
        '70' => '2.00',
        '74' => '2.33',
        '78' => '2.67',
        '82' => '3.00',
        '86' => '3.33',
        '90' => '3.67',
        '101' => '4.00',
    );

    foreach ($grades as $x => $val) {
        if ($mark < $x)
            return $val;
    }
    return -1;
}

function update_trimester($trimester_id, $conn) {
    $credit = 0.0;
    $total_gpa = 0.0;
    $ex_gpa = 0.0;
    $all_course = $conn->query("SELECT *
                                 FROM courses
                                 WHERE t_id=$trimester_id");
    while ($current=mysqli_fetch_assoc($all_course)) {
        $credit += $current['credit'];

        // calculating percentage
        $total_marks = ($current['obtained_marks']/$current['total_marks']) * 100;
        $ex_marks = ($current['expected_marks']/$current['total_marks']) * 100;

        // gpa of co-responding percentage
        $total_gpa += ($current['credit'] * get_grade_by_mark($total_marks));
        $ex_gpa += ($current['credit'] * get_grade_by_mark($ex_marks));
        echo get_grade_by_mark($total_marks)." ".get_grade_by_mark($ex_marks);
    }
    $gpa = $total_gpa/$credit;
    $ex_gpa = $ex_gpa/$credit;

    // updating results of trimester
    $conn->query("UPDATE trimesters 
                    SET cgpa=$gpa, expected_cgpa=$ex_gpa
                    WHERE t_id=$trimester_id");
}


function update_course($course_id, $conn) {
    // Find all assessment type
    $assess_types = $conn->query("SELECT *
                                    FROM assessments
                                    WHERE course_id=$course_id
                                    GROUP BY type");
    $total_marks = 0;
    $expected_marks = 0;
    $obtained_marks = 0;

    // count total marks from each type of assessment
    while ($current=mysqli_fetch_assoc($assess_types)) {
        $count = $current['count'];
        $type = $current['type'];

        $marks = mysqli_fetch_assoc($conn->query("SELECT (SUM(total_marks)/$count) AS t_marks  FROM assessments WHERE course_id=$course_id AND type = '$type' ORDER BY obtained_marks DESC LIMIT $count"));
        $total_marks += $marks['t_marks'];

        $marks = mysqli_fetch_assoc($conn->query("SELECT (SUM(expected_marks)/$count) AS e_marks FROM assessments WHERE course_id=$course_id AND type = '$type' ORDER BY obtained_marks DESC LIMIT $count"));
        $expected_marks += $marks['e_marks'];

        $marks = mysqli_fetch_assoc($conn->query("SELECT (SUM(obtained_marks)/$count) AS o_marks FROM assessments WHERE course_id=$course_id AND type = '$type' ORDER BY obtained_marks DESC LIMIT $count"));
        $obtained_marks += $marks['o_marks'];
    }

    // Update course data
    $conn->query("UPDATE courses 
                      SET total_marks=$total_marks,
                          expected_marks=$expected_marks,
                          obtained_marks=$obtained_marks
                      WHERE c_id=$course_id");
}


function update_trimester_by_course($course_id, $conn) {
    $course = mysqli_fetch_assoc($conn->query("SELECT * FROM courses WHERE c_id = $course_id"));
    $trimester_id = $course['t_id'];
    update_trimester($trimester_id, $conn);
}

function update_all_by_assess($assess_id, $conn) {
    $assess = mysqli_fetch_assoc($conn->query("SELECT * FROM assessments WHERE assess_id=$assess_id"));
    $course_id = $assess['course_id'];
    // Update course
    update_course($course_id, $conn);
    // Update Trimester data
    update_trimester_by_course($course_id, $conn);
}


function delete_course($course_id, $conn) {
    // removing all co-responding assessments
    $conn->query("DELETE FROM assessments WHERE course_id=$course_id");
    $conn->query("DELETE FROM courses WHERE c_id=$course_id");
}

function delete_trimester($trimester_id, $conn) {
    $t_list = $conn->query("SELECT * FROM courses WHERE t_id = $trimester_id");

    // removing all assessments from each course
    while ($c=mysqli_fetch_assoc($t_list)) {
        // removing course along with assessments
        delete_course($c['c_id'], $conn);
    }

    // removing trimester
    $conn->query("DELETE FROM trimesters WHERE t_id=$trimester_id");
}