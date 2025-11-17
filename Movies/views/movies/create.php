<?php $title = 'Új film hozzáadása'; ob_start(); ?>

<h2>Új film felvétele</h2>
<form method="POST">
    <label>Cím: <input type="text" name="title" required></label>
    <label>Rendező: <input type="text" name="director" required></label>
    
    <label>Stúdió:
        <select name="studio_id" required>
            <?php foreach ($studios as $s): ?>
                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Kategória:
        <select name="category_id" required>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Szereplők (több is választható):
        <select name="actors[]" multiple size="8">
            <?php foreach ($actors as $a): ?>
                <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Korhatár (pl. 16+): <input type="text" name="age_rating" required></label>
    <label>Nyelv: <input type="text" name="language" value="angol" required></label>
    <label><input type="checkbox" name="subtitled" value="1"> Feliratos</label>

    <label>Leírás:<br><textarea name="description" rows="5" required></textarea></label>
    <label>Poszter URL: <input type="url" name="poster_url" required></label>
    <label>Trailer URL (YouTube): <input type="url" name="trailer_url"></label>

    <button type="submit" class="btn btn-primary">Mentés</button>
    <a href="<?= BASE_PATH ?>/movies" class="btn">Mégse</a>
</form>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>