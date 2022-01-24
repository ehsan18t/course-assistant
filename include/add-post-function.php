<?php
    function  add_post($conn,$POST,$user_data){
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        $course_code = $POST['course_code'];
         $course_name = $POST['course_name'];
         $course_des = $POST['course_des'];
         $temp_name = $_FILES['course_file']['tmp_name'];
         $file_name = $_FILES['course_file']['name'];
         $file_address = INC_DIR['files'].$file_name;
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
                return mysqli_query($conn, $query);
            }
    }
    function view_post($conn , $user_data){
        $post_domain = $user_data['domain'];
        $query = "SELECT * FROM posts WHERE domain='$post_domain' ORDER BY date DESC";
            if(mysqli_query($conn, $query)){
                return mysqli_query($conn, $query);
            }
       }
    
    function admin_image($conn,$admin_email){
        $query = "SELECT * FROM users WHERE email='$admin_email'";
            if(mysqli_query($conn, $query)){
                return mysqli_query($conn, $query);
            }
    }

     function display_data_by_id($conn,$id){
        $query = "SELECT * FROM posts WHERE p_id=$id";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }
    }
    
    function update_data($conn, $data){
        $course_code = $data['edit_course_code'];
        $course_name = $data['edit_course_name'];
        $course_des =$data['edit_course_des'];
        $idno = $data['fk_id'];
        $course_file = $_FILES['edit_course_file']['name'];
        $tmp_name = $_FILES['edit_course_file']['tmp_name'];
        $file_address = $data['fk_address'];
        if(!empty($course_file))$file_address = $course_file;


        $query = "UPDATE posts 
          SET course_code='$course_code', 
             course_name ='$course_name', 
             course_des='$course_des',
             file_link ='$file_address ' 
           WHERE p_id='$idno'";
        
        if(mysqli_query($conn, $query)){
            if(!empty($_FILES))move_uploaded_file($tmp_name, PAGES['post'].INC_DIR['files'].$course_file);
            header("Location: " . PAGES['home']);
            die();
        }
    }

    function delete_data($conn,$id){
        // $catch_img = "SELECT * FROM posts WHERE id=$id";
        // $delete_std_info = mysqli_query($conn, $catch_img);
        // $std_infoDle = mysqli_fetch_assoc($delete_std_info);
        // $deleteImg_data = $std_infoDle['stg_img'];
        $query = "DELETE FROM posts WHERE p_id=$id";
        if(mysqli_query($conn, $query)){
            //unlink('upload/'.$deleteImg_data);
            return "Deleted Successfully";
        }
    }

    function adding_comment($conn,$post_id,$commnet_admin,$comment){
        $query = "INSERT INTO comment(post_id,comment,comment_admin)
        VALUE('$post_id','$comment','$commnet_admin')";
        if(mysqli_query($conn, $query)){
            echo "Comment Added";
            
        }
    }

    function show_comment($conn,$post_id){
        //echo $post_id;
        $query = "SELECT * FROM comment WHERE post_id='$post_id'";
            if(mysqli_query($conn, $query)){
                return mysqli_query($conn, $query);
            }
                //else echo "WRONG";
        
    }
?>