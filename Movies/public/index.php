<?php
// public/index.php – VÉGLEGES, HIBAMENTES VERZIÓ

// Dinamikus base path (mindig jó, akár localhost, akár szerver)
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$base_path = $base_path === '/' ? '' : $base_path;
define('BASE_PATH', $base_path);

// Modellek és kontrollerek betöltése
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Movie.php';
require_once __DIR__ . '/../models/Studio.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Actor.php';
require_once __DIR__ . '/../models/Rating.php';

require_once __DIR__ . '/../controllers/MovieController.php';
require_once __DIR__ . '/../controllers/StudioController.php';
require_once __DIR__ . '/../controllers/CategoryController.php';
require_once __DIR__ . '/../controllers/ActorController.php';
require_once __DIR__ . '/../controllers/RatingController.php';

use Controllers\MovieController;
use Controllers\StudioController;
use Controllers\CategoryController;
use Controllers\ActorController;
use Controllers\RatingController;

// Tiszta útvonal kiszedése
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace(BASE_PATH, '', $path);
$segments = array_values(array_filter(explode('/', trim($path, '/'))));

// Ha üres az URL → filmek listája
if (empty($segments)) {
    (new MovieController())->index();
    exit;
}

$resource = $segments[0] ?? 'movies';

switch ($resource) {
    case 'movies':
        $controller = new MovieController();

        // Ha nincs további szegmens (pl. csak /movies), akkor index
        if (empty($segments[1])) {
            $controller->index();
            exit; // FONTOS: itt kilépünk, hogy ne fusson tovább!
        }

        if (is_numeric($segments[1])) {
            $id = (int)$segments[1];
            if (isset($segments[2])) {
                if ($segments[2] === 'edit') {
                    $controller->edit($id);
                } elseif ($segments[2] === 'delete') {
                    $controller->delete($id);
                }
            } else {
                $controller->show($id);
            }
        } elseif ($segments[1] === 'create') {
            $controller->create();
        } else {
            $controller->index();
        }
        break;

    case 'studios':
        $controller = new StudioController();
        goto crud_handler;
    case 'categories':
        $controller = new CategoryController();
        goto crud_handler;
    case 'actors':
        $controller = new ActorController();
        goto crud_handler;

    case 'ratings':
        (new RatingController())->create();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 – Az oldal nem található</h1>";
        exit;
}

// CRUD logika stúdiókhoz, kategóriákhoz, színészekhez
crud_handler:
if (isset($segments[1]) && is_numeric($segments[1])) {
    $id = (int)$segments[1];
    if (isset($segments[2]) && $segments[2] === 'edit') {
        $controller->edit($id);
    } elseif (isset($segments[2]) && $segments[2] === 'delete') {
        $controller->delete($id);
    } else {
        $controller->index();
    }
} elseif (isset($segments[1]) && $segments[1] === 'create') {
    $controller->create();
} else {
    $controller->index();
}