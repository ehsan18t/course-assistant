<?php
  function  add_post($conn,$POST,$user_data){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
       $course_code = $POST['request_course_code'];
        $course_name = $POST['request_course_name'];
        $course_des = $POST['request_course_des'];
        $r_course_link = "NULL";
        $post_admin = $user_data['email'];
        $domain = $user_data['domain'];
        //$helper_id = "NULL";
        
        $query = "INSERT INTO request(r_course_code,r_course_name,r_course_des,r_course_link,request_admin,	domain)
                                VALUE('$course_code','$course_name','$course_des','$r_course_link','$post_admin','$domain')";
       
       if(mysqli_query($conn, $query)){
           return "Information Added Successfully";
        }
        else{
           // echo $course_code;
            //echo $course_name;
            return "SOMETHIS WRONG!";
        }
     }
   }

   function desplay_my_data($conn,$user_data){
      $post_admin = $user_data['email'];
      $query = "SELECT * FROM request WHERE request_admin='$post_admin'";
          if(mysqli_query($conn, $query)){
              return mysqli_query($conn, $query);
          }
   }

   function view_request($conn , $user_data){
      $post_domain = $user_data['domain'];
      $query = "SELECT * FROM request WHERE domain='$post_domain' ORDER BY dt DESC";
          if(mysqli_query($conn, $query)){
              return mysqli_query($conn, $query);
          }
          else{
             echo  "Something wrong!";
          }
   }
//    function view_request_search($conn , $user_data, $key){
//       $post_domain = $user_data['domin'];
//       $query = "SELECT * FROM request WHERE domain='$post_domain' AND (r_course_name LIKE '%$key%' OR r_course_code LIKE '%$key%' OR r_course_des LIKE '%$key%')";
//       if(mysqli_query($conn, $query)){
//           return mysqli_query($conn, $query);
//       }
//   }
  function admin_image($conn,$admin_email){
   $query = "SELECT * FROM users WHERE email='$admin_email'";
       if(mysqli_query($conn, $query)){
           return mysqli_query($conn, $query);
       }

  }

  function addPoint($conn,$user_email){
       $query = "SELECT * FROM rating where rating_email='$user_email'";
       //$query = "SELECT count(*) as total,points FROM rating HAVING rating_email='$user_email'"; 
       $result = mysqli_query($conn,$query);
       return $result;
  }

  function upload_data($conn,$data,$request_id,$admin){
   $temp_name = $_FILES['file']['tmp_name'];
   $file_name = $_FILES['file']['name'];
   $file_address = "files/".$file_name;
   $halper = $admin['email'];
   move_uploaded_file($temp_name,$file_address);
   $query = "UPDATE request 
    SET  r_course_link = '$file_address',
         helper_id   =  '$halper' 
    WHERE r_id=$request_id";


    if(mysqli_query($conn, $query)){
      $data = addPoint($conn,$halper);
      $data = mysqli_fetch_assoc($data);
      if(isset($data)){
        $points =$data['points'] + 10;
        echo $points;
        echo $halper;
          $query = "UPDATE rating
                     SET   points = $points
                     WHERE rating_email='$halper'";
          if(mysqli_query($conn, $query)){
            mysqli_query($conn, $query);
          }
          else echo "There is some problem";
      }
      else{
        $domain = $admin['domain'];
        $query = "INSERT INTO rating(rating_email,points,domain)
                           VALUE('$halper','10','$domain')";
        mysqli_query($conn, $query);
      }

           


      header("Location: " . PAGES['home']);
      die();
    }
  }
  function delete_data($conn,$id){
    
    $query = "DELETE FROM request WHERE r_id=$id";
    if(mysqli_query($conn, $query)){
        //unlink('upload/'.$deleteImg_data);
        return "Deleted Successfully";
    }
}
function view_rating($conn , $user_data){
  $post_domain = $user_data['domain'];
  
  $query = "SELECT * FROM rating JOIN users ON rating.rating_email = users.email ORDER BY rating.points DESC"; 
      if(mysqli_query($conn, $query)){
          return mysqli_query($conn, $query);
      }
      else{
         echo  "Something wrong!";
      }
}
?>