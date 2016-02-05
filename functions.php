<?php namespace blog;
require "config.php";

function connect($config) //return PDO Object
{
    try
    {
        @$handler = new \PDO("$config[dbDriver]:host=$config[dbHost];dbname=$config[dbName]",$config['dbUserName'],$config['dbPassword']);
        $handler->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        return $handler;
    }
    catch(\PDOException $e)
    {
       \file_put_contents($config['dbConnErrorDump'],$e->getMessage()."\n",FILE_APPEND);
        return false;
    }
}

function get($handler,$table,$limit=10,$die=true)
{
    try
    {
        $query =$handler->query("select * from $table  DES limit $limit;");
        $results = $query ->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }
    catch (\PDOException $e)
    {
        global $config;
        \file_put_contents($config['dbQureyErrorDump'],$e->getMessage()."\n",FILE_APPEND);
        if($die)
            exit("An Error Has Occurred");
        return false;
    }
}

function fetchAssoc2HtmlTable($results) //accept result oject from fetchAll(\PDO::FETCH_ASSOC)
{
    $table="<table>";
    $assoc_keys=[];

//Heading the table---------------------------------------------------------------
    $table.= "<thead>";
    while ($field = current($results[0]))
    {
        $assoc_keys[]=key($results[0]);
        $table.= '<td>'.key($results[0]).'</td>';
        next($results[0]);
    }
    $table.="</thead>";

//Filling the results------------------------------------------------------------
    for($i=0; $i<count($results); $i++)
    {
        $table.= "<tr>";
        for($j=0; $j<count($assoc_keys); $j++)
        {
            $table.='<td>'.$results[$i][$assoc_keys[$j]].'</td>';
        }
        $table.= "</tr>";
    }
    $table.="<table>";
    return $table;
}

/*
$content is included using php required method
$css     is included using html link tag
$content path is then RELATED to the CALLING  FILE = The (masterpage)
$css     path is then RELATED to the CALLING FILE = The (controller/model)
------------------------------------------------------------------------
$data : send all the required variables to the view as an associative array. it will be extracted like extract($data)
example view("posts.view.php","posts-view.css",["results"=>$results,"post_list"=>$post_list]);
add more args to include more files to the master later / multiple css + js +...etc
*/
function view ($content,$css="",$data=[],$master="views/masterpage.php")
{
    ////اذا كان الفيو نفس اسم الكنترولر راح يلخبط الكومبايلر اذا بدو يعمل ركوير للملف الجاري تنفيذ تاني ام للملف الريلتف للجاري استدعائه .. الاتفراضي راح يعيد استدعاء حاله ويعملك فاتل ايرور
    $content="views/".$content;

    if(!empty($css))
        $css="css/".$css;

    if(!empty($data))
        extract($data);

    require $master;
}

/* test on
$res=
    [
        [
            "title"=>"post 1",
            "body"=>"post  1 body"
        ],
        [
            "title"=>"post 2",
            "body"=>"post  2 body"
        ],
        [
            "title"=>"post 3",
            "body"=>"post  3 body"
        ]
    ];

echo $res[1]['title'];*/

function get_by_id($handler,$table,$id,$die=true)
{
    try
    {
        $prep = $handler -> prepare("select * from $table where id=:id limit 1;");
        $prep->execute([":id"=>$id]);
        return $prep->fetchAll(\PDO::FETCH_ASSOC)[0]; //skip the wrapping array
    }
    catch(\PDOException $e)
    {
        global $config;
        \file_put_contents($config['dbQureyErrorDump'],$e->getMessage()."\n",FILE_APPEND);
        if($die)
            exit("An Error Has Occurred");
        return false;
    }

}

function query($handler,$query,$bindings=[],$die=true)
{
    try
    {
        $pdo=$handler;
        if(!empty($bindings))
        {
            $prep=$pdo->prepare($query);
            return $prep->execute($bindings);
        }
        return $pdo->query($query);
    }
    catch(\PDOException $e)
    {
        global $config;
        \file_put_contents($config['dbQureyErrorDump'],$e->getMessage()."\n",FILE_APPEND);
        if($die)
            exit("An Error Has Occurred");
        return false;
    }
}

function get_authors_options($selectedAuthID="")
{
    global  $handler;
    $options="<option selected disabled>Select an author</option>";

    if($authors = query($handler,"select * from author"))
    {
        $authors=$authors->fetchAll(\PDO::FETCH_ASSOC);
        foreach($authors as $author)
        {
            $isSelected="";
            if($author['id']==$selectedAuthID)
                $isSelected="selected";

            $options.="<option value='$author[id]' $isSelected>$author[name]</option>";
        }
    }
    return $options;
}