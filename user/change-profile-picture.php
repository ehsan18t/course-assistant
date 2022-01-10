<?php
include_once '../header.php';

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
                unlink($_SESSION['profile_pic_url']);

                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = INC_DIR['uploads'].$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $conn->query("UPDATE users SET profile_pic_url = '". DIR['uploads'].$fileNameNew . "' WHERE email = '". $_SESSION['email'] ."'");
                header("Location: " . PROFILE_PAGE);
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
        require_once TEM_NAV_MAIN;
        require_once TEM_NAV_LOGGED;
    ?>


    <form action="change-profile-picture.php" method="POST" enctype="multipart/form-data" >
        <div class="content">
            <input type="file" name="file" id="file">
        </div>
        <button type="submit" name="submit" class="btn-register">Upload</button>
    </form>
</body>
