<?php namespace blog;
require "connect.php";

$results = get($handler,"posts");
if(!empty($results))
    $results = fetchAssoc2HtmlTable($results);
else
{
    $results="no posts are inserted";
}


$asPosts= get($handler,"posts");
if(!empty($asPosts))
{
    $post_list="";
    foreach ($asPosts as $post)
    {
        $post_list.= "<a href=single.php?id=$post[id]><h3>".$post['title'].'</h3></a>';
        $post_list.= '<p>'.$post['body'].'</p>';
        $post_list.= '<br/>';
    }
}
else
{
    $post_list="no posts are inserted";
}
view("posts.view.php","posts-view.css",["results"=>$results,"post_list"=>$post_list]);
?>