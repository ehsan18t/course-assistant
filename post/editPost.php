<!DOCTYPE html>

<html lang="en">

<?php
   
     require_once '../header.php';
 //  if user is already login then this index page will be shown in browser
      $user_data = check_login($conn);
      require_once INCLUDES['addPost-function']; 
      if(isset($_GET['status'])){
        if($_GET['status']='edit'){
            $id = $_GET['id'];
            $posts= display_data_by_id($conn,$id);
            $returndata=mysqli_fetch_assoc($posts);
        }
    }
    if(isset($_POST['edit_btn'])){
        $msg = update_data($conn,$_POST);
    }
   
?>




    <title>Edit Post</title>
  </head>
  <body>
  <?php require_once INCLUDES['nav-main-template']; ?>
  <?php require_once INCLUDES['nav-logged-template']; ?>

    <div >
        <h2><a  href="index.php">Edit Post</a></h2>
        <form  action="" method="post" enctype="multipart/form-data">
        <?php if(isset($msg)){echo $msg;} ?>
            <input  type="text" name="edit_course_code" value="<?php echo $returndata['course_code']; ?>">
            <input  type="text" name="edit_course_name" value="<?php echo $returndata['course_name']; ?>">
            <input  type="text" name="edit_course_des" value="<?php echo $returndata['course_des']; ?>">
            <label for="files">Update your File</label>
            <input type="file" name="edit_course_file" >
            <input type="hidden" name="fk_id" value="<?php echo $id; ?>">
            <input type="hidden" name="fk_address" value="<?php echo $returndata['file_link']; ?>">
            <input type="submit" value="Update Information" name="edit_btn">
        </form>
    </div>

    
  </body>
</html>