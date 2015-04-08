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


		for ($i=0; $i < count($allPlayers); $i++) {
			$playerSkillPercentages = array();
			foreach ($this->skills as $skillName => $challengeSkillPoints) {
				$playerSkillPoints = $allPlayers[$i]->{$skillName};

				$playerSkillPrecent = $playerSkillPoints >= $challengeSkillPoints ? 1 : $playerSkillPoints/$challengeSkillPoints;

				$playerSkillPercentages[] = $playerSkillPrecent;

			}
			$playerTotalSkill = array_sum($playerSkillPercentages) / count($playerSkillPercentages);

			var_dump($winners);
			if(count($winners) === 0 || $winners[0]["points"] >= $playerTotalSkill ){
				var_dump("banan1");
				if (count($winners) < 1) {
					$winners[] = array(
						"points" => $playerTotalSkill,
						"player" => &$allPlayers[$i],
					);
				} else {
					$winners = array_unshift($winners, array(
						"points" => $playerTotalSkill,
						"player" => &$allPlayers[$i],
					));
				}
			}
			elseif ($winners[0]["points"] < $playerTotalSkill || $winners[count($winners)-1]["points"] >= $playerTotalSkill ){
				var_dump("banan2");
				if (count($winners) < 2) {
					$winners[] = array(
						"points" => $playerTotalSkill,
						"player" => &$allPlayers[$i],
					);
				} else {
					$winners = array_splice($winners, 1, 0, array(
						"points" => $playerTotalSkill,
						"player" => &$allPlayers[$i],
					));
				}
			}
			elseif ($winners[count($winners)-1]["points"] < $playerTotalSkill ) {
				# code...
				var_dump("banan3");
				$winners[] = array(
					"points" => $playerTotalSkill,
					"player" => &$allPlayers[$i],
				);
			}
		}


		//$winners = rsort($this->skills);

		//using $this->skills
		//0 find player with best chance
		//1 then player with second best chance
		//2 then player with least change

		return $winners;
	}

}

