<?php

function view_post_by_id($conn , $user_data, $user_id){
    $post_domain = $user_data['domain'];
    $requested_query = $conn->query("SELECT * FROM users WHERE u_id=$user_id");
    $requested_user = mysqli_fetch_assoc($requested_query);
    $user_email = $requested_user['email'];
    $query = "SELECT * FROM posts WHERE (domain='$post_domain' AND post_admin = '$user_email') ORDER BY date DESC";
    if(mysqli_query($conn, $query)){
        return mysqli_query($conn, $query);
    }
}