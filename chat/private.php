<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
?>

<title>Message Page</title>

<style type="text/css">

.sender_message_color{
	color: #ff0000;
	float: right;
	margin-right: 50px;
}

.receiver_message_color{
	color: #000000;
	float: left;
	margin-left: 50px;
}

</style>

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



<br />
<form action="" method="POST">
	<textarea type="text" name="message" placeholder="Write something"></textarea>
	<input type="hidden" name="receiver_uid" value="<?php echo $receiver_uid ?>" />
	<input type="submit" name="submit" value="Send Message" />
</form>

<br />
<br />
<?php
    // Sub-query
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
	while($select_all_message=mysqli_fetch_assoc($message_sql)){
		
		if($select_all_message['sender'] == $sender_uid){
		?> 
			<div class="sender_message_color">
				<?php echo $select_all_message['msg']; ?>
			</div> <br /> <br /> <br />
		<?php
		} else{
		?> 
			<div class="receiver_message_color">
				<?php echo $select_all_message['msg']; ?>
			</div>  <br /> <br /> <br />
		<?php
		}
	}
	
?>


</body>

</html>