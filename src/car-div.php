<?php
$groups = [
    "economy",
    "standard",
    "compact",
    "compact SUV",
    "van",
    "luxury",
    "luxury van"
];
?><div class="car-div">
    <div class="car-img">
        <img src="/asset/carimg/<?= $car['img'] ?>"<?php if(!$available) : ?> class="grayscale opacity-50<?php endif ?>" ?>
    </div>
    <div class="car-facts">
        <ul>
            <li class="uppercase"><?= $car['name'] ?> <span class="text-slate-500">or similar</span></li>
            <li class="capitalize italic"><?= $groups[$car['category']] ?></li>
            <li>Passengers: <?= $car['passengers'] ?></li>
            <li>Baggage: <?php for($i = 1; $i <= $car['baggage']; $i++) { echo '💼'; } ?></li>
            <?php if($car['automatic']): ?>
            <li>Automatic</li>
            <?php endif; ?>
            <?php if($car['ac']): ?>
            <li>✔️ AC</li>
            <?php endif ?>
            <li>Fuel: <?php if($car['fuel']) { echo 'Diesel'; } else { echo 'Petrol'; } ?></li>
            <li class="price<?php if(!$available): echo " cancel"; endif ?>"><?= $car['price'] ?>€/day</li>
        </ul>
        <?php $fleetvars = '?car=' . $car['id']; ?>
        <?php if($available): ?>
        <a class="button" href="/book/<?= $nextpage ?>.php<?= $fleetvars ?>"><?= $bookLinkText?></a>
        <?php else: ?>
        <span class="italic">Not available</span>
        <?php endif ?>
    </div>
</div>
