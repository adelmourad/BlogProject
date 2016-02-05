<!doctype html>
<html>
<head>
    <title>Control Panel</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/masterpage.css" />
    <link rel="icon" type="image/png" href="images/icon.png" />

    <!--View Information-->
    <?=   isset($css)?"<link rel='stylesheet'  href='$css' />":""   ?>
</head>
<body>
    <div class="container">
        <div class="header" >
            Admin Area | Control Panel
        </div>
        <div class="navbar">
            <ul>
                <!--paths are relative to the calling file -->
                <li><a href="index.php#">Edit Posts</a></li>
                <li><a href="newPost.php">New Post</a></li>
                <li><a href="#">New Admin</a></li>
                <li><a href="../index.php">Back</a></li>
            </ul>
        </div>
        <!--------------------------Content-------------------------->

        <? isset($content)?require($content):""; ?>

        <!-------------------------End Content------------------------->
        <div class="footer">
            Copyright &copy; 2016 All Rights Reserved to &reg; Adel
        </div>
    </div>
</body>
</html>