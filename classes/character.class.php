<?php

class Character extends Base {
  public $name;
	public $success = 50;
  public $level = 1;
  public $tools = array();

  public function __construct($name){
    $this->name = $name;

  }

  public function pickupRandomTool(&$tools) {
   
    if (count($this->tools) < 3) {
      $random_tool_index = rand(0, count($tools)-1);
      $random_tool = $tools[$random_tool_index];
      //pick it up
      $this->tools[] = $random_tool;
      array_splice($tools, $random_tool_index, 1);
    }
  }

  public function loseRandomTool(&$tools) {
   
    if (count($this->tools) > 0) {
      //pick a random tool
      $random_tool = rand(0, count($this->tools)-1);

      //lose the tool      
      $lost_tool = array_splice($this->tools, $random_tool, 1);
      $tools[] = $lost_tool[0];
    }
  }

  public function carryOutChallenge($challenge, $players) {
    //find first winner
    $result = array();
    while (count($players) !== 0) {
      $result[] = $challenge->playChallenge($players);     
      $round_winner_index = array_search($result[count($result)-1], $players);
      array_splice($players, $round_winner_index, 1);
    }

    return $result;
  }

  public function carryOutChallengeWithFriend($challenge, &$players) {
    //return the winners
    return $this->carryOutChallenge($challenge, $players);
  }

}