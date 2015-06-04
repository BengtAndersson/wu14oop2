<?php

include_once("nodebite-swiss-army-oop.php");

$ds = New DBObjectSaver(array(
	"host" => "127.0.0.1",
	"dbname" => "theBox",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "theBox",
	));


$chosen_companion = $_REQUEST["chosen_companion"];
$player = $ds->players[0];
$computer_player = $ds->computer_player;
if (isset($chosen_companion)) {
  $chosen_companion = $chosen_companion/1;
  $chosen_companion = $computer_player[$chosen_companion];
  $team = New Team ("Team", $player, $chosen_companion);
  $opponent = $computer_player[1-$chosen_companion];
  $members = array($team, $opponent);
  $result = $player->carryOutChallenge($ds->ongoing_challenge[0], $members);
} else {
  $members = array($player, $computer_player[0], $computer_player[1]);
  $result = $player->carryOutChallenge($ds->ongoing_challenge[0], $members);
}  
  $winner = $result[0];  
  $last = $result[count($result)-1];
  //winner gets 15 points
  $winner->success += 15;  
  //third lose 5 points and a random tool  
  $last->success -= 5;  

//data to echo back to frontend
$echo_data = array(
  "result" => $result,
  "playing" => $ds->players,
);

echo(json_encode($echo_data));