<div class="mycontainer">
    <form method="post" action="updatePost.php">
        <h2>Create a new post</h2>
        <label>Title</label>
        <input type="text" name="title" placeholder="Enter The Title" value="<?=isset($title)?$title:""?>">

        <label>Body</label>
        <textarea  name="body" placeholder="Enter your message"><?=isset($body)?$body:""?></textarea>

        <label>Author</label>
        <select name="author">
            <?=isset($authors)?$authors:""?>
        </select>

        <input type="text" name="id" value="<?=isset($id)?$id:""?>" style="display:none">

        <input type="submit" value="Update">
        <p style="color:<?=isset($color)?$color:""?>;"><?=isset($status)?$status:""?></p>
    </form>
</div>