<?php

class Challenge extends Base{
	public $name;
	public $description;
	public $skills;


	public function __construct ($name, $description,$skills){
		$this->name = $name;
		$this->description = $description;
		$this->skills = $skills;
	}

	public function playChallenge(&$allPlayers) {
		$winners = array();

		$winners = rsort($this->skills);

		//using $this->skills
		//0 find player with best chance
		//1 then player with second best chance
		//2 then player with least change

		return $winners;
	}

}

