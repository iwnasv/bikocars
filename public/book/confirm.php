<?php
$safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//https://stackoverflow.com/questions/44165533/php-how-to-filter-in-a-correct-way-all-post-variables
include '../../src/head.php';
require_once '../../src/db.php';
$_SESSION['reservation'] = $safePost;
if(is_null($_SESSION['car']) || !$_SESSION['reservation']) {
    die('sorry, something is wrong with your request');//mpakalikos tropos na failarei an den exw ta profanh...
} ?>
<body>
    <header>
        <?php include '../../src/header.php'; ?>
    </header>
    <main>
        <span>We're almost there!</span><br>
        <span>Please double check your contact info:</span>
        <ul id="reservation-confirmation">
            <li><?= $carsArray[$_SESSION['car']]['name'] ?></li><?php
            if($_SESSION['extras']) {
                $extrascost = 0;
                include('../../src/extras-array.php');
                foreach ($_SESSION['extras'] as $extra) {
                    foreach($extras as $match) {//malakia design, vlepe include
                        if($extra[0] == $match[3]) {
                            $extrascost += $match[2];
                            $extraname = $match[0];//mporeis k kalutera...
                        }
                    }?>
            <li><?= $extraname ?></li>
                    <?php
                }
            }?>
            <li><?= date('l, F d', $_SESSION['datestart']) ?><?php if($_SESSION['datestart'] != $_SESSION['dateend']):?> until <?= date('l, F d', $_SESSION['dateend']) ?><?php endif ?></li>
            <li><?= $_SESSION['reservation']['name'] ?> <?= $_SESSION['reservation']['lastname'] ?></li>
            <li><?= $_SESSION['reservation']['phone'] ?></li>
            <li><?= $_SESSION['reservation']['email'] ?></li>
            <li class="price">Total cost: <?php
            $cost = $carsArray[$_SESSION['car']]['price'] + $extrascost;
            $dateA = new DateTime('@' . $_SESSION['datestart']);
            $dateB = new DateTime('@' . $_SESSION['dateend']);
            $interval = $dateA->diff($dateB);
            $days = $interval->days + 1;
            echo $cost * $days;
            ?>€</li>
            <li>Payment method: <input type="radio" name="cash" checked><label for="cash">Pay on pickup</label></li>
        </ul>
        <a class="button" href="/register.php">Confirm reservation!</a>
    </main>
    <footer>
        <?php include '../../src/footer.php'; ?>
    </footer>
</body>
</html>