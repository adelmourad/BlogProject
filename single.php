<?php namespace blog;
require "connect.php";

if(!empty($_GET['id']))
{
    $get=get_by_id($handler,"posts",$_GET['id']);
    $single= "<h3>".$get['title'].'</h3>';
    $single.= '<p>'.$get['body'].'</p>';
    $single.= '<p><i>Author id is :'.$get['author'].'</i></p>';
    view("single.view.php","single.css",["singlePost"=>$single]);
}
else
{
    header("location:index.php");
}
?>