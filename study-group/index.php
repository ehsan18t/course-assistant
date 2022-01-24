<!DOCTYPE html>

<html lang="en">
<?php
require_once '../header.php';
//if user is already login then this index page will be shown in browser
$user_data = check_login($conn);
?>

<title>Study Group</title>

<link rel="stylesheet" href="<?php echo CSS['post.css']."?".time(); ?>">
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<div class="post-container">

    <?php
    $groups=array();
    $current_user_uid=(int)$user_data['u_id'];
    // sub-query and join function
    $message_group_query = "SELECT *
                            FROM  ( SELECT *
                                    FROM participants
                                    WHERE user_id = $current_user_uid) AS g
                            JOIN study_group AS sg
                            ON g.group_id=sg.group_id";

    $message_group_sql=$conn->query($message_group_query);

    while($select_group=mysqli_fetch_assoc($message_group_sql)){
            $groups[]=$select_group;
    }

    $count = 0;
    foreach($groups as $x){ ?>
        <a href="<?php echo PAGES['group-chat'].'?group_id='.$x['group_id']; ?>">
            <div class="post-card">
                <div class="post-text-container">
                    <div class="post-title-style">
                        <?php echo $x['group_name']; ?>
                    </div>
                </div>
            </div>
        </a>
            <?php $count++;
    }
    if ($count == 0)
        echo " You have no active study group."
    ?>

</div>

</body>

</html>