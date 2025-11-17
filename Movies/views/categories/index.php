<?php $title = 'Kategóriák'; ob_start(); ?>

<h2>Kategóriák kezelése</h2>
<a href="/categories/create" class="btn btn-primary">Új kategória</a>

<table style="margin-top: 1rem;">
    <thead><tr><th>#</th><th>Név</th><th>Műveletek</th></tr></thead>
    <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td>
                <a href="/categories/<?= $cat['id'] ?>/edit" class="btn btn-small btn-primary">Szerkeszt</a>
                <form method="POST" action="/categories/<?= $cat['id'] ?>/delete" style="display:inline;">
                    <button type="submit" class="btn btn-small btn-danger"
                            onclick="return confirm('Biztosan törlöd a(z) <?= htmlspecialchars($cat['name']) ?> kategóriát?')">
                        Töröl
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>