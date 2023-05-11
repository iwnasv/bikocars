<div class="car-div">
    <div class="car-img">
        <img class="w-40" src="/asset/extraimg/<?= $extra[1] ?>"/>
    </div>
    <div class="car-facts">
        <ul>
            <li><?= $extra[0] ?></li>
            <li class="price"><?= $extra[2] ?>€/day</li>
            <li class="extras-quantity"><input name="<?= $extra[3] ?>" type="number" value="0" min="0"<?php if($extra[3] == 'insr'): ?> max="1" <?php endif;?>></li>
        </ul>
    </div>
</div>