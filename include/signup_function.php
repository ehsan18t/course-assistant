<?php
function register($conn, $POST)
{
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //Here we are inserted in the database
        //we take inputs from user and push them in the table
        $f_name = $POST['firstName'];
        $l_name = $POST['lastName'];
        $university = $POST['university'];
        $department = $POST['department'];
        $email = $POST['email'];
        $password = $POST['password'];
        $domain = find_domain($email);
        $duplicate = mysqli_num_rows($conn -> query("SELECT email FROM users WHERE email ='$email'")) > 0;

        if(!empty($f_name) && !empty($l_name) && !empty($email) && !empty($password) && !$duplicate) {
            $query = "INSERT INTO users(f_name, l_name, university, department, email, password, domain) 
                VALUES('$f_name','$l_name','$university','$department','$email','$password','$domain')";
            $conn -> query($query);
            header("Location: " . PAGES['login']);
            die();
        } else {
            echo "Signup Failed!";
        }
    }
}
