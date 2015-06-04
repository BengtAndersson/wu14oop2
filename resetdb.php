<?php
include_once("nodebite-swiss-army-oop.php");
$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "theBox",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "theBox",
));


if (isset($_REQUEST["startOver"])) {
  unset($ds->players);
  unset($ds->computer_player);
  unset($ds->tools);
  unset($ds->challenges);
  unset($ds->ongoing_challenge);
}
echo(json_encode(true));