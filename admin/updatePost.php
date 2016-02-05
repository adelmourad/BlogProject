<?php namespace blog;
require "../connect.php";

# on scrip GET =show post details to edit
# make sure there is an id attached to the get requrest / url
if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['id']))
{
    #make sure it is a valid id for an existing post
    if ($post = get_by_id($handler,"posts", $_GET['id']))
    {
        # collect post info and fill them in the view
        $id=$_GET['id'];
        $title = $post['title'];
        $body = $post['body'];
        $authors = get_authors_options($post['author']);

        view("updatePost.php", "updatePost.css", ["title" => $title, "body" => $body,"id"=>$id,"authors"=>$authors]);
    }
    else
        header("location:index.php");
}

# on script POST = save the edits to the db
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(empty($_POST['title']) || empty($_POST['body']) || !isset($_POST['author']))
    {
        $status="Fill both title and body first";
        $color="red";
    }
    else
    {
        if(query($handler,"update posts set title=:t,body=:b,author=:a where id=:id",[":t"=>$_POST['title'],":b"=>$_POST['body'],":id"=>$_POST['id'],":a"=>$_POST['author']]))
        {
            $status = "post is updated";
            $color = "green";
        }
        else
        {
            $status ="an error has occurred";
            $color="red";
        }
    }
    $authors = get_authors_options($_POST['author']);
    view("updatePost.php", "newPost.css",
        [
            "title" => $_POST['title'],
            "body" => $_POST['body'],
            "id"=>$_POST['id'],
            "authors"=>$authors,
            "status"=>$status,
            "color"=>$color
        ]);
}



?>



