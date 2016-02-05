<?php namespace blog;
require "../connect.php";

if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['id']))
{
    if ($post = get_by_id($handler,"posts", $_GET['id']))
    {
        query($handler,"delete from posts where id=$_GET[id]");
        header("location:index.php");
    }
    else
    {
        echo "post not found";
        header("location:index.php");
    }
}

?>