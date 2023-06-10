<?php include '../src/head.php'; ?>
<?php require_once '../src/db.php'; ?>
<body>
    <header>
        <?php include '../src/header.php'; ?>
    </header>
    <main>
        <?php
            if (!empty($_GET['pickup-date']) && !empty($_GET['return-date'])) {
                include '../src/getdates.php';
            }
        ?>
        <div id="fleet-table">
            <?php $nextpage = "availability";
                foreach($carsArray as $car) {
                    //αν έχω ημερομηνίες, δες το αμάξι να είναι διαθέσιμο τότε, αλλιώς μην το δείξεις
                    $available = !$car['lock'];
                    $bookLinkText = "Proceed"; //αν δεν έχω ημερομηνίες, πες αυτό και πάρε ημερομηνίες. αλλιώς πες Book
                    if(!(empty($_SESSION['datestart']) || empty($_SESSION['dateend']))) {
                        $nextpage = "extras";
                        $dateA = "date('" . date("Y-m-d", $_SESSION['datestart']) . "')";
                        $dateB = "date('" . date("Y-m-d", $_SESSION['dateend']) . "')";
                        //το σκαρφίστηκα. datestart < s[start] < dateend OR datestart < s[end] < dateend
                        $caseOne = $dateA . ' BETWEEN datestart AND dateend';
                        $caseTwo = $dateB . ' BETWEEN datestart AND dateend';
                        $statement = 'SELECT datestart, dateend FROM availability WHERE car = ' . $car['id'] . ' AND ((' . $caseOne . ') OR (' . $caseTwo . '));';
                        $unavailability = $db->query($statement)->fetchArray(SQLITE3_ASSOC);
                        if($unavailability):
                            $available = false; //na kanw kapws na leei apo pote einai dia8esimo, me link pou me get dinei dia8esimh hmeromhnia
                        endif;
                        $bookLinkText = "Book";
                    }
                    include('../src/car-div.php');
                } ?>
        </div>
    </main>
    <footer>
        <?php include '../src/footer.php'; ?>
    </footer>
</body>
</html>
