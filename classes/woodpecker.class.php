<?php

class Woodpecker extends Character
{
	public $name;
	public $strength = 50;
	public $will = 50;
	public $health = 50;
	public $speed = 50;
	public $tools = array();


  public function __construct($name){
     $this->name = $name;
  }
	



}