<?php

include_once("nodebite-swiss-army-oop.php");

$dbo = New DBObjectSaver(array(
	"host" => "127.0.0.1",
	"dbname" => "theBox",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "theBox",
	));

$teamUp = isset($_REQUEST["teamUp"]) ? $_REQUEST["teamUp"] : exit();

$current_challenge = &$dbo->current_challenge[0];
$players = &$dbo->players;
$tools = &$dbo->tools;

// $winner = $result[0];
// $last = $result[count($result)-1]

if ($teamUp){
	$THE_WINNER = $players[0]->carryout_challenge_with_companion($current_challenge, $players, $tools);
} else {
	$THE_WINNER = $players[0]->carryout_challenge($current_challenge, $players, $tools);
}

echo(json_encode($THE_WINNER));