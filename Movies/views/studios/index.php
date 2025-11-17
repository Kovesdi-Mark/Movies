<?php $title = 'Filmstúdiók'; ob_start(); ?>

<h2>Filmstúdiók kezelése</h2>
<a href="/studios/create" class="btn btn-primary">Új stúdió hozzáadása</a>

<table style="margin-top: 1rem;">
    <thead>
        <tr>
            <th>#</th>
            <th>Név</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($studios as $studio): ?>
        <tr>
            <td><?= $studio['id'] ?></td>
            <td><?= htmlspecialchars($studio['name']) ?></td>
            <td>
                <a href="/studios/<?= $studio['id'] ?>/edit" class="btn btn-small btn-primary">Szerkeszt</a>
                <form method="POST" action="/studios/<?= $studio['id'] ?>/delete" style="display:inline;">
                    <button type="submit" class="btn btn-small btn-danger"
                            onclick="return confirm('Biztosan törlöd a(z) <?= htmlspecialchars($studio['name']) ?> stúdiót?')">
                        Töröl
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>