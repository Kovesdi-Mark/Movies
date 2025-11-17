<?php
$title = htmlspecialchars($movie['title']);
ob_start();
?>

<a href="<?= BASE_PATH ?>/movies">« Vissza a filmekhez</a>

<div style="display:flex; gap: 2rem; margin: 2rem 0; flex-wrap: wrap;">
    <div>
        <img src="<?= htmlspecialchars($movie['poster_url']) ?>" alt="Poszter" class="poster" style="max-width:300px;">
    </div>
    <div style="flex:1;">
        <h2><?= htmlspecialchars($movie['title']) ?></h2>
        <p><strong>Rendező:</strong> <?= htmlspecialchars($movie['director']) ?></p>
        <p><strong>Stúdió:</strong> <?= htmlspecialchars($movie['studio_name'] ?? 'Ismeretlen') ?></p>
        <p><strong>Kategória:</strong> <?= htmlspecialchars($movie['category_name'] ?? 'N/A') ?></p>
        <p><strong>Szereplők:</strong> <?= htmlspecialchars($movie['actors'] ?? 'N/A') ?></p>
        <p><strong>Nyelv:</strong> <?= $movie['language'] ?> <?= $movie['subtitled'] ? ' (feliratos)' : '' ?></p>
        <p><strong>Korhatár:</strong> <?= htmlspecialchars($movie['age_rating']) ?></p>

        <p><strong>Leírás:</strong><br><?= nl2br(htmlspecialchars($movie['description'])) ?></p>

        <?php if ($movie['average_rating']): ?>
            <p><strong>Átlag értékelés:</strong>
                <span class="rating">★★★★★</span> <big><?= number_format($movie['average_rating'], 1) ?>/5</big>
                <small>(<?= $movie['rating_count'] ?> értékelés)</small>
            </p>
        <?php endif; ?>
    </div>
</div>

<?php if ($movie['trailer_url']): ?>
<div class="trailer">
    <h3>Hivatalos előzetes</h3>
    <iframe width="100%" height="415" src="<?= str_replace('watch?v=', 'embed/', $movie['trailer_url']) ?>" 
            frameborder="0" allowfullscreen></iframe>
</div>
<?php endif; ?>

<hr>

<h3>Értékeld a filmet (1-5)</h3>
<form method="POST" action="/ratings/create">
    <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
    <select name="rating" required>
        <option value="">-- Válassz --</option>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?> csillag</option>
        <?php endfor; ?>
    </select>
    <button type="submit" class="btn btn-primary">Értékelés küldése</button>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>