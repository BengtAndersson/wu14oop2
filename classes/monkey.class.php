<?php

class Monkey extends Character
{
	public $success = 50;
	public $strength = 50;
	public $will = 60;
	public $health = 30;
	public $speed = 20;
	public $tools = array();


  public function __construct($name){
     $this->name = $name;
  }
	



}