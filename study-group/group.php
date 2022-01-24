<!DOCTYPE html>

<html lang="en">
<?php
require_once '../header.php';
//if user is already login then this index page will be shown in browser
$user_data = check_login($conn);
?>

<title>Message Page</title>
<link rel="stylesheet" href="<?php echo CSS['chat.css']."?".time(); ?>">
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<?php
$group_id = (int)$_GET['group_id'];
$sender_uid=(int)$user_data['u_id'];
?>


<!-- Sent message action-->
<?php
if(isset($_REQUEST['submit'])){
    $message = $_REQUEST['message'];

    $insert_sql="INSERT INTO messages (msg, sender, group_id)
				VALUES('$message', $sender_uid, $group_id)";
    if (!$conn->query($insert_sql))
        echo "Message we not sent! Please try again!";
    //  last inserted row id
//        $msg_id = $conn->insert_id;
    header('location:'.PAGES['group-chat'].'?group_id='.$group_id);
}
?>



<!-- Chat Header Section -->
<?php
    $group = mysqli_fetch_assoc($conn->query("SELECT * FROM study_group WHERE group_id=$group_id"));
    $open_date = new DateTime();
    $close_date = new DateTime();
    try {
        $open_date = new DateTime($group['open_date']);
        $close_date = new DateTime($group['close_date']);
    } catch (Exception $e) {}
    $open_date = $open_date->format('d/m/Y');
    $close_date = $close_date->format('d/m/Y');

    ?>
<div class="chat-people-container">
    <div class="chat-people-img">
<!--        <img src="--><?php //echo ($user['profile_pic_url'] == null ? IMG['avatar'] : DIR['picture'].$user['profile_pic_url']); ?><!--" alt="" class="chat-people-img-style">-->
        <div class="chat-people-name-container">
            <div class="chat-people-name">
                <span class="chat-people-name-style"><?php echo $group['group_name']; ?></span>
            </div>
            <span class="chat-people-des-style"><?php echo $open_date." - ".$close_date; ?></span>
        </div>
    </div>
</div>

<div class="chat-container">
<form action="" method="POST">
    <div class="chat-input-area">
        <textarea class="chat-input" type="text" name="message" placeholder="Write something"></textarea>
        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
        <input class="chat-send-btn" type="submit" name="submit" value="Send Message" />
    </div>
</form>

    <?php
    // Sub-query
    $messages_query = "SELECT *
                        FROM ( SELECT *
                               FROM messages
                               WHERE group_id = $group_id) AS msg
                        ORDER BY msg_id DESC";
    $message_sql=$conn->query($messages_query);
    ?>

    <div class="chat-content">
    <?php
    while($select_all_message=mysqli_fetch_assoc($message_sql)){

        $q = "SELECT * FROM users WHERE u_id=" . $select_all_message['sender'];
        $current = mysqli_fetch_assoc($conn->query($q));

        if($select_all_message['sender'] == $sender_uid){
            ?>
        <div class="chat-sender">
            <a href="<?php echo PAGES['profile'].'?user_id='.$current['u_id']; ?>"> <?php echo $current['f_name']." ".$current['l_name']; ?></a>
            <div class="chat-sender-style">
                <?php echo $select_all_message['msg']; ?>
            </div>
        </div>
            <?php
        } else{
            ?>
        <div class="chat-receiver">
            <a href="<?php echo PAGES['profile'].'?user_id='.$current['u_id']; ?>"> <?php echo $current['f_name']." ".$current['l_name']; ?></a>
            <div class="chat-receiver-style">
                <?php echo $select_all_message['msg']; ?>
            </div>
        </div>
    <?php } } ?>
    </div>
</div>

</body>

</html>