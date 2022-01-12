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

        header("Location:" . PAGES['login']);
        die;
    }

    function find_domain($email)
    {
        $start = strripos($email, "@") + 1;
        $length = strlen($email);
        return substr($email, $start, $length);
    }