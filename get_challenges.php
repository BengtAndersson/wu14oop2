<?php
include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "theBox",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "theBox",
));

$latestChallenge = $_REQUEST["getChallenge"];

$randomChallenge = $latestChallenge;
  while ($randomChallenge== $latestChallenge) {
    $randomChallenge = rand(0, count($ds->challenges)-1);
  }

unset($ds->ongoing_challenge);

$ds->ongoing_challenge[] = $ds->challenges[$randomChallenge];

echo(json_encode($ds->ongoing_challenge[0]));