<?php
$title = 'Mozifilmek listája';
ob_start();
?>

<a href="<?= BASE_PATH ?>/movies/create" class="btn btn-primary">Új film hozzáadása</a>

<!-- Szűrők -->
<form method="GET" style="margin: 1.5rem 0; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
    <label>Színész neve: <input type="text" name="actor" value="<?= htmlspecialchars($_GET['actor'] ?? '') ?>"></label>
    <label>Stúdió:
        <select name="studio">
            <option value="">-- Összes --</option>
            <?php foreach ($studios as $s): ?>
                <option value="<?= htmlspecialchars($s['name']) ?>" <?= ($_GET['studio'] ?? '') === $s['name'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Kategória:
        <select name="category">
            <option value="">-- Összes --</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= htmlspecialchars($c['name']) ?>" <?= ($_GET['category'] ?? '') === $c['name'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit" class="btn btn-primary">Szűrés</button>
    <a href="<?= BASE_PATH ?>/movies">Összes törlése</a>
</form>

<table>
    <thead>
        <tr>
            <th>Poszter</th>
            <th>Cím</th>
            <th>Stúdió</th>
            <th>Rendező</th>
            <th>Kategória</th>
            <th>Szereplők</th>
            <th>Nyelv / Felirat</th>
            <th>Korhatár</th>
            <th>Értékelés</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movies as $movie): ?>
        <tr>
            <td><img src="<?= htmlspecialchars($movie['poster_url']) ?>" alt="poszter" width="80" class="poster"></td>
            <td>
                <strong>
                    <a href="<?= BASE_PATH ?>/movies/<?= $movie['id'] ?>">
                        <?= htmlspecialchars($movie['title']) ?>
                    </a>
                </strong>
            </td>
            <td><?= htmlspecialchars($movie['studio_name'] ?? 'Ismeretlen') ?></td>
            <td><?= htmlspecialchars($movie['director']) ?></td>
            <td><?= htmlspecialchars($movie['category_name'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($movie['actors'] ?? 'N/A') ?></td>
            <td><?= $movie['language'] ?> <?= $movie['subtitled'] ? '<small>(feliratos)</small>' : '' ?></td>
            <td><?= htmlspecialchars($movie['age_rating']) ?></td>
            <td>
                <?php if ($movie['average_rating']): ?>
                    <span class="rating">★★★★★</span> <?= number_format($movie['average_rating'], 1) ?>/5
                    <small>(<?= $movie['rating_count'] ?> értékelés)</small>
                <?php else: ?>
                    Még nincs értékelés
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= BASE_PATH ?>/movies/<?= $movie['id'] ?>/edit" class="btn btn-small btn-primary">Szerkeszt</a>
                <form method="POST" action="<?= BASE_PATH ?>/movies/<?= $movie['id'] ?>/delete" style="display:inline;">
                    <button type="submit" class="btn btn-small btn-danger" 
                            onclick="return confirm('Biztosan törlöd ezt a filmet?')">Töröl</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>