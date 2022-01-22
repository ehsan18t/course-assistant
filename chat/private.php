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
	$receiver_uid = (int)$_GET['receiver_uid'];
	$sender_uid=(int)$user_data['u_id'];
?>


<!-- Sent message action-->
 <?php 
 if(isset($_REQUEST['submit'])){
	$message = $_REQUEST['message'];
	 
	$insert_sql="INSERT INTO messages (msg, sender, receiver)
				VALUES('$message', $sender_uid, $receiver_uid)";
    if (!$conn->query($insert_sql))
        echo "Message we not sent! Please try again!";
        //  last inserted row id
//        $msg_id = $conn->insert_id;
	header('location:'.PAGES['private-chat'].'?receiver_uid='.$receiver_uid);
 }
 ?>


<?php
    // Message Query using Sub-query
    $messages_query = "SELECT *
                            FROM (
                                   SELECT *
                                   FROM messages
                                   WHERE group_id IS NULL
                                         ) AS msg
                            WHERE (sender=$sender_uid AND receiver=$receiver_uid)
                               OR (sender=$receiver_uid AND receiver=$sender_uid)
                            ORDER BY msg_id DESC";
    $message_sql=$conn->query($messages_query);
?>

<!-- Chat Header Section -->
<?php
    $user = mysqli_fetch_assoc($conn->query("SELECT * FROM users WHERE u_id=$receiver_uid"));
?>
<div class="chat-people-container">
    <div class="chat-people-img">
        <img src="<?php echo DIR['picture'].$user['profile_pic_url']; ?>" alt="" class="chat-people-img-style">
        <div class="chat-people-name-container">
            <div class="chat-people-name">
                <span class="chat-people-name-style"><?php echo $user['f_name'].$user['l_name']; ?></span>
            </div>
            <span class="chat-people-des-style"><?php echo $user['university']; ?></span>
            <span class="chat-people-des-style"><?php echo $user['department']; ?></span>
        </div>
    </div>
</div>
<!-- Chat Section -->
<div class="chat-container">
    <form action="" method="POST" class="chat-input-form">
        <div class="chat-input-area">
            <textarea type="text" class="chat-input" name="message" placeholder="Write something"></textarea>
            <input type="hidden" name="receiver_uid" value="<?php echo $receiver_uid ?>" />
            <input type="submit" class="chat-send-btn" name="submit" value="Send Message" />
        </div>
    </form>
    <div class="chat-content">
    <?php
    while($select_all_message=mysqli_fetch_assoc($message_sql)){
        if($select_all_message['sender'] == $sender_uid){ ?>
        <div class="chat-sender">
            <div class="chat-sender-style">
                <?php echo $select_all_message['msg']; ?>
            </div>
        </div>
            <?php } else { ?>
        <div class="chat-receiver">
            <div class="chat-receiver-style">
                <?php echo $select_all_message['msg']; ?>
            </div>
        </div>
<?php } } ?>
    </div>
</div>

</body>

</html>