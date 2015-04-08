<?php

class Tool extends Base
{
	public $name;
	public $description;
  	public $skills;

  public function __construct($name, $description, $skills) {
  	$this->name = $name;
  	$this->description = $description;
    $this->skills = $skills;

  }


}