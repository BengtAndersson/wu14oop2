<?php

include_once("nodebite-swiss-army-oop.php");

$ds = New DBObjectSaver(array(
	"host" => "127.0.0.1",
	"dbname" => "theBox",
	"username" => "root",
	"password" => "mysql",
	"prefix" => "theBox",
	));


$companion_index = isset($_REQUEST["companionIndex"]) ? $_REQUEST["companionIndex"] : false;

if (count($ds->players) < 2) {
  echo(json_encode(false));
  exit;
}



//Play the challange

$human_player = $ds->players[0];

if ($companion_index !== false && count($ds->players) > 2) {
  $companion_index = $companion_index/1;
  $companion = $ds->players[$companion_index];
  $opponent = count($ds->players) - $companion_index;
//If companion choosen lose 5 p
  $human_player->success -= 5;
  $companion->success -= 5;

  //create a new team
  $players = array();
  $players[] = New Team($human_player, $companion);
  //then add the opponent
  $players[] = $opponent;

  //and do the challenge
  $result = $human_player->carryOutChallengeWithFriend($ds->current_challenge[0], $human_player, $companion, $opponent);

  //who first etc.
  $winner = $result[0];
  $last = $result[count($result)-1];

  //if the team won or not
  if (get_class($winner) == "Team") {
    //Team winners get 9 points
    $human_player->success += 9;
    $companion->success += 9;

    //loser loses 5 points and a random tool
    $opponent->success -= 5;
    $opponent->loseRandomTool($ds->available_tools);
  } else {
    //Solo winners get 15 points
    $winner->success += 15;

    //losers lose 5 points and a random tool each
    $human_player->success -= 5;
    $human_player->loseRandomTool($ds->available_tools);
    $companion->success -= 5;
    $companion->loseRandomTool($ds->available_tools);
  }
} else {
  //PLAY CHALLENGE
  $result = $human_player->carryOutChallenge($ds->current_challenge[0], $ds->players);

  //who is first etc.
  $winner = $result[0];
  $last = $result[count($result)-1];

  //winner gets 15 points
  $winner->success += 15;

  //third lose 5 points and a random tool
  $last->success -= 5;
  $last->loseRandomTool($ds->available_tools);
}


//data to echo back to frontend
$echo_data = array(
  "result" => $result,
  "playing" => $ds->players,
);

echo(json_encode($echo_data));