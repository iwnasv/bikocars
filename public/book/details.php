<?php include '../../src/head.php';
include '../../src/db.php'; ?>
<body>
    <header>
        <?php include '../../src/header.php'; ?>
    </header>
    <main>
        <!--edw na pairnei apo to GET kwdiko k na tsekarei, epishs upload eikones-->
        <?php $code = filter_input(INPUT_GET, 'code'); ?>
        <div id="find-reservation">
            <p>Reservation status</p>
            <form method="get">
                <input type="text" name="code" placeholder="Code"<?php if($code): ?> value="<?= $code ?>"<?php endif?>>
                <input type="submit" value="Check">
            </form>
        </div><?php if($code): ?>
        <div id="reservation-confirmation">
            <?php
            $sql = 'SELECT * FROM reservations WHERE code = :code;';
            $statement = $db->prepare($sql);
            $statement->bindValue('code', $code, SQLITE3_TEXT);
            $reservation = $statement->execute();
            $reservation = $reservation->fetchArray(SQLITE3_ASSOC);
            if(!$reservation) : ?>
            <p>Reservation not found</p>
            <?php else : ?>
            <ul>
                <li><?= $reservation['name'] ?> <?= $reservation['lastname'] ?></li>
                <li><?= $carsArray[$reservation['car']]['name'] ?></li>
                <li><?= $reservation['datestart'] ?> to <?= $reservation['dateend'] ?></li>
                <li><?= $reservation['email'] ?></li>
                <li><?= $reservation['phone'] ?></li>
            </ul>
            <?php if($reservation['confirmed']): ?>
                <p>Your reservation has been confirmed, thank you very much!</p>
            <?php else: ?>
                <p>We're processing your reservation. Please contact us for any questions!</p>
            <?php endif ?>
            <?php endif; ?>
        </div><?php endif ?>
    </main>
    <footer>
        <?php include '../../src/footer.php'; ?>
    </footer>
</body>
</html>