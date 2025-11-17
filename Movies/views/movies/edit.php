<?php $title = 'Film szerkesztése: ' . htmlspecialchars($movie['title']); ob_start(); ?>

<h2>Film szerkesztése</h2>
<form method="POST">
    <label>Cím: <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required></label>
    <label>Rendező: <input type="text" name="director" value="<?= htmlspecialchars($movie['director']) ?>" required></label>
    
    <label>Stúdió:
        <select name="studio_id" required>
            <?php foreach ($studios as $s): ?>
                <option value="<?= $s['id'] ?>" <?= $s['id'] == $movie['studio_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <!-- Továbbiak ugyanúgy, csak value-kkal és selected-del -->
    <!-- Színészeknél: -->
    <select name="actors[]" multiple size="8">
        <?php foreach ($actors as $a): ?>
            <option value="<?= $a['id'] ?>" <?= in_array($a['id'], $movie['actor_ids'] ?? []) ? 'selected' : '' ?>>
                <?= htmlspecialchars($a['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- ... többi mező kitöltve ... -->

    <button type="submit" class="btn btn-primary">Frissítés</button>
</form>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>