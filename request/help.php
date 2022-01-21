<?php
include_once '../header.php';
$user_data = check_login($conn);
require_once INCLUDES['addRequest-function'];
  $id = 0;
    if(isset($_GET['status'])){
       if($_GET['status']='edit'){
        $i = $_GET['id'];
        $id = $i;
        echo $id;
        // $posts= display_data_by_id($conn,$id);
        // $returndata=mysqli_fetch_assoc($posts);
      }
    }
if(isset($_POST['submit'])){
   // echo "work";
     echo $id;
    $msg = upload_data($conn,$_POST,$id,$user_data);
}

?>

<title>Upload the file</title>
</head>

<body>
    <?php
        require_once INCLUDES['nav-main-template'];
        require_once INCLUDES['nav-logged-template'];
    ?>


    <form action="#" method="POST" enctype="multipart/form-data" >
        <div class="content">
            <input type="file" name="file" id="file" require>
        </div>
        <button type="submit" name="submit" class="btn-register">Upload</button>
    </form>
</body>
