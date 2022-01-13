<!DOCTYPE html>

<html lang="en">
<?php
require_once './header.php';
$user_data = check_login($conn);
require_once INCLUDES['addPost-function'];
$posts = view_post($conn, $user_data);
?>

<link rel="stylesheet" href="<?php echo CSS['post.css']; ?>">
<title>Home Page</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php while($post=mysqli_fetch_assoc($posts)){ ?>

<div class="post-container">
    <?php
    $author_email = $post['post_admin'];
    $image_link = admin_image($conn, $author_email);
    $author = mysqli_fetch_assoc($image_link);
    ?>
    <div class="post-card">

        <img class="post-img" src="<?php echo DIR['picture'].$author['profile_pic_url']; ?>">
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
                <a class="post-dl-btn" href="post/file/<?php echo $post['file_link']; ?>">Download</a>
                <a class="post-cm-btn" href="#">Comment</a>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
</body>

</html>