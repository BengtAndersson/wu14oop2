<?php
include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "theBox",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "theBox",
));

unset($ds->players);
unset($ds->challenges);
unset($ds->tools);
unset($ds->current_challenge);

if (isset($_REQUEST["playerName"]) && isset($_REQUEST["playerClass"])) {
	$playerName = $_REQUEST["playerName"];
	$playerClass = $_REQUEST["playerClass"];
	} 
	else {
		$playerName = "Bengt";
		$playerClass = "Woodpecker";

		
	//echo(json_encode(false));
	//exit();
}

$players = array();

$players[] = new $playerClass($playerName);

$playerClasses = array("Woodpecker", "Monkey", "Squirell");


for ($i=0; $i < count($playerClasses); $i++) { 
	if ($playerClasses[$i] == $playerClass) { continue; }
	$players[] = new $playerClasses[$i]("bot".$i);
}
$ds-> players =$players;

$challangeData = array(
	"Kaknästornet"=> array(
		"description"=> "Stockholm, 155m, Hinder högt upp",
		"skills"=> array(
			"strength"=> 40,
			"will" => 30,
		),
	),
	"Turning Torso"=> array(
		"description"=> "Malmö, 190,4m, Svårjobbad yta",
		"skills"=> array(
			"strength"=> 40,
			"will" => 30,
		),
	),
	"Uppsala domkyrka"=> array(
		"description"=> "Uppsala, 118,7m, Hal kopparbeläggning",
		"skills"=> array(
			"strength"=> 40,
			"will" => 30,
		),
	),

);

$challanges = array();
foreach ($challangeData as $name => $values) {
	$challanges[] = new Challenge($name, $values["description"], $values["skills"]);
	
}
//Tools array and loop ---------------------------------------------------------------------
$toolsData = array(
	"Handbollsklister"=> array(
		"description" => "Ger dig bättre fäste",
		"skills"=> array(
			"speed"=> 5,
			"health" => 2,
		),
	),
	"Spikskor"=> array(
		"description" => "Ger dig överlägsen snabbhet på porösa material",
		"skills"=> array(
			"speed"=> 5,
			"health" => 2,
		),
	),
	"Handbollsklister"=> array(
		"description" => "Ger dig bättre fäste",
		"skills"=> array(
			"strength"=> 5,
			"health" => 2,
		),
	),
	"Handbollsklister"=> array(
		"description" => "Ger dig bättre fäste",
		"skills"=> array(
			"strength"=> 5,
			"health" => 2,
		),
	),

);
$toolsArr = array();
foreach ($toolsData as $name => $values){
	$toolsArr[] = new Tool($name, $values["description"], $values["skills"]);
}

//Saving objects to database
$ds -> tools = $toolsArr;
$ds -> challenges = $challanges;


//$challenges = new Challenge("Jeson", "Bobo");
//$tools = new Tool("Voine", "Grabba");
//$character = new Character("Sten");	

echo(json_encode(true));