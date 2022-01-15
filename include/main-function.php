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

    function view_post_search($conn , $user_data, $key){
        $post_domain = $user_data['domain'];
        $query = "SELECT * FROM posts WHERE domain='$post_domain' AND (course_name LIKE '%$key%' OR course_code LIKE '%$key%' OR course_des LIKE '%$key%')";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }
    }

    function get_user($conn, $u_id)
    {
        $query = "SELECT * FROM users WHERE u_id = '$u_id'";

        $result = $conn -> query($query);
        if ($result && mysqli_num_rows($result) > 0)
            return mysqli_fetch_assoc($result);

        header("Location:" . PAGES['login']);
        die;
    }