<!DOCTYPE html>

<html lang="en">
<?php
   
     require_once '../header.php';
 //  if user is already login then this index page will be shown in browser
      $user_data = check_login($conn);
      require_once INCLUDES['addRequest-function'];
      if(isset($_POST['add_request']))
       {
           //echo "Send Massage";
           $upload_lmsg = add_post($conn, $_POST,$user_data);
           unset($_POST['add_request']);
           header("Refresh:0");
       }
          $posts = desplay_my_data($conn,$user_data);

       if(isset($_GET['status'])){
        if($_GET['status']='delete'){
            $delete_id = $_GET['id'];
            $delmsg = delete_data($conn,$delete_id);
            header("Location:my_request.php");
        }
    }
   
?>




    <title>Add Request</title>
<link rel="stylesheet" href="<?php echo CSS['post.css']."?".time(); ?>">
<link rel="stylesheet" href="<?php echo CSS['modal.css']."?".time(); ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
  </head> 
  <body>
  <?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>
  <br>
  <br>
        <div class="modal-content">
        <form action="" method="post" enctype="multipart/form-data">
        <?php if(isset($upload_lmsg)){echo $upload_lmsg;} ?>
            <label>Course Code</label>
            <input type="text" name="request_course_code" placeholder="Enter Course Code" required>
            <label>Course Name</label>
            <input type="text" name="request_course_name" placeholder="Enter Course Name" required>
            <label>Description</label>
            <input type="text" name="request_course_des" placeholder="Description" required>
            <input type="submit" value="Add Request" name="add_request" class="form-control bg-warning">
        </form>
    </div>
    <div>
        <br>
        <br>

    <h2><a>YOUR UPLOADED FILES</a></h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Helper<th>
                </tr>
            </thead>
            <tbody>
            <?php while($post=mysqli_fetch_assoc($posts)){ ?>
                <tr>
                    <td><?php  echo $post['r_id']; ?></td>
                    <td><?php  echo $post['r_course_code']; ?></td>
                    <td><?php  echo $post['r_course_name']; ?></td>
                    <td><?php  echo $post['r_course_des']; ?></td>
                    <td><?php  echo $post['r_course_link']; ?></td>
                    <td><?php  echo $post['helper_id']; ?></td>
                    <td>
                        <a href="files/<?php echo $post['r_course_link']; ?>" download>Download</a>
                        <a href="?status=delete&&id=<?php echo $post['r_id']?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


  </body>
</html>