<?php
//na valw tipota peri API edw
//perase kairos. genika auto to egrapsa sthn arxh tou project k einai arketa oti na nai. kalo 8a htan na to allaksw, na kanw na xrhsimopoiei to api pantou
if(empty($db)) {
    $db = new SQLite3('/var/www/html/db/kikocars.db', SQLITE3_OPEN_READWRITE);
    $carsResult = $db->query('SELECT rowid,* FROM CARS');//twra pou to eida auto, exw allaksei kai th domh ths vashs dedomenwn nomizw to rowid prepei na fygei
    $carsArray = array();
    $i = 0;
    while($row = $carsResult->fetchArray(SQLITE3_ASSOC)) {
        $carsArray[$i] = $row;
        $i++;
    }
}
?>