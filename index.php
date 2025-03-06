<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php
    require_once './header.php';
    $user_data = check_login($conn);
    require_once INCLUDES['addPost-function'];

    // Add Post
    if(isset($_POST['add_post']))
    {
        //echo "Send Massage";
        $upload_lmsg = add_post($conn, $_POST,$user_data);
        header("Location: " . PAGES['home']);
    }
    $posts = display_my_data($conn,$user_data);

    // Delete Post
    if(isset($_POST['delete'])){
        $delete_id = $_POST['id'];
        $delmsg =  delete_data($conn, $delete_id);
        header("Location: " . PAGES['home']);
    }

    // Edit Post
    if(isset($_POST['edit_post'])){
         $id = $_POST['id'];
         $posts= display_data_by_id($conn,$id);
         $old_data=mysqli_fetch_assoc($posts);
    }
    if(isset($_POST['edit_btn'])){
        update_data($conn, $_POST);
    }

    // Search
    if(isset($_GET['search-text'])) {
        $key = $_GET['search-text'];
        $posts = view_post_search($conn, $user_data, $key);
    } else
        $posts = view_post($conn,$user_data);

    //add comment
    if(isset($_POST['comment'])){
       $post_id_for_comment = $_POST['id'];
        //echo $post_id_for_comment;
    }
    if(isset($_POST['submit_comment'])){
        $post_id = $_POST['post_id'];
        $commnet_admin = $_POST['comment_admin'];
        $comment = $_POST['comment_contant'];
        //echo $post_id_for_comment;
         echo adding_comment($conn,$post_id,$commnet_admin,$comment);
        //  sleep(5);
         header("Location: " . PAGES['home']);
         die();
    }

    //show comment
    if(isset($_POST['view_comment'])){
        $post_id = $_POST['id'];
        $comment_data = show_comment($conn,$post_id);
    }
     
?>

<link rel="stylesheet" href="<?php echo CSS['post.css']."?".time(); ?>">
<link rel="stylesheet" href="<?php echo CSS['modal.css']."?".time(); ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
<title>Home Page</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>




 <!-- for comment -->
<div class="post-container">

      <div id="comment-post-popup"  class="<?php echo (isset($post_id_for_comment) ? 'show': 'hide'); ?>" >
        <div class="modal-content">
            <button onclick="toggleVisibility('comment-post-popup')" class="close"> Close </button>
            <?php $post_id_for_comment;?>
            <form action="" method="post" enctype="multipart/form-data"> 
                <input type="text" name="comment_contant" required> 
                <input type="hidden" name="post_id" value="<?php echo $post_id_for_comment ?>">
                <input type="hidden" name="comment_admin" value="<?php echo $user_data['email']; ?>">
                <input type="submit" value="Add Comment" name="submit_comment">
            </form>
            
        </div>
    </div>
     <!-- fow showing all comment -->



 
    
    <div id="edit-post-popup" class="<?php echo (isset($id) ? 'show': 'hide'); ?>">
        <div class="modal-content">
            <button onclick="toggleVisibility('edit-post-popup')" class="close"> Close </button>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="edit_course_code" value="<?php echo $old_data['course_code']; ?>">
                <input type="text" name="edit_course_name" value="<?php echo $old_data['course_name']; ?>">
                <input type="text" name="edit_course_des" value="<?php echo $old_data['course_des']; ?>">
                <label for="files">Update your File</label>
                <input type="file" name="edit_course_file">
                <input type="hidden" name="fk_id" value="<?php echo $id; ?>">
                <input type="hidden" name="fk_address" value="<?php echo $old_data['file_link']; ?>">
                <input type="submit" value="Update Information" name="edit_btn">
            </form>
        </div>
    </div>

    <div id="add-post-popup" class="hide">
        <div class="modal-content">
            <button onclick="toggleVisibility('add-post-popup')" class="close"> Close </button>
            <form action="" method="post" enctype="multipart/form-data">
                <?php if(isset($upload_lmsg)){echo $upload_lmsg;} ?>
                <input type="text" name="course_code" placeholder="Enter Course Code" required>
                <input type="text" name="course_name" placeholder="Enter Course Name" required>
                <input type="text" name="course_des" placeholder="Description" required>
                <label for="file">Upload Your Files</label>
                <input type="file" name="course_file" required>
                <input type="submit" value="POST" name="add_post" class="form-control bg-warning">
            </form>
        </div>
    </div>

    <div class="move-center">
        <center>
            <button type="submit" onclick="toggleVisibility('add-post-popup')" class="new-post-btn"> Upload Content </button>
            <button type="submit" onclick="window.location.href='<?php echo PAGES['request']; ?>'" class="new-post-btn"> Request </button>
        </center>
    </div>
<?php while($post=mysqli_fetch_assoc($posts)){ ?>

    <?php
    $author_email = $post['post_admin'];
    $image_link = admin_image($conn, $author_email);
    $author = mysqli_fetch_assoc($image_link);
    ?>
    <div class="post-card">
        <img class="post-img" src="<?php echo ($author['profile_pic_url'] == NULL ? IMG['avatar'] : DIR['picture'].$author['profile_pic_url']); ?>">
        <div class="post-text-container">
            <div class="post-title-style">
                <?php echo $post['course_name']; ?>
            </div>
            <span class="post-tag"><?php echo $post['course_code']; ?></span>
            <div class="post-author">
                <a href="<?php echo PAGES['profile'].'?user_id='.$author['u_id']; ?>">
                    <?php echo $author['f_name']." ".$author['l_name']; ?>
                </a>
            </div>
            <div>
                <p class="post-text-style">
                    <?php echo $post['course_des']; ?>
                </p>
            </div>
            <div class="post-btn-container">
                <form action="" method="post">
                <a class="post-dl-btn" href="uploads/files/<?php echo $post['file_link']; ?>">Download</a>
                <!-- <a class="post-cm-btn" onclick="toggleVisibility('comment-post-popup')" >Comment</a> -->
                    <input type="hidden" name="id" value="<?php echo $post['p_id']; ?>">

                    <?php
                    if ($author_email == $user_data['email']) {
                        echo "<input class='post-cm-btn' onclick='toggleVisibility(\"edit-post-popup\")' type='submit' name='edit_post' value='Edit'>";
                        echo "<input class='post-cm-btn' style='margin-left: 0.25rem' onclick='return confirm(\"Are you sure you want to delete this item?\")' type='submit' name='delete' value='Delete'>";
                    } 
                    echo "<input class='post-cm-btn' style='margin-left: 0.25rem' onclick='toggleVisibility(\"comment-post-popup\")' type='submit' name='comment'  value=' ADD Comment'>";
                    //echo "<input class='post-cm-btn' style='margin-left: 0.25rem' onclick='toggleVisibility(\"comment-show-popup\")' type='submit' name='view_comment'  value='View Comment'>";
                    ?>
                    <!-- <input type="hidden"class='post-cm-btn' style='margin-left: 0.25rem' name="id" value=""> -->
                    <a  class='post-cm-btn' style='margin-left: 0.25rem' href="post/view_comment.php?status=comments&&id=<?php echo $post['p_id']; ?>" >All Comment</a>
                </form>
               
            </div>
        </div>
    </div>
    <?php } ?>
        <br><br>
</div>
</body>

</html>