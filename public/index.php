<?php include '../src/head.php'; ?>
<body>
    <header>
        <?php include '../src/header.php'; ?>
    </header>
    <main id="index"><!--auto einai gia to slideshow, na mhn to deixnei stis alles selides-->
        <article>
            <span class="centertext">Welcome to Kiko Cars!</span>
            <?php include '../src/calendar.php' ?>
        </article>
    </main>
    <footer>
        <?php include '../src/footer.php'; ?>
    </footer>
    <script>
        // auto kanei koumanto sthn hmeromhnia epistrofhs
        function calcReturn(start) {
            let date = new Date.parse(start);
            date = date.add(3).day();
            document.getElementById('return-date').value = date.toString('yyyy-MM-dd');
            document.getElementById('return-date').min = date.toString('yyyy-MM-dd');
        }
        window.onLoad = calcReturn(Date.today());
    </script>
</body>
</html>