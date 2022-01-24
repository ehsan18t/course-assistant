<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
    require_once INCLUDES['addRequest-function'];


    // Add Request
    if(isset($_POST['add_request']))
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

    // if(isset($_GET['search-text'])) {
    //     $key = $_GET['search-text'];
    //     $posts = view_request_search($conn, $user_data, $key);
    // } else
        $posts = view_request($conn,$user_data);
?>

<link rel="stylesheet" href="<?php echo CSS['post.css']."?".time(); ?>">
<link rel="stylesheet" href="<?php echo CSS['modal.css']."?".time(); ?>">
<script type="text/javascript" src="<?php echo JS['toggle-visibility.js']; ?>"></script>
<title>All Request</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<div class="post-container">
    <div class="move-center">
        <center><button type="submit" onclick="window.location.href='<?php echo PAGES['add_request']; ?>'" class="new-post-btn"> Add Request </button></center>
        <center><button type="submit" onclick="window.location.href='<?php echo PAGES['rating']; ?>'" class="new-post-btn"> Rating </button></div></center>
<?php while($post=mysqli_fetch_assoc($posts)){ ?>

    <?php
     $author_email = $post['request_admin'];
     $image_link = admin_image($conn, $author_email);
     $author = mysqli_fetch_assoc($image_link);
    ?>
    <?php
     $admin_email = $post['helper_id'];
     $image_link = admin_image($conn, $admin_email);
     $admin = mysqli_fetch_assoc($image_link);
    ?>
    <div class="post-card">

        <img class="post-img" src="<?php echo DIR['picture'].$author['profile_pic_url']; ?>">
        <div class="post-text-container">
            <div class="post-title-style">
                <?php echo $post['r_course_name']; ?>
            </div>
            <span class="post-tag"><?php echo $post['r_course_code']; ?></span>
            <div class="post-author">
                <a href="<?php echo PAGES['profile'].'?user_id='.$author['u_id']; ?>">
                    <?php echo $author['f_name']." ".$author['l_name']; ?>
                </a>
            </div>
            <div>
                <p class="post-text-style">
                    <?php echo $post['r_course_des']; ?>
                </p>
            </div>
            <div class="post-btn-container">
                
                <a class="post-dl-btn" href="request/file/<?php //echo $post['file_link']; ?>" download
                         <?php if(empty($post['helper_id'])) echo 'style="display:none"';?> >Download</a>
                <!-- <a class="post-cm-btn" href="#">Comment</a> -->
                <a class="post-cm-btn" href="help.php?status=edit&&id=<?php echo $post['r_id'];?>"
                <?php if(!empty($post['helper_id'])) echo 'style="display:none"';?>>Help Me</a>
                <h4><?php //if(isset($post['helper_id']))echo 
                ?></h4>
                <br>
                <a class="post-author" href="<?php echo PAGES['profile'].'?user_id='.$admin['u_id']; ?>" 
                         <?php if(empty($post['helper_id'])) echo 'style="display:none"';?>>Help by <?php echo $admin['f_name']." ".$admin['l_name']; ?></a>
                
                    <!--  //echo $admin['f_name']." ".$admin['l_name']; ?> -->
                <?php// if(empty($post['helper_id'])) echo 'style="display:none"';?></a>
                
            </div>
        </div>
    </div>
    <?php } ?>
        <br><br>

</div>
</body>

</html>