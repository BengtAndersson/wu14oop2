<?php
include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "theBox",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "theBox",
));

$randomIndex = array_rand($ds->challenges);
$ds->current_challenge[0] = $ds->challenges[$randomIndex];
echo(json_encode($ds->current_challenge));