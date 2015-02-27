<?php
include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "theBox",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "theBox",
));