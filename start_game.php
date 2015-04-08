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
		$playerClass = "BillWoodpecker";

		
	//echo(json_encode(false));
	//exit();
}

$players = array();

$players[] = new $playerClass($playerName);

$playerClasses = array("BillWoodpecker", "JaneStickyFinger", "TedSquirrel");


for ($i=0; $i < count($playerClasses); $i++) { 
	if ($playerClasses[$i] == $playerClass) { continue; }
	$players[] = new $playerClasses[$i]("bot".$i);
}
$ds-> players =$players;

$challangeData = array(
	"Kaknästornet"=> array(
		"description"=> "Svårjobbad yta",
		"skills"=> array(
			"strength"=> 40,
			"will" => 30,
		),
	),
);

$challanges = array();
foreach ($challangeData as $name => $values) {
	$challanges[] = new Challenge($name, $values["description"], $values["skills"]);
	# code...
}
//Tools array and loop ---------------------------------------------------------------------
$toolsData = array(
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