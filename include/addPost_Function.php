<?php
    function  add_post($conn,$POST,$user_data){
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        $course_code = $POST['course_code'];
         $course_name = $POST['course_name'];
         $course_des = $POST['course_des'];
         $temp_name = $_FILES['course_file']['tmp_name'];
         $file_name = $_FILES['course_file']['name'];
         $file_address = "files/".$file_name;
         move_uploaded_file($temp_name,$file_address);
         $post_admin = $user_data['email'];
         $domain = $user_data['domain'];
         
         $query = "INSERT INTO posts(course_code,course_name,course_des,post_admin,	domain,file_link)
         VALUE('$course_code','$course_name','$course_des','$post_admin','$domain','$file_name')";
         //$conn -> query($query);
        // header("Location: " . PAGES['home']);
        if(mysqli_query($conn, $query)){
            //move_uploaded_file($tmp_name, 'upload/'.$std_img);
            //$conn -> query($query);
           // echo "Information Added Successfully";
            //header("Location: " . PAGES['add_post']);
            return "Information Added Successfully";
         }
         else{
            //  echo $course_code;
            //  echo $course_name;
            //  echo $file_name;
            //  $conn -> query($query);
             return "SOMETHIS WRONG!";
         }
      }
    }

    function desplay_my_data($conn,$user_data){
        $post_admin = $user_data['email'];
        $query = "SELECT * FROM posts WHERE post_admin='$post_admin'";
            if(mysqli_query($conn, $query)){
                $returndata = mysqli_query($conn, $query);
                return $returndata;
            }
    }
    function view_post($conn , $user_data){
        $post_domain = $user_data['domain'];
        $query = "SELECT * FROM posts WHERE domain='$post_domain'";
            if(mysqli_query($conn, $query)){
                $returndata = mysqli_query($conn, $query);
                return $returndata;
            }
       }
    
    function admin_image($conn,$admin_email){
        $query = "SELECT * FROM users WHERE email='$admin_email'";
            if(mysqli_query($conn, $query)){
                $returndata = mysqli_query($conn, $query);
                return $returndata;
            }
    }
?>