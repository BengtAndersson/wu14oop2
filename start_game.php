<?php
include_once("nodebite-swiss-army-oop.php");

$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "wu14oop2",
));

//Empty old data
unset($ds->players);
unset($ds->have_won);
unset($ds->have_lost);
unset($ds->challenges);
unset($ds->available_tools);


$player_name = "SuperPlayer";
$player_class = "Squirrel";




$ds->players[] = New $player_class($player_name, $ds);

//Create random player
$available_classes = array("Squirrel", "Monkey", "Woodpecker");
for ($i=0; $i < count($available_classes); $i++) { 
  if ($available_classes[$i] != $player_class) {
    $ds->players[] = New $available_classes[$i]("VirtualPlayer".$i, $ds);
  }
}


//Array of tools
$tool_properties = array(
  array(
    "description" => "Handbollsklister",
    "skills" => array(
      "speed" => 20,
    ),
  ),
  array(
    "description" => "Spikskor",
    "skills" => array(
      "speed" => 30,
    ),
  ),
  array(
    "description" => "Red bull",
    "skills" => array(
      "stamina" => 10,
    ),
  ),
  array(
    "description" => "Super honey",
    "skills" => array(
      "strength" => 20,
    ),
  ),
  array(
    "description" => "Threat",
    "skills" => array(
      "speed" => 20,
      "will" => 20,
      "stamina" => 20,
      "strength" => 20,
    ),
  ),
);


function occurence_of($value, $array) {
  $count = 0;
  for ($i=0; $i < count($array); $i++) { 
    if ($value === $array[$i]) {
      $count++;
    }
  }
  return $count;
}


$created_tools = array();

//Create random tools
while(count($ds->available_tools) < 9) {
  $random_tool = $tool_properties[rand(0, count($tool_properties)-1)];

  if (occurence_of($random_tool, $created_tools) < 2) {

    $ds->available_tools[] = New Tool($random_tool);
  }
}


//Create challenges

$ds->challenges[] = new Challenge(
  "Kaknästornet. ".
  "Stockholm, 155m . ".
  "Hinder högt upp.",
  array(
    "strength" => 0,
    "will" => 30,
    "stamina" => 70,
    "speed" => 50
  )
);

$ds->challenges[] = new Challenge(
  "Turning Torso. ".
  "Malmö, 190,4m. ".
  "Mycket svårjobbad yta.",
  array(
    "strength" => 60,
    "will" => 60,
    "stamina" => 40,
    "speed" => 50
  )
);

$ds->challenges[] = new Challenge(
  "Uppsala domkyrka. ".
  "Uppsala, 118,7m. ".
  "Hal kopparbeläggning.",
  array(
    "strength" => 80,
    "will" => 0,
    "stamina" => 20,
    "speed" => 10
  )
);

$ds->challenges[] = new Challenge(
  "Victoria Tower. ".
  "Stockholm, 120m. ".
  "Enformig, svårjobbad yta.",
  array(
    "strength" => 50,
    "will" => 0,
    "stamina" => 60,
    "speed" => 80
  )
);

$ds->challenges[] = new Challenge(
  "Kista Science Tower. ".
  "Stockholm, 117,2m.".
  "Lägre hinder i början av klättringen",
  array(
    "strength" => 80,
    "will" => 80,
    "stamina" => 80,
    "speed" => 0
  )
);

echo(json_encode($ds->players[0]));