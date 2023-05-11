<?php session_start(); ?>
<html>
<meta charset="utf-8">
<meta name="author" content="Ionas Vasileiadis <work@ionas.dev>">
<head>
    <title>Kiko Boss Interface</title>
</head>
<?php
if(true) {//edw 8a empaine to $_SESSION['loggedin'] alla protimw na exw http basic auth para na mplekw
    require_once('../src/adminindex.php');
} else {
    require_once('../src/adminlogin.php');
}
?>
<footer>
    <hr>
    <h3>Copyright @iwnaras 2023-<?=date('Y')?>, all rights reserved.</h3>
</footer>
</html>