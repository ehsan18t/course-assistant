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
                $fileDestination = INC_DIR['uploads'].$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $conn->query("UPDATE users SET profile_pic_url = '". DIR['uploads'].$fileNameNew . "' WHERE email = '". $_SESSION['email'] ."'");
                header("Location: " . PAGES['profile']);
                unlink(INC_DIR['uploads'] . str_replace(DIR['uploads'], "", $user_data['profile_pic_url']));
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
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS['styles.css'] ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
