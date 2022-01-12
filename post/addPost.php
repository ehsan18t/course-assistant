<?php
   
     require_once '../header.php';
 //  if user is already login then this index page will be shown in browser
      $user_data = check_login($conn);
      require_once INCLUDES['addPost-function'];
      $data;
      if(isset($_POST['add_post']))
       {
           //echo "Send Massage";
           $upload_lmsg = add_post($conn, $_POST,$user_data);
       }
       $posts = desplay_my_data($conn,$user_data);

       if(isset($_GET['status'])){
        if($_GET['status']='delete'){
            $delete_id = $_GET['id'];
            $delmsg =  delete_data($conn,$delete_id);
        }
    }
   
?>


<!doctype html>
<html lang="en">
  <head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Add Post</title> 
  </head> 
  <body>
    <div class="container my-4 p-4 shadow">
        <h2><a style="text-decoration: none;" href="index.php">POST FILE</a></h2>
        <?php //if(isset($delmsg)){
            //echo $delmsg;
        //} ?>
        <form class="form" action="" method="post" enctype="multipart/form-data">
        <?php if(isset($upload_lmsg)){echo $upload_lmsg;} ?>
            <input class="form-control mb-2" type="text" name="course_code" placeholder="Enter Course Code" require>
            <input class="form-control mb-2" type="text" name="course_name" placeholder="Enter Course Name" require>
            <input class="form-control mb-2" type="text" name="course_des" placeholder="Description" require>
            <label for="file">Upload Your Files</label>
            <input class="form-control mb-2" type="file" name="course_file" require >
            <input type="submit" value="POST" name="add_post" class="form-control bg-warning">
        </form>
    </div>
    <div class="container my-4 p-4 shadow">
    <h2><a style="text-decoration: none;" href="index.php">YOUR UPLOADED FILES</a></h2>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
            <?php while($post=mysqli_fetch_assoc($posts)){ ?>
                <tr>
                    <td><?php echo $post['p_id']; ?></td>
                    <td><?php echo $post['course_code']; ?></td>
                    <td><?php echo $post['course_name']; ?></td>
                    <td><?php echo $post['course_des']; ?></td>
                    <td><?php echo $post['file_link']; ?></td>
                    <td>
                        <a class="btn btn-success" href="editPost.php?status=edit&&id=<?php echo $post['p_id']; ?>">Edit</a>
                        <a class="btn btn-warning" href="?status=delete&&id=<?php echo $post['p_id']?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>