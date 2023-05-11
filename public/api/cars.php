<?php
header('Content-Type: application/json; charset=utf-8');
$db = new SQLite3('/var/www/html/db/kikocars.db');
$carsResult = $db->query('SELECT * FROM CARS');
$carArray = array();
while($row = $carsResult->fetchArray(SQLITE3_ASSOC)) {
    array_push($carArray, $row);
}
$carjson = json_encode($carArray);
if(empty($_GET['php']))://an sto GET evala mia php oti na 'nai, apla ase na uparxei h metavlhth
    echo $carjson; //moiazei me carl johnson, ton prwtagwnisth tou san andreas
endif;
?>