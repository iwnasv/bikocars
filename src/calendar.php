<form id="create-reservation" action="/fleet.php" method="get">
    <div id="res-time-place" class="">
        <div class="absolute left-5 w-1/3 grid block">
            <input name="pickup-loc" class="hidden" type="text" disabled="yes" placeholder="SKG"/>
            <label for="pickup-date">Pickup date: </label><br>
            <input id="pickup-date" onchange="calcReturn(this.value)" name="pickup-date" type="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>"/>
        </div>
        <div class="absolute right-5 w-1/3 grid">
            <label for="return-date">Return date: </label><br>
            <input name="return-loc" class="hidden" type="text" disabled="yes" placeholder="SKG"/>
            <input id="return-date" class="mr-0" name="return-date" type="date" min="<?= date('Y-m-d') ?>"/>
        </div>
    </div>
    <div class="">
        <input name="promo" id="promocode" type="text" placeholder="Promo code"/>
        <input type="submit" class="w-full" value="Book Now!"/>
    </div>
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
</form>
