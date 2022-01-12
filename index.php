<!DOCTYPE html>

<html lang="en">
<?php
    require_once './header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
    require_once INCLUDES['addPost-function'];
    $posts = view_post($conn,$user_data);
?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS['styles.css'] ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<title>Home Page</title>
</head>

<body>
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>
<?php while($post=mysqli_fetch_assoc($posts)){ ?>
<div class="container my-4 p-4 shadow">

   <h2><a style="text-decoration: none;" href="index.php">Course name</a></h2>
        <table class="table table-responsive">
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
                    <td><img style="height: 100px;" src="upload/?php echo $student['stg_img']; ?>"></td>  
                </tr>
				<tr>
					<td><h3>Name : <?php echo $post['course_name']; ?> </h3></td>
				</tr>
				<tr>
                    <td>Course code : <?php echo $post['course_code']; ?></td>
  
                </tr>
				<tr>
					<td>Description : <?php echo $post['course_des']; ?> </td>
				</tr>
				<tr>
					<td>
						<a class="btn btn-success" href="#">Download</a>
                        <a class="btn btn-warning" href="#">Comment</a>
					</td>
				</tr>
            </tbody>
        </table>
        <br>
        <?php echo "<br>" ?>
        
    </div>
    <?php } ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>