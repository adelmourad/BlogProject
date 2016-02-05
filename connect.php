<?php namespace blog;
require "config.php";
require "functions.php";

$handler = connect($config);
if(!$handler)
    exit("Could not connect to the database");
?>