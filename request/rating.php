<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
    require_once INCLUDES['addRequest-function'];

     $alldata = view_rating($conn,$user_data);
?>

<link rel="stylesheet" href="<?php echo CSS['post.css']; ?>">
<title>Home Page</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<div class="post-container">
        
<?php while($allData=mysqli_fetch_assoc($alldata)){ ?>

    <?php
     $author_email = $allData['rating_email'];
     $image_link = admin_image($conn, $author_email);
     $author = mysqli_fetch_assoc($image_link);
    ?>
    <div class="post-card">

        <img class="post-img" src="<?php echo DIR['picture'].$author['profile_pic_url']; ?>">
        <div class="post-text-container">
            <div class="post-title-style">
                <?php echo $allData['points']; ?>
            </div>
            <div class="post-author">
                <a href="<?php echo PAGES['profile'].'?user_id='.$author['u_id']; ?>">
                    <?php echo $author['f_name']." ".$author['l_name']; ?>
                </a>
            </div>
            
        </div>
    </div>
    <?php } ?>
        

</div>
</body>

</html>