<?php
include_once '../header.php';
$user_data = check_login($conn);

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 100000000) {
               
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = INC_DIR['picture'].$fileNameNew;
                echo  $fileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                $conn->query("UPDATE users SET profile_pic_url = '" . $fileNameNew . "' WHERE email = '". $_SESSION['email'] ."'");
                header("Location: " . PAGES['profile']);
                unlink(INC_DIR['picture'] . $user_data['profile_pic_url']);
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}

?>

<title>Change Profile Picture</title>
</head>

<body>
    <?php
        require_once INCLUDES['nav-main-template'];
        require_once INCLUDES['nav-logged-template'];
    ?>


    <form action="change-profile-picture.php" method="POST" enctype="multipart/form-data" >
        <div class="content">
            <input type="file" name="file" id="file">
        </div>
        <button type="submit" name="submit" class="btn-register">Upload</button>
    </form>
</body>
