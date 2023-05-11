<?php
include('../src/db.php');
if($_POST) {
    $safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $car = intval($safePost['car']);
    $datestart = $safePost['datestart'];
    $dateend = $safePost['dateend'];

    $sql = 'INSERT INTO availability VALUES(:car,:datestart,:dateend)';
    $statement = $db->prepare($sql);
    $statement->bindValue('car', $car, SQLITE3_INTEGER);
    $statement->bindValue('datestart', $datestart, SQLITE3_TEXT);
    $statement->bindValue('dateend', $dateend, SQLITE3_TEXT);
    $statement->execute();
}
if($_GET['delete']) {
    $car = filter_input(INPUT_GET, 'car');
    $del = filter_input(INPUT_GET, 'delete');
    $sql = 'DELETE FROM availability WHERE rowid = :del';
    $statement = $db->prepare($sql);
    $statement->bindValue('del', $del);
    $statement->bindValue('car', $car);
    $statement->execute();
}
?>
<!DOCTYPE html>
<html>
<body>
<?php if(is_null($_GET['car'])) : ?>
<form method="get">
    <?php include('../src/admincardropdown.php') ?>
    <input type="submit" value="set car">
</form>
<?php else : ?>
<ul>
<?php $car = filter_input(INPUT_GET, 'car');
$sql = 'SELECT rowid,* FROM availability WHERE car = :car';// AND dateend >= CURRENT_DATE
$statement = $db->prepare($sql);
$statement->bindValue('car', $car, SQLITE3_INTEGER);
$a = $statement->execute();
while ($unavailable = $a->fetchArray(SQLITE3_ASSOC)) : ?>
    <li><?= $unavailable['datestart'] ?> έως <?= $unavailable['dateend'] ?> <a href="/availability.php?delete=<?= $unavailable['rowid'] ?>&car=<?= $car ?>">[X]</a></li>
<?php endwhile ?>
</ul>
<form method="post" action="/availability.php?car=<?= $car ?>"><!--xreiazetai to action gia na mhn pasarei katala8os to GET delete kai svhsei kati pou DEN prepei! -->
    <p><?= $carsArray[$car]['name'] ?></p>
    <label for="datestart">το δώσαμε από</label>
    <input name="datestart" type="date">
    <label for="dateend">έως</label>
    <input name="dateend" type="date">
    <input type="number" name="car" style="display: none" value="<?= $car ?>">
    <input type="submit" value="update car availability">
</form>
<p><a href="/availability.php">πάνε πίσω</a>.</p>
<p>πολύ προσοχή μην κάνεις refresh αυτή τη σελίδα όταν έχεις κάνει delete. θα σβήσεις μία επόμενη κράτηση.</p>
<?php endif ?>
</body>
</html>
