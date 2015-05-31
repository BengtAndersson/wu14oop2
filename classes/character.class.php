<?php

class Character extends Base
{
	public $success = 50;
  public $strength = 0;
  public $will = 0;
  public $health = 0;
  public $speed = 0;
  public $tools = array();

  public function __construct($name){
    $this->name = $name;

  }

  // here we decide how many points you get when you win, and when you lose
  public function carryout_challenge($current_challenge, &$players, &$tools){
  	for ($i=0; $i < count($players); $i++) { 
  		$players[$i]->pickup_tool($tools);
  	}
    $winner = $current_challenge->playChallenge($players);
    $winner[0]["player"]->success += 15;
    $winner[count($winner)-1]["player"]->success -= 5;
    $winner[count($winner)-1]["player"]->lose_tool($tools);

    return $winner[0]["player"];
  }
  // here we add challenge with a companion
  public function carryout_challenge_with_companion($current_challenge, &$players, &$tools){
  	for ($i=0; $i < count($players); $i++) { 
  		$players[$i]->pickup_tool($tools);
  	}
    $new_players = array();
    $players[0]->success -= 5;
    $players[1]->success -= 5;
    $new_players[] = New Team("Team1", array($players[0], $players[1]));
    $new_players[] = $players[2];
    $winner = $current_challenge->playChallenge($new_players);

    // special conditions if we win as the team
    if (get_class($winners[0]) == "Team") {
      $players[0]->success += 9;
      $players[1]->success += 9;
      $players[2]->success -= 5;
      $players[2]->lose_tool($tools);
    } else {
      $players[0]->success -= 5;
      $players[1]->success -= 5;
      $players[2]->success += 15;
      $players[2]->lose_tool($tools);
    }


    return $winner[0]["player"];
  }

  // let's enable for us to pick up some tools 
  public function pickup_tool(&$tools){
    //if you have less than 3, you can pick up a tool
    if (count($this->tools) < 3 && $tools){
      $new_tool = array_shift($tools);

      foreach ($new_tool->skills as $skillName => $skillValue) {
        $this->{$skillName} += $skillValue;
      }

      $this->tools[] = $new_tool;
    }
  }
  // and here is how to lose a tool
  public function lose_tool(&$tools){
    // if we have anything at all, remove it and put it back in $tools
    if (count($this->tools) > 0) {
      $lost_tool = array_shift($this->tools);

      foreach ($lost_tool->skills as $skillName => $skillValue) {
        $this->{$skillName} -= $skillValue;
      }

      $tools[] = $lost_tool;
    }
  }
}
