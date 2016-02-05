<?php namespace blog;
require "../connect.php";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(empty($_POST['title']) || empty($_POST['body']) || !isset($_POST['author']) )
    {
        $status="Fill All Fields First";
        $color="red";
    }
    else
    {
        $res=query($handler,"insert into posts (title,body,author) VALUE (:t,:b,:a)",[":t"=>$_POST['title'],":b"=>$_POST['body'],":a"=>$_POST['author']],false);
        if(!$res)
        {
            $status="An Error Has Occurred with the DB";
            $color="red";
        }
        else
        {
            $status="The new post is inserted";
            $color="green";
        }
    }
    # if the form is posted .. load it with it's fields filled with previous valid/non-valid data
    view("newPost.php","newPost.css",
        [
            "status"=>$status,
            "color"=>$color,
            "title"=>$_POST['title'],
            "body"=>$_POST['body'],
            "authors"=>get_authors_options(isset($_POST['author'])?$_POST['author']:"")
        ]);
}
else
{
    # if the form is not posted .. load it empty
    view("newPost.php","newPost.css",["authors"=>get_authors_options()]);
}
?>