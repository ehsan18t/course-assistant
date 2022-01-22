<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
    $current_uid = $user_data['u_id'];
    $current_uemail = $user_data['email'];
    require_once INCLUDES['view-post-function'];
    require_once INCLUDES['addPost-function'];
    $posts = null;


    // Delete Post
    if(isset($_POST['delete'])){
        $delete_id = $_POST['id'];
        $delmsg =  delete_data($conn, $delete_id);
        header("Location: " . PAGES['home']);
    }

    // Edit Post
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $posts= display_data_by_id($conn,$id);
        $old_data=mysqli_fetch_assoc($posts);
    }
    if(isset($_POST['edit_btn'])){
        update_data($conn, $_POST);
    }

    // Search
    if(isset($_GET['user_id'])) {
        $posts = view_post_by_id($conn, $user_data, $_GET['user_id']);
        $user_data = get_user($conn, $_GET['user_id']);
    }
    else
        $posts = view_post_by_id($conn, $user_data, $user_data['u_id']);
?>

    <title>Profile Page</title>
    <link rel="stylesheet" href="<?php echo CSS['profile.css']."?".time(); ?>">
    <link rel="stylesheet" href="<?php echo CSS['post.css']."?".time(); ?>">
<link rel="stylesheet" href="<?php echo CSS['modal.css']."?".time(); ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>


<!-- top section-->
<div class="profile-container">
    <?php if ($current_uid == $user_data['u_id']) {
    $edit_code_p1 = <<<'EOD'
    <!-- START Edit Profile Options -->
        <div class="profile-top-btn-container" >
            <div class="profile-top-btn-style" >
                <a href = "
EOD;
$edit_code_p2 = <<<'EOD'
" class="profile-top-btn" >
        Edit Profile
        </a >
                <a href = "
EOD;
$edit_code_p3 = <<<'EOD'
" class="profile-top-btn" >
        Change Profile Picture
        </a >
            </div >
        </div >
    <!--  END Edit Profile Options  -->
EOD;
    echo $edit_code_p1.PAGES['edit-profile'].$edit_code_p2.PAGES['change-profile-pic'].$edit_code_p3;
    }
 ?>
    <!--back button-->
    <div class="profile-top-gap"> </div>
    <!-- end back button-->

    <!-- avatar profile-->
    <div class="profile-info-container">
        <div class="profile-info-content">
            <div class="profile-avatar">
                <img src="<?php echo ($user_data['profile_pic_url'] == NULL ? IMG['avatar'] : DIR['picture'].$user_data['profile_pic_url']) ?>" class="profile-avatar-style" alt="">
            </div>
            <div class="profile-info-title">
                <?php echo $user_data['f_name']. ' ' .$user_data['l_name']; ?>
            </div>
            <div class="profile-info-other">
                <?php echo $user_data['university'] ?>
            </div>
            <div class="profile-info-other">
                <?php echo $user_data['department'] ?>
            </div>
        </div>

    </div>
    <!-- end avatar profile -->
<?php if ($current_uid != $user_data['u_id']) {
    $contact_code_p1 = <<<'EOD'
    <!-- START PM/Email Me Option -->
    <div class="profile-contact-container" style="top:1em">
        <div class="profile-contact-first-of-two">
            <a href="
EOD;
    $contact_code_p2 = <<<'EOD'
" class="profile-btn-contact">
                Email Me
            </a>

        </div>
        <div class="profile-contact-second-of-two">
            <a href="
EOD;
    $contact_code_p3 = <<<'EOD'
" class="profile-btn-contact">
                PM Me
            </a>
        </div>
    </div>
    <!-- END PM/Email Me Option -->
EOD;
    echo $contact_code_p1."mailto:".$user_data['email'].$contact_code_p2.PAGES['private-chat']."?receiver_uid=".$user_data['u_id'].$contact_code_p3;
}
?>

</div>
<!-- end top section-->

<!-- bottom section -->
<!--<div class="h-auto w-11/12 bg-white mx-auto pt-12 shadow-2xl">-->
<!--    <div class="mx-auto w-11/12 h-32 bg-white shadow-lg" style="top:3em;">-->

<?php while($post=mysqli_fetch_assoc($posts)){ ?>

<div class="post-container">

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

    <?php
    $author_email = $post['post_admin'];
    $image_link = admin_image($conn, $author_email);
    $author = mysqli_fetch_assoc($image_link);
    ?>
    <div class="post-card">

        <img class="post-img" src="<?php echo ($author['profile_pic_url'] == null ? IMG['avatar'] : DIR['picture'].$author['profile_pic_url']); ?>">
        <div class="post-text-container">
            <div class="post-title-style">
                <?php echo $post['course_name']; ?>
            </div>
            <span class="post-tag"><?php echo $post['course_code']; ?></span>
            <div class="post-author">
                <a href="<?php echo PAGES['profile'].'?user_id='.$user_data['u_id']; ?>">
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
                <a class="post-dl-btn" href="post/file/<?php echo $post['file_link']; ?>">Download</a>
                <a class="post-cm-btn" href="#">Comment</a>
                <input type="hidden" name="id" value="<?php echo $post['p_id']; ?>">

                <?php
                if ($author_email == $current_uemail) {
                    echo "<input class='post-cm-btn' onclick='toggleVisibility(\"edit-post-popup\")' type='submit' value='Edit'>";
                    echo "<input class='post-cm-btn' style='margin-left: 0.25rem' onclick='return confirm(\"Are you sure you want to delete this item?\")' type='submit' name='delete' value='Delete'>";
                } ?>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
<!--    </div>-->
<!--</div>-->
<!-- end bottom section -->

</body>

</html>
