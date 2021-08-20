<form method="post" action="">
    <div class="form-group">
        <label for="name">Meno</label>
        <input class="form-control" value="<?php echo (isset($name)) ? $name : null ?>" type="text" name="name"
               id="name" required>
    </div>
    <div class="form-group">
        <label for="surname">Priezvisko</label>
        <input class="form-control" value="<?php echo (isset($surname)) ? $surname : null ?>" type="text" name="surname"
               id="surname" required>
    </div>
    <div class="form-group">
        <label for="birth_day">Dátum narodenia</label>
        <input class="form-control" value="<?php echo isset($birth_day) ? date('Y-m-d',strtotime($birth_day)) : null ?>" type="date" name="birth_day"
               id="birth_day" required>
    </div>
    <div class="form-group">
        <label for="birth_place">Miesto narodenia</label>
        <input class="form-control" value="<?php echo (isset($birth_place)) ? $birth_place : null ?>" type="text" name="birth_place"
               id="birth_place" required>
    </div>
    <div class="form-group">
        <label for="birth_country">Krajina narodenia</label>
        <input class="form-control" value="<?php echo (isset($birth_country)) ? $birth_country : null ?>" type="text" name="birth_country"
               id="birth_country" required>
    </div>
    <div class="form-group">
        <label for="death_day">Dátum umrtia</label>
        <input class="form-control" value="<?php echo isset($death_day)&&$death_day>$birth_day ? date('Y-m-d',strtotime($death_day)) : null ?>" type="date" name="death_day"
               id="death_day">
    </div>
    <div class="form-group">
        <label for="death_place">Miesto umrtia</label>
        <input class="form-control" value="<?php echo (isset($death_place)) ? $death_place : null ?>" type="text" name="death_place"
               id="death_place">
    </div>
    <div class="form-group">
        <label for="death_country">Krajina umrtia</label>
        <input class="form-control" value="<?php echo (isset($death_country)) ? $death_country : null ?>" type="text" name="death_country"
               id="death_country">
    </div>

    <button class="btn btn-dark" type="submit">Uložiť</button>
</form>