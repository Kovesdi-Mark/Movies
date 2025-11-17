<?php $title = 'Színész szerkesztése'; ob_start(); ?>

<h2>Színész szerkesztése</h2>
<form method="POST">
    <label>Színész neve:
        <input type="text" name="name" value="<?= htmlspecialchars($actor['name']) ?>" required autofocus>
    </label>
    <div style="margin-top: 1.5rem;">
        <button type="submit" class="btn btn-primary">Frissítés</button>
        <a href="<?= BASE_PATH ?>/actors" class="btn">Mégse</a>
    </div>
</form>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>