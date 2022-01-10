<?php
    function check_login($conn)
    {
        if (isset($_SESSION['email'])) {
            $id = $_SESSION['email'];
            $query = "SELECT * FROM users WHERE email = '$id'";

            $result = $conn -> query($query);
            if ($result && mysqli_num_rows($result) > 0)
                return mysqli_fetch_assoc($result);
        }

        header("Location: login.php");
        die;
    }

    function random_num($length): string
    {
        //this is for user_id
        $text = "";
        if ($length < 5) {
            $length = 5;
        }

        $len = rand(4, $length);

        for ($i = 0; $i < $len; $i++) {
            $text .= rand(0, 9);
        }

        return $text;
    }

    function find_domain($user_name)
    {
        $start = strripos($user_name, "@");
        $length = strlen($user_name);
        $domain = substr($user_name, $start + 1, $length);
        return $domain;
    }