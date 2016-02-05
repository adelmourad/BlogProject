<?php namespace blog;
require "../connect.php";

# post form this page is coming from the delete selected posts only
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    foreach($_POST as $name=>$value)
    {
        if(is_numeric($name))
        {
            query($handler,"delete from posts where id =:id",["id"=>$value]);
        }
    }
}

# if the page is not posted then just list the latest recent posts
$posts = query($handler,"select * from posts limit 10");
$posts=$posts->fetchAll(\PDO::FETCH_ASSOC);

# preparing a table of posts for the view file
$table = <<<EOT
<table>
    <thead>
        <td></td>
        <td>ID</td>
        <td>Title</td>
        <td>Body</td>
        <td>Author ID</td>
        <td>Controls</td>
    </thead>
EOT;

foreach ($posts as $post)
{
    $table .= <<<EOT
    <tr>
        <td><input type="checkbox" name="$post[id]" value="$post[id]"></td>
        <td>$post[id]</td>
        <td>$post[title]</td>
        <td>$post[body]</td>
        <td>$post[author]</td>
        <td>
            <a href="delete.php?id=$post[id]"><img src="images/delete.png" title="Delete Post"></a>
            <a href="updatePost.php?id=$post[id]"><img src="images/edit.png" title="Edit Post"></a>
        </td>
    </tr>
EOT;
}
$table .= "</table>";

# including the view and passing the required data for it
view("index.php","index.css",["table"=>$table]);
?>