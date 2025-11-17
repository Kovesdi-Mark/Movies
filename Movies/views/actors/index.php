<?php $title = 'Színészek'; ob_start(); ?>

<h2>Színészek kezelése</h2>
<a href="/actors/create" class="btn btn-primary">Új színész</a>

<table style="margin-top: 1rem;">
    <thead><tr><th>#</th><th>Név</th><th>Műveletek</th></tr></thead>
    <tbody>
        <?php foreach ($actors as $actor): ?>
        <tr>
            <td><?= $actor['id'] ?></td>
            <td><?= htmlspecialchars($actor['name']) ?></td>
            <td>
                <a href="/actors/<?= $actor['id'] ?>/edit" class="btn btn-small btn-primary">Szerkeszt</a>
                <form method="POST" action="/actors/<?= $actor['id'] ?>/delete" style="display:inline;">
                    <button type="submit" class="btn btn-small btn-danger"
                            onclick="return confirm('Biztosan törlöd <?= htmlspecialchars($actor['name']) ?> színészt?')">
                        Töröl
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>