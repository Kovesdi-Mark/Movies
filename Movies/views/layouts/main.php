<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mozifilm Katalógus' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; color: #333; }
        header { background: #333; color: #fff; padding: 1rem; text-align: center; }
        nav { background: #444; padding: 0.8rem; }
        nav a { color: #fff; margin: 0 1rem; text-decoration: none; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 1rem; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
        th, td { padding: 0.8rem; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f0f0f0; }
        .btn { padding: 0.5rem 1rem; margin: 0.3rem; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-small { padding: 0.3rem 0.6rem; font-size: 0.9rem; }
        form { margin: 1rem 0; }
        input, select, textarea { padding: 0.5rem; margin: 0.5rem 0; width: 100%; max-width: 500px; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        .poster { max-width: 200px; border-radius: 8px; }
        .trailer { margin: 2rem 0; }
        .rating { font-size: 1.5rem; color: #ffc107; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../partials/navigation.php'; ?>

    <div class="container">
        <h1><?= $title ?? '' ?></h1>
        <?= $content ?? '' ?>
    </div>
</body>
</html>