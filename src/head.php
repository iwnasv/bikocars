<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="Ionas Vasileiadis <work@ionas.dev>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="rent a car, car rental, van rental, rent car, Thessaloniki, budget rentals, Greece, tourist, airport, driver hire, SKG">
<meta name="description" content="Kiko Cars Car & Van Rental Company located in Thessaloniki, Greece">
<meta name="robots" content="noarchive">
<base href="https://kikocars.gr">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" type="text/css" href="/style.css">
<link rel="icon" type="image/png" href="/favicon.png" />
<title><?php if(empty($title)) { echo "Kiko Cars Car & Van Rental"; } else { echo $title . ' - Kiko Cars Car & Van Rental'; } ?></title>
<script type="text/javascript" src="/asset/date.js"></script>
</head>