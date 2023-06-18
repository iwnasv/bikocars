<?php
include '../src/db.php';
session_start();
$code = $_SESSION['reservation']['lastname'] . $_SESSION['dateend'] . $_SESSION['car'] . time();
$code = hash('sha256', $code);
$code = substr($code, 0, 16);
$sql = 'INSERT INTO reservations(name,lastname,email,phone,birthdate,datestart,dateend,car,code,address,zipcode,city,country,travelingfrom,flight,notes,promo) VALUES(:name,:lastname,:email,:phone,:birthdate,:datestart,:dateend,:car,:code,:address,:zipcode,:city,:country,:travelingfrom,:flight,:notes,:promo)';
$statement = $db->prepare($sql);
$statement->bindValue('name', $_SESSION['reservation']['name'], SQLITE3_TEXT);
$statement->bindValue('lastname', $_SESSION['reservation']['lastname'], SQLITE3_TEXT);
$statement->bindValue('email', $_SESSION['reservation']['email'], SQLITE3_TEXT);
$statement->bindValue('phone', $_SESSION['reservation']['phone'], SQLITE3_TEXT);
$statement->bindValue('birthdate', $_SESSION['reservation']['birthday'], SQLITE3_TEXT);
$statement->bindValue('datestart', date('Y-m-d', $_SESSION['datestart']), SQLITE3_TEXT);
$statement->bindValue('dateend', date('Y-m-d', $_SESSION['dateend']), SQLITE3_TEXT);
$statement->bindValue('car', $_SESSION['car'], SQLITE3_INTEGER);
$statement->bindValue('code', $code, SQLITE3_TEXT);
//apo dw kai katw mporei na einai null
$statement->bindValue('address', $_SESSION['reservation']['address'], SQLITE3_TEXT);
$statement->bindValue('zipcode', $_SESSION['reservation']['zipcode'], SQLITE3_INTEGER);
$statement->bindValue('city', $_SESSION['reservation']['city'], SQLITE3_TEXT);
$statement->bindValue('country', $_SESSION['reservation']['country'], SQLITE3_TEXT);
$statement->bindValue('travelingfrom', $_SESSION['reservation']['country'], SQLITE3_TEXT); //pros to paron to exw oti einai to idio, mallon 8a kanw epilogh pthshs apo allh xwra
$statement->bindValue('flight', $_SESSION['reservation']['flight'], SQLITE3_TEXT);
$statement->bindValue('notes', $_SESSION['reservation']['notes'], SQLITE3_TEXT);
$statement->bindValue('promo', $_SESSION['reservation']['promo'], SQLITE3_TEXT);
$a = $statement->execute();
$name = $_SESSION['reservation']['name'] . ' ' . $_SESSION['reservation']['lastname'];
$msg = "Dear " . $name . file_get_contents('../src/email-reservation-processed.txt');
$msg = $msg . "\nhttps://kikocars.gr/book/details.php?code=" . $code;

require('../src/emailconf.php');
$mail->addAddress($_SESSION['reservation']['email'], $_SESSION['reservation']['lastname'] . ' ' . $_SESSION['reservation']['name']);
$mail->Subject = 'Your reservation at Kiko Cars!';
$mail->Body = $msg;
$mail->Send();
$mail->smtpClose();

// THE FOLLOWING IS FOR THE NOTIFICATION!!
$bossmail->Send();
$bossmail->smtpClose();

session_unset();
session_destroy();// create another session here, and use a time variable to prevent him from sending another email...
header('Location: /book/details.php?code=' . $code); 
;?>