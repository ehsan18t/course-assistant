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


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Edit Post</title>
  </head>
  <body>
    <div class="container my-4 p-4 shadow">
        <h2><a style="text-decoration: none;" href="index.php">Edit Post</a></h2>
        <form class="form" action="" method="post" enctype="multipart/form-data">
        <?php if(isset($msg)){echo $msg;} ?>
            <input class="form-control mb-2" type="text" name="edit_course_code" value="<?php echo $returndata['course_code']; ?>">
            <input class="form-control mb-2" type="text" name="edit_course_name" value="<?php echo $returndata['course_name']; ?>">
            <input class="form-control mb-2" type="text" name="edit_course_des" value="<?php echo $returndata['course_des']; ?>">
            <label for="image">Update your File</label>
            <input class="form-control mb-2" type="file" name="edit_course_file" >
            <input type="hidden" name="fk_id" value="<?php echo $id; ?>">
            <input type="hidden" name="fk_address" value="<?php echo $returndata['file_link']; ?>">
            <input type="submit" value="Update Information" name="edit_btn" class="form-control bg-warning">
        </form>
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