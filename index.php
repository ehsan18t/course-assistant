<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php
    require_once './header.php';
    $user_data = check_login($conn);
    require_once INCLUDES['addPost-function'];

    if(isset($_GET['search-text'])) {
        $key = $_GET['search-text'];
        $posts = view_post_search($conn, $user_data, $key);
    } else
        $posts = view_post($conn,$user_data);
?>

<link rel="stylesheet" href="<?php echo CSS['post.css']."?".time(); ?>">
<title>Home Page</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<div class="post-container">
    <div class="move-center">
        <center>
            <button type="submit" onclick="window.location.href='<?php echo PAGES['add-post']; ?>'" class="new-post-btn"> Create New Post </button>
            <button type="submit" onclick="window.location.href='<?php echo PAGES['request']; ?>'" class="new-post-btn"> Create New Request </button>
        </center>
    </div>
<?php while($post=mysqli_fetch_assoc($posts)){ ?>

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
                <a class="post-dl-btn" href="post/file/<?php echo $post['file_link']; ?>" download>Download</a>
                <a class="post-cm-btn" href="#">Comment</a>
            </div>
        </div>
    </div>
    <?php } ?>
        <br><br>

</div>
</body>

</html>