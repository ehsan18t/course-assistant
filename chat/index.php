<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
?>

<title>Home Page</title>

</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<br />

<center>
	
<?php 
	$users=array();
	
	$current_user_uid=(int)$user_data['u_id'];
	$message_user_query = "SELECT * FROM messages WHERE (sender=$current_user_uid OR receiver=$current_user_uid) AND group_id IS NULL ORDER BY msg_id DESC";
	
	$message_user_sql=$conn->query($message_user_query);
	
	while($select_all_users=mysqli_fetch_assoc($message_user_sql)){
		if($select_all_users['sender'] != $current_user_uid){
			if(!in_array($select_all_users['sender'], $users)){
				$users[]=$select_all_users['sender'];
				continue;
			}
		}
		
		if($select_all_users['receiver'] != $current_user_uid){
			if(!in_array($select_all_users['receiver'], $users)){
				$users[]=$select_all_users['receiver'];
            }
		}
	}
	
	
	foreach($users as $x){
        $u = mysqli_fetch_assoc($conn->query("SELECT * FROM users WHERE u_id=$x"));
		echo "<a href='private.php?receiver_uid=".$x."'>".$u['f_name']." ".$u['l_name']."</a><br /> <br />";
	}
	
?>
	
</center>

</body>

</html>