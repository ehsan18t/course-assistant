<!DOCTYPE html>

<html lang="en">
<?php
    require_once './header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
    require_once INCLUDES['addPost-function'];
    $posts = view_post($conn,$user_data);
?>



<title>Home Page</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>
<?php while($post=mysqli_fetch_assoc($posts)){ ?>
<div >

   <h2><a ></a></h2>
        <table >
            <thead>
                	<tr>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                    </tr>

            </thead>
            <tbody>
                <tr>
                    <?php
                       $admin_email = $post['post_admin'];
                       $image_link = admin_image($conn,$admin_email);
                       $admain = mysqli_fetch_assoc($image_link);
                    ?>
                    <td><img style="height: 100px;" src="<?php echo $admain['profile_pic_url']; ?>"></td>  
                    <!-- -->
                </tr>
				<tr>
					<td><h3>Admin Name : <?php echo $admain['f_name']; ?> </h3></td>
				</tr>
                <tr>
					<td><h4>Course Name : <?php echo $post['course_name']; ?> </h3></td>
				</tr>
				<tr>
                    <td><h4>Course code : <?php echo $post['course_code']; ?></h4></td>
  
                </tr>
				<tr>
					<td>Description : <?php echo $post['course_des']; ?> </td>
				</tr>
				<tr>
					<td>
                        <?php //echo $post['file_link'];?>
						<a class="btn btn-success" href="post/file/<?php echo $post['file_link']; ?>" download>Download</a>
                        <a class="btn btn-warning" href="#">Comment</a>
					</td>
				</tr>
            </tbody>
        </table>
        <br>
        <?php echo "<br>" ?>
        
    </div>
    <?php } ?>
    

</body>

</html>