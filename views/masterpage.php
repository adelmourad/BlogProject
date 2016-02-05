<!doctype html>
<html>
<head>
    <title>Registeration Form</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/masterpage.css" />
    <link rel="icon" type="image/png" href="images/icon.png" />

    <!--View Information-->
    <?=   isset($css)?"<link rel='stylesheet'  href='$css' />":""   ?>

</head>
<body>
<div class="header" >
    Welcome to My Web Site
</div>
<div class="navbar">
    <ul>
        <li><a href="index.php">Home Page</a></li>
        <li><a href="posts.php">View Posts</a></li>
        <li><a href="admin/index.php">Admin Area</a></li>
        <li><a href="#">Register</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">About Us</a></li>
    </ul>
</div>
<!--------------------------Content-------------------------->

                 <?php require($content); ?>

<!-------------------------End Content------------------------->
<div class="footer">
    Copyright &copy; 2016 All Rights Reserved to &reg; Adel
</div>
</body>
</html>