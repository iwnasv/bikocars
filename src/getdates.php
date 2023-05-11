<?php $datestart = filter_input(INPUT_GET, 'pickup-date', FILTER_SANITIZE_NUMBER_FLOAT);
$dateend = filter_input(INPUT_GET, 'return-date', FILTER_SANITIZE_NUMBER_FLOAT);
$_SESSION['datestart'] = strtotime($datestart);
$_SESSION['dateend'] = strtotime($dateend);
if(($_SESSION['datestart'] < strtotime(date('Y-m-d')) || $_SESSION['dateend'] < strtotime(date('Y-m-d'))) || false /*sth 8esh tou false vale elegxo an end < start*/):
    http_response_code(406);
    die("Invalid dates");
endif; ?>