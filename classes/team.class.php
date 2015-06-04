<?php

class Team extends Character {

  public $members = array();
/*
  public $strength;
  public $will;
  public $stamina;
  public $speed;
  public $tools = array();
*/
  
  public function __construct($name, $humanPlayer, $computerPlayer) {
    $this->members[] = $humanPlayer;
    $this->members[] = $computerPlayer;

    // sum the point to each player
    $this->strength = $humanPlayer->strength + $computerPlayer->strength;
    $this->will = $humanPlayer->will + $computerPlayer->will;
    $this->stamina = $humanPlayer->stamina + $computerPlayer->stamina;
    $this->speed = $humanPlayer->speed + $computerPlayer->speed;

    //adding tools to the team
    $this->tools = $humanPlayer->tools;

    //call the parent class __construct   (Player) to set name of team
    parent::__construct($name);
  }


}