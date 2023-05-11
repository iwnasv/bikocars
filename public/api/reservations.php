<?php
header('Content-Type: application/json; charset=utf-8');
$db = new SQLite3('/var/www/html/db/kikocars.db');
$key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING) or $key == 'wrong password';
$car = filter_input(INPUT_GET, 'car', FILTER_SANITIZE_NUMBER_INT) or $car == NULL;
if($key  == 'allakse') {
    $statement = 'SELECT * FROM reservations';
} else if(!is_null($car)) {
    $car = intval($car);
    $statement = 'SELECT datestart,dateend FROM reservations WHERE car = ' . $car;
} else {
    $statement = 'SELECT car,datestart,dateend FROM reservations';
}
$result = $db->query($statement);
$reservationArray = array();
while($row = $result->fetchArray(SQLITE3_ASSOC)) {
    array_push($reservationArray, $row);
}
$reservjson = json_encode($reservationArray);
if(empty($_GET['php']))://an sto GET evala mia php oti na 'nai, apla ase na uparxei h metavlhth gia kana hack include mexri na grapsw kalytero kwdika
    echo $reservjson;//reserv-json, logopaignio. den pianomai shmera
endif;
?>