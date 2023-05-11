<?php include('../src/db.php');
if($_GET['confirm']) {
    $sql = 'UPDATE reservations SET confirmed = 1 WHERE code = :code';
    $statement = $db->prepare($sql);
    $statement->bindValue('code', filter_input(INPUT_GET, 'confirm'));
    $statement->execute();
}
$old = 0;
if($_GET['old']) {
    $old = 1;
}
$sql = 'SELECT * FROM reservations WHERE confirmed = :old';
$statement = $db->prepare($sql);
$statement->bindValue('old', $old);
$reservations = $statement->execute();
?>
<!DOCTYPE html>
<html>
<body>
<?php while($res = $reservations->fetchArray(SQLITE3_ASSOC)) : ?>
    <span><?= $res['name'] ?> <?= $res['lastname'] ?>, <?= $carsArray[$res['car']]['name'] ?>, <?= date('d/m/Y',strtotime($res['datestart'])) ?> έως <?= date('d/m/Y',strtotime($res['dateend'])) ?><br>
    <?= $res['email'] ?>, <?= $res['phone'] ?>, <?= date('d/m/Y',strtotime($res['birthdate'])) ?>,<?= $res['address'] ?>, <?= $res['zipcode'] ?>, <?= $res['city'] ?>, <?= $res['country'] ?><br>
    <?= $res['travelingfrom'] ?>, <?= $res['flight'] ?>, <?= $res['notes'] ?>, <?= $res['promo'] ?>, <a href="https://kikocars.gr/book/details.php?code=<?= $res['code'] ?>">status page</a></span>
    <?php if(!$old) : ?><form method="get" onsubmit="return confirm('εγκρίνεις την κράτηση του <?= $res['name'] ?>');">
        <input style="display: none" type="text" name=confirm value="<?= $res['code'] ?>">
        <input type="submit" value="confirm">
    </form><?php endif ?>
    <hr>
<?php endwhile ?>
<?php if(!$reservations->fetchArray()) : ?>
    <p>πάει και σήμερα... 😫😫</p>
    <p>θες να δεις <a href="/reservations.php?old=yes">τις παλιές κρατήσεις</a>;</p>
<?php endif ?>