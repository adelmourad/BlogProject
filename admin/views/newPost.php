<div class="mycontainer">
    <form method="post">
        <h2>Create a new post</h2>
        <label>Title</label>
        <input type="text" name="title" placeholder="Enter The Title" value="<?=isset($title)?$title:""?>">

        <label>Body</label>
        <textarea  name="body" placeholder="Enter your message"><?=isset($body)?$body:""?></textarea>

        <label>Author</label>
        <select name="author"><?=isset($authors)?$authors:""?></select>

        <input type="submit" value="Post Now">
        <p style="color:<?=isset($color)?$color:""?>;"><?=isset($status)?$status:""?></p>
    </form>
</div>