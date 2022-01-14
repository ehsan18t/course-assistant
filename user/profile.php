<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
    $current_uid = $user_data['u_id'];
    require_once INCLUDES['view-post-function'];
    require_once INCLUDES['addPost-function'];
    $posts = null;

    if(isset($_GET['user_id'])) {
        $posts = view_post_by_id($conn, $user_data, $_GET['user_id']);
        $user_data = get_user($conn, $_GET['user_id']);
    }
    else
        $posts = view_post_by_id($conn, $user_data, $user_data['u_id']);
?>

    <title>Profile Page</title>
    <link rel="stylesheet" href="<?php echo CSS['profile.css']; ?>">
    <link rel="stylesheet" href="<?php echo CSS['post.css']; ?>">
<link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>


<!-- top section-->
<div class="w-full bg-white h-64 bg-sky-500 flex-col shadow-2xl flex" style="background-color: rgb(14 165 233);">
    <?php if ($current_uid == $user_data['u_id']) {
    $edit_code = <<<'EOD'
    <!-- START Edit Profile Options -->
    <div class="top-icons" >
        <div class="h-4 text-white pr-2" >
            <div class="inline float-right text-xs mt-4" >
                <a href = "<?php echo PAGES['edit-profile'] ?>" class="hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full" >
        Edit Profile
        </a >
                <a href = "<?php echo PAGES['change-profile-pic'] ?>" class="hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full" >
        Change Profile Picture
        </a >
            </div >
        </div >
    </div >
    <!--  END Edit Profile Options  -->
EOD;
    echo $edit_code;
    }
 ?>
    <!--back button-->
    <div class="h-6 mt-2">

    </div>
    <!-- end back button-->

    <!-- avatar profile-->
    <div class="h-32 mb-4">
        <div class="wrapper flex-column items-center">
            <div class="h-16 w-16 rounded-full bg-white mx-auto">
                <img src="<?php echo ($user_data['profile_pic_url'] == NULL ? IMG['avatar'] : DIR['picture'].$user_data['profile_pic_url']) ?>" class="rounded-full" alt="">
            </div>
            <div class="text-white font-semibold text-2xl mt-1 content-center text-center">
                <?php echo $user_data['f_name']. ' ' .$user_data['l_name']; ?>
            </div>
            <div class="text-white text-s text-center text-gray-300">
                <?php echo $user_data['university'] ?>
            </div>
            <div class="text-white text-s text-center text-gray-300">
                <?php echo $user_data['department'] ?>
            </div>
        </div>

    </div>
    <!-- end avatar profile-->
<?php if ($current_uid != $user_data['u_id']) {
    $contact_code = <<<'EOD'
    <!-- START PM/Email Me Option -->
    <div class="h-24 mx-auto relative shadow-lg bg-white rounded-lg p-2 flex w-3/12" style="top:1em">
        <div class="w-1/2 ml-2 flex my-auto">
            <a class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full ml-3">
                Email Me
            </a>

        </div>
        <div class="w-1/2 flex my-auto pl-5 border-l-2 border-gray-300 object-right">
            <a class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full ml-3">
                PM Me
            </a>
        </div>
    </div>
    <!-- END PM/Email Me Option -->
EOD;
    echo $contact_code;
}
?>

</div>
<!-- end top section-->

<!-- bottom section -->
<!--<div class="h-auto w-11/12 bg-white mx-auto pt-12 shadow-2xl">-->
<!--    <div class="mx-auto w-11/12 h-32 bg-white shadow-lg" style="top:3em;">-->

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
<!--    </div>-->
<!--</div>-->
<!-- end bottom section -->

</body>

</html>
