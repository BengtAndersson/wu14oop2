<?php

class Team extends Character {
  public function __construct($name, $players){
    $this->name = $name;
    for ($i=0; $i < count($players); $i++) { 
      $this->strength += $players[$i]->strength;
      $this->will += $players[$i]->will;
      $this->stamina += $players[$i]->stamina;
      $this->speed += $players[$i]->speed;

      for ($j=0; $j < count($players[$i]->tools); $j++) { 
        $this->tools[] = $players[$i]->tools[$j];
      }
    }
  }
}