<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
error_reporting(0);

$json_pokedex = file_get_contents('data/pokedex.json');
$data_pokedex = json_decode($json_pokedex, true);

$json_types = file_get_contents('data/types.json');
$data_types = json_decode($json_types, true);

$json_skills = file_get_contents('data/skills.json');
$data_skills = json_decode($json_skills, true);

$response = '{"success":1, "Pokedex_Info":[{';

foreach($data_pokedex as $key=> $value) {

foreach($value as $key2=> $value2) {

if($key2 == 'id') {
$id = addslashes($value2);
}

if($key2 == 'flatName') {
if(!empty($value2)) {
$ename = addslashes($value2);
}
}
elseif($key2 == 'ename') {
$ename = addslashes($value2);
}
elseif($key2 == 'type') {
$type_array = $value2;

foreach($type_array as $type_key => $type_value) {
$type = $type.', '.addslashes($type_value);
$type = ltrim($type, ',');
}

}
elseif($key2 == 'base') {
$base_array = $value2;

foreach($base_array as $base_key => $base_value) {

if($base_key == 'Attack') {
$Attack = $base_value;
}
if($base_key == 'Defense') {
$Defense = $base_value;
}
if($base_key == 'HP') {
$HP = $base_value;
}
if($base_key == 'Sp.Atk') {
$Sp_Atk = $base_value;
}
if($base_key == 'Sp.Def') {
$Sp_Def = $base_value;
}
if($base_key == 'Speed') {
$Speed = $base_value;
}

}

}
else {
}

}
			
			
$string.=  ' "id":"'.$id.'", "ename":"'.$ename.'", "type":"'.$type.'", "Attack":"'.$Attack.'", "Defense":"'.$Defense.'", "HP":"'.$HP.'", "Sp_Atk":"'.$Sp_Atk.'", "Sp_Def":"'.$Sp_Def.'", "Speed":"'.$Speed.'"},{';
$type = '';

}


$string = rtrim($string, "{");
$string = rtrim($string, ",");
	

$response.= $string;
$response.= ']}';		
echo json_encode($response);		
exit();

?>