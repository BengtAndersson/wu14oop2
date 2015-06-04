<?php

class Character extends Base {
  public $name;
	public $success = 50;
  public $level = 1;
  public $tools = array();

  public function __construct($name){
    $this->name = $name;

  }

  public function acceptChallenge($challenge, $players) {
    return $this->name. " har antagit utmaningen: ".$challenge->description."! ".
    "<br>".
    $this->name." får nu bestämma om han ska göra den själv eller i team. "; 
  }  
  public function carryOutChallenge($challenge, $players) {
    $result = array();
    while (count($players) !== 0) {
      $result[] = $challenge->playChallenge($players);      
      $round_winner_index = array_search($result[count($result)-1], $players);
      array_splice($players, $round_winner_index, 1);
    }
    return $result;
  }
}