<?php

class TedSquirrel extends Character
{
	public $success = 50;
	public $strength = 40;
	public $will = 20;
	public $health = 30;
	public $speed = 60;
	public $tools = array();


  public function __construct($name){
     $this->name = $name;
  }
	



}