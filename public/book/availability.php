<?php include '../../src/head.php';
include '../src/getdates.php'; ?>
<body>
    <header>
        <?php include '../../src/header.php'; ?>
    </header>
    <main>
        <?php
        /* pros to paron apla zhtaei hmeromhnies kai ton petaei pisw;
           exei polu peri8wrio gia veltiwsh, skepsou oti pernaei to car
           me GET */
            if($_GET['car']):
                $_SESSION['car'] = intval(filter_input(INPUT_GET, 'car', FILTER_VALIDATE_INT));
            endif; ?>
       <div>Please select pickup and return dates, so we can confirm the car's availability!</div>
       <?php include '../../src/calendar.php' ?>
    </main>
    <footer>
        <?php include '../../src/footer.php'; ?>
    </footer>
</body>
</html>