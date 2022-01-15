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
            '100' => '4.00',
        );

        foreach ($grades as $x => $val) {
            if ($mark < $x)
                return $val;
        }
        return -1;
    }

