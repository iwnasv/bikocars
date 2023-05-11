<select name="car">
<?php foreach($carsArray as $car): ?>
<option value="<?= $car['id'] ?>"><?= $car['name'] ?></option>
<?php endforeach ?>
</select>