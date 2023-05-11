<?php include '../../src/head.php';
require_once '../../src/db.php';
include '../src/getdates.php'; ?>
<body>
    <header>
        <?php include '../../src/header.php'; ?>
    </header>
    <main>
        <!--dwse car id (apo fleet), tsekare hmeromhnies, dialekse hmeromhnies, pane sto book-index-->
        <?php
            if(!is_null($_GET['car'])) {
                $_SESSION['car'] = intval(filter_input(INPUT_GET, 'car', FILTER_VALIDATE_INT));
            } else {
                if(is_null($_SESSION['car'])) {
                    die('you need to select a car first');
                }
            }
            echo '8es to amaksi #' . $_SESSION['car'] . ' stis ' . date('d/m/Y', $_SESSION['datestart']);
            $statement = 'SELECT datestart, dateend FROM reservations WHERE car = ' . $_SESSION['car'] . ' AND dateend <= ' . date('Y/m/d',$_SESSION['datestart']) . ' AND datestart >= ' . date('Y/m/d',$_SESSION['dateend']);
            $sqlobject = $db->query($statement);
            var_dump($sqlobject->fetchArray(SQLITE3_ASSOC));
            if(!$sqlobject->fetchArray(SQLITE3_ASSOC)){
                echo 'this page is being rewritten... ';
            }
        ?>
        <h3>για πρακτικούς λόγους και μόνο: <a href="/book/extras.php">extras</a></h3>
    </main>
    <footer>
        <?php include '../../src/footer.php'; ?>
    </footer>
</body>
</html>