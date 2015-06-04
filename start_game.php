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
unset($ds->have_won);
unset($ds->have_lost);
unset($ds->challenges);
unset($ds->available_tools);
unset($ds->theBox_players);
unset($ds->theBox_available_tools);
//unset($ds->current_challenge);

/*
$player_name = "Bengt Andersson";
$player_class = "Woodpecker";*/

//push human player first to players property
//$ds->players[] = New $player_class($player_name, $ds);

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

//create virtual player
/*$available_classes = array("Woodpecker", "Squirell", "Monkey");
for ($i=0; $i < count($available_classes); $i++) { 
  if ($available_classes[$i] != $playerClass) {
    $ds->players[] = $available_classes[$i];
  }
}*/


// Create a new instance of the player subclass that the user has chosen
// and at this instance to the database

$ds->players[] = new $playerClass($playerName);

var_dump($ds->players);
die();


/*
OM  WoodPecker != Monkey  SÅ addera till arrayen $ds-players itemen WoodPecker GÖRS

OM  Squirell != Monkey  SÅ addera till arrayen $ds-players itemen Squirell GÖRS

OM  Monkey != Monkey  SÅ addera till arrayen $ds-players itemen Monkey .... GÖRS INTE
*/


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
	"Rep"=> array(
		"description" => "Tar dig snabbare upp till toppen",
		"skills"=> array(
			"strength"=> 5,
			"health" => 2,
		),
	),
	"Hacka"=> array(
		"description" => "Ovärderligt hjälpmedel",
		"skills"=> array(
			"strength"=> 5,
			"health" => 2,
		),
	),

);
$created_tools = array();
foreach ($toolsData as $name => $values){
	$created_tools[] = new Tool($name, $values["description"], $values["skills"]);
}

function occurence_of($value, $array) {
  $count = 0;
  for ($i=0; $i < count($array); $i++) { 
    if ($value === $array[$i]) {
      $count++;
    }
  }
  return $count;
}

//$created_tools = array();  ? SECOND TIME

while(count($ds->available_tools) < 9) {
  $random_tool = $tool_properties[rand(0, count($tool_properties)-1)];
 
  if (occurence_of($random_tool, $created_tools) < 2) {
  	$description = "ett farligt vapen";
    $ds->available_tools[] = New Tool($random_tool, $description);
  }
}

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

echo(json_encode($ds->players[0]));

/*
if (isset($_REQUEST["playerName"]) && isset($_REQUEST["playerClass"])) {
	$playerName = $_REQUEST["playerName"];
	$playerClass = $_REQUEST["playerClass"];
	} 
	else {
		$playerName = "Bengt";
		$playerClass = "Woodpecker";

		
	echo(json_encode(false));
	exit();
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
	"Rep"=> array(
		"description" => "Tar dig snabbare upp till toppen",
		"skills"=> array(
			"strength"=> 5,
			"health" => 2,
		),
	),
	"Hacka"=> array(
		"description" => "Ovärderligt hjälpmedel",
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

*/