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
unset($ds->computer_player);
unset($ds->tools);
unset($ds->challenges);
$players = &$ds->players;
$computer_player = &$ds->computer_player;
$tools = &$ds->tools;
$challenges = &$ds->challenges;

if (isset($_REQUEST["playerName"]) && isset($_REQUEST["playerClass"])) {
	$create_player = $_REQUEST["playerName"];
  	$create_class = $_REQUEST["playerClass"];
  	$new_player = New $create_class($create_player);
  	$players[] = &$new_player;
	} 
else {
	$playerName = "Bengt";
	$playerClass = "Woodpecker";

	//echo(json_encode(false));
	//exit();
}
$all_classes = array("Monkey", "Squirrel", "Woodpecker");
$random_class = $create_class;
while ($create_class == $random_class) {
	$randomIndex = rand(0, count($all_classes) - 1);
	$random_class = $all_classes[$randomIndex];
}
$humanName = array(
      "Bob",
      "Leon",
      "John"
    );
    $random_human_name = mt_rand(0,2);
    $computer_player[] = New $random_class($humanName[$random_human_name]);
	$random_class2 = $random_class;
while ($create_class == $random_class || $random_class2 == $random_class) {
	$randomIndex = rand(0, count($all_classes) - 1);
	$random_class2 = $all_classes[$randomIndex];
}
$humanName = array(
      "Jessica",
      "Tilde",
      "Caren"
    );
$random_human_name = mt_rand(0,2);
$computer_player[] = New $random_class2($humanName[$random_human_name]);

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
$created_tools = array();
foreach ($toolsData as $name => $values){
	$created_tools[] = new Tool($name, $values["description"], $values["skills"]);
}
$challanges = array();
foreach ($challangeData as $name => $values) {
	$challanges[] = new Challenge($name, $values["description"], $values["skills"]);
}


echo(json_encode(array($ds->players)));

//min
//echo(json_encode($ds->players[0]));



//create virtual player
/*$available_classes = array("Woodpecker", "Squirell", "Monkey");
for ($i=0; $i < count($available_classes); $i++) { 
  if ($available_classes[$i] != $playerClass) {
    $ds->players[] = $available_classes[$i];
  }
}*/


// Create a new instance of the player subclass that the user has chosen
// and at this instance to the database
/*
$ds->players[] = new $playerClass($playerName);

var_dump($ds->players);
die();

*/
/*
OM  WoodPecker != Monkey  SÅ addera till arrayen $ds-players itemen WoodPecker GÖRS

OM  Squirell != Monkey  SÅ addera till arrayen $ds-players itemen Squirell GÖRS

OM  Monkey != Monkey  SÅ addera till arrayen $ds-players itemen Monkey .... GÖRS INTE
*/
/*

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