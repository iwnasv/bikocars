<?php
include('../src/db.php');
if($_POST) {
    $safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $car = intval($safePost['car']);
    $price = intval($safePost['price']);
    $lock = 0;
    if($safePost['locked']) {
        $lock = 1;
    }
    $sql = 'UPDATE cars SET price = :price, lock = :lock WHERE id = :car';
    $statement = $db->prepare($sql);
    $statement->bindValue('price', $price, SQLITE3_INTEGER);
    $statement->bindValue('lock', $lock, SQLITE3_INTEGER);
    $statement->bindValue('car', $car, SQLITE3_INTEGER);
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
<?php $car = filter_input(INPUT_GET, 'car'); ?>
<form method="post">
    <p><?= $carsArray[$car]['name'] ?></p>
    <label for="price">price</label>
    <input name="price" type="number" value="<?= $carsArray[$car]['price'] ?>">
    <label for="locked">lock</label>
    <input type="checkbox" name="lock"<?php if($carsArray[$car]['locked']) :?> checked<?php endif ?>>
    <input type="number" name="car" style="display: none" value="<?= $carsArray[$car]['id'] ?>">
    <input type="submit" value="update car">
</form>
<p>Η τιμή, Νίκο, είναι σε €/ημέρα. Για να αλλάξεις αμάξι, <a href="/caredit.php">πάνε πίσω</a>.</p>
<?php endif ?>
</body>
</html>
