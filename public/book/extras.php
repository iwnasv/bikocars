<?php include '../../src/head.php';
if(!is_null($_GET['car'])) {
    $_SESSION['car'] = intval(filter_input(INPUT_GET, 'car', FILTER_VALIDATE_INT));
} elseif(!$_SESSION['car']) {
    die('no car set!');
}
?>
<body>
    <header>
        <?php include '../../src/header.php'; ?>
    </header>
    <main>
        <span class="title">Please consider adding some of the following products or services to your reservation</span>
        <form id="extras-list" action="./index.php" method="get">
        <?php
            include_once('../../src/extras-array.php');
            foreach($extras as $extra) {
                include('../../src/extra-div.php');
            }
        ?>
        <input class="" type="submit" value="Proceed">
        </form>
        </main>
    <footer>
        <?php include '../../src/footer.php'; ?>
    </footer>
</body>
</html>