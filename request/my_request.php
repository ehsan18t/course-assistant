<!DOCTYPE html>

<html lang="en">
<?php
   
     require_once '../header.php';
 //  if user is already login then this index page will be shown in browser
      $user_data = check_login($conn);
      require_once INCLUDES['addRequest-function'];
      $data;
      if(isset($_POST['add_request']))
       {
           //echo "Send Massage";
           $upload_lmsg = add_post($conn, $_POST,$user_data);
       }
          $posts = desplay_my_data($conn,$user_data);

    //    if(isset($_GET['status'])){
    //     if($_GET['status']='delete'){
    //         $delete_id = $_GET['id'];
    //         $delmsg =  delete_data($conn,$delete_id);
    //     }
    // }
   
?>




    <title>Add Post</title> 
  </head> 
  <body>
  <?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>
    <div >
        <h2><a href="index.php">Add A Requset</a></h2>
        <?php //if(isset($delmsg)){
            //echo $delmsg;
        //} ?>
        <form action="" method="post" enctype="multipart/form-data">
        <?php if(isset($upload_lmsg)){echo $upload_lmsg;} ?>
            <input type="text" name="request_course_code" placeholder="Enter Course Code" require>
            <input type="text" name="request_course_name" placeholder="Enter Course Name" require>
            <input type="text" name="request_course_des" placeholder="Description" require>
            <input type="submit" value="Add Request" name="add_request" class="form-control bg-warning">
        </form>
    </div>
    <div>
    <h2><a>YOUR UPLOADED FILES</a></h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                        <a  href="files/<?php echo $post['r_course_link']; ?>" download>Download</a>
                        <a  href="?status=delete&&id=<?php //echo $post['p_id']?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


  </body>
</html>