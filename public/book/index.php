<?php include '../../src/head.php';
$_SESSION['extras'] = array();
if($_GET['bc'] > 0) {
    array_push($_SESSION['extras'],array('bc',intval(filter_var($_GET['bc'],FILTER_SANITIZE_NUMBER_INT))));
}
if($_GET['bs'] > 0) {
    array_push($_SESSION['extras'],array('bs',intval(filter_var($_GET['bs'],FILTER_SANITIZE_NUMBER_INT))));
}
if($_GET['bsp'] > 0) {
    array_push($_SESSION['extras'],array('bsp',intval(filter_var($_GET['bsp'],FILTER_SANITIZE_NUMBER_INT))));
}
if($_GET['bstr'] > 0) {
    array_push($_SESSION['extras'],array('bstr',intval(filter_var($_GET['bstr'],FILTER_SANITIZE_NUMBER_INT))));
}
if($_GET['insr'] > 0) {
    array_push($_SESSION['extras'],array('insr',intval(filter_var($_GET['insr'],FILTER_SANITIZE_NUMBER_INT))));
} ?>
<body>
    <header>
        <?php include '../../src/header.php'; ?>
    </header>
    <main>
        <div id="reservation-details">
            <form action="/book/confirm.php" method="post">
                <ul>
                    <li>
                    <label for="name">Name:</label>
                    <input required type="text" name="name"/>
                    </li><li>
                    <label for="lastname">Surname:</label>
                    <input required type="text" name="lastname"/>
                    </li><li>
                    <label for="birthday">Date of birth:</label>
                    <input required name="birthday" type="date" value="<?= date('Y-m-d') ?>"/>
                    </li><li>
                    <label for="name">Email address:</label>
                    <input required type="email" name="email"/>
                    </li><li>
                    <label for="phone">Phone number:</label>
                    <input required type="tel" name="phone" placeholder="Preceded by country code"/>
                    </li><li>
                    <label for="address">Home address:</label>
                    <input type="text" name="address"/>
                    </li><li>
                    <?php include '../../src/countries.php'; ?>
                    </li><li>
                    <!--to do: ena dropdown akoma, to idio kiolas, alla to prwto na exei ena onChange() pou na allazei thn timh tou 2ou gia eukolia-->
                    <label for="city">City:</label>
                    <input type="text" name="city"/>
                    </li><li>
                    <label for="zipcode">Zipcode:</label>
                    <input type="number" min="0" name="zipcode"/>
                    </li><li>
                    <label for="flight">Flight number:</label>
                    <input type="text" name="flight"/>
                    </li><li>
                    <textarea name="notes" cols="10" rows="5">Reservation notes</textarea>
                    </li><li>
                    <label for="promocode">Promo code:</label>
                    <input type="text" name="promocode"<?php if($_SESSION['promocode']): ?> value="<?= $_SESSION['promocode'] ?>"<?php endif ?>/>
                    </li><li>
                    <input type="submit" value="Proceed">
                    </li>
                </ul>
            </form>
        </div>
    </main>
    <footer>
        <?php include '../../src/footer.php'; ?>
    </footer>
</body>
</html>