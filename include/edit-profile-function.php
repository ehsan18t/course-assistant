<?php
function edit_profile($conn, $POST, $email)
{
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $f_name = $POST['firstName'];
        $l_name = $POST['lastName'];

        if(!empty($f_name) && !empty($l_name)) {
            $query = "UPDATE users SET f_name='$f_name', l_name='$l_name' WHERE email='$email'";
            $conn->query($query);
            header("Location: " . PAGES['profile']);
        } else {
            echo "Edit Profile Failed!";
        }
    }
}
