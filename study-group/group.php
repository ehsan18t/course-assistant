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



<br />
<form action="" method="POST">
    <textarea type="text" name="message" placeholder="Write something"></textarea>
    <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
    <input type="submit" name="submit" value="Send Message" />
</form>

<br />
<br />
<?php
// Sub-query
$messages_query = "SELECT *
                        FROM ( SELECT *
                               FROM messages
                               WHERE group_id = $group_id) AS msg
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