<?php $title = 'Új stúdió hozzáadása'; ob_start(); ?>

<h2>Új stúdió felvétele</h2>

<form method="POST">
    <label>Stúdió neve:
        <input type="text" name="name" required autofocus>
    </label>

    <div style="margin-top: 1.5rem;">
        <button type="submit" class="btn btn-primary">Mentés</button>
        <a href="<?= BASE_PATH ?>/studios" class="btn">Mégse</a>
    </div>
</form>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>