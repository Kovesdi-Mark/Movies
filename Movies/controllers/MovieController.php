<?php

namespace Controllers;

use Models\Movie;
use Models\Studio;
use Models\Category;
use Models\Actor;

class MovieController
{
    private Movie $movie;
    private Studio $studio;
    private Category $category;
    private Actor $actor;

    public function __construct()
    {
        $this->movie    = new Movie();
        $this->studio   = new Studio();
        $this->category = new Category();
        $this->actor    = new Actor();
    }

    public function index(): void
    {
        $filters = [
            'actor'    => $_GET['actor']    ?? null,
            'studio'   => $_GET['studio']   ?? null,
            'category' => $_GET['category'] ?? null,
        ];

        $movies     = $this->movie->all($filters);
        $studios    = $this->studio->all();
        $categories = $this->category->all();
        $actors     = $this->actor->all();

        require __DIR__ . '/../views/movies/index.php';
    }

    public function show(int $id): void
    {
        $movie = $this->movie->find($id);

        if (!$movie) {
            http_response_code(404);
            echo "Film nem található.";
            return;
        }

        require __DIR__ . '/../views/movies/show.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => trim($_POST['title']),
                'studio_id'   => (int)$_POST['studio_id'],
                'director'    => trim($_POST['director']),
                'category_id' => (int)$_POST['category_id'],
                'age_rating'  => trim($_POST['age_rating']),
                'language'    => trim($_POST['language']),
                'subtitled'   => isset($_POST['subtitled']) ? 1 : 0,
                'description' => trim($_POST['description']),
                'poster_url'  => trim($_POST['poster_url']),
                'trailer_url' => trim($_POST['trailer_url'] ?? ''),
            ];

            $actorIds = $_POST['actors'] ?? [];

            $this->movie->create($data, $actorIds);
            header('Location: /movies');
            exit;
        }

        $studios    = $this->studio->all();
        $categories = $this->category->all();
        $actors     = $this->actor->all();

        require __DIR__ . '/../views/movies/create.php';
    }

    public function edit(int $id): void
    {
        $movie = $this->movie->find($id);
        if (!$movie) {
            http_response_code(404);
            echo "Film nem található.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => trim($_POST['title']),
                'studio_id'   => (int)$_POST['studio_id'],
                'director'    => trim($_POST['director']),
                'category_id' => (int)$_POST['category_id'],
                'age_rating'  => trim($_POST['age_rating']),
                'language'    => trim($_POST['language']),
                'subtitled'   => isset($_POST['subtitled']) ? 1 : 0,
                'description' => trim($_POST['description']),
                'poster_url'  => trim($_POST['poster_url']),
                'trailer_url' => trim($_POST['trailer_url'] ?? ''),
            ];

            $actorIds = $_POST['actors'] ?? [];

            $this->movie->update($id, $data, $actorIds);
            header("Location: /movies/$id");
            exit;
        }

        $studios    = $this->studio->all();
        $categories = $this->category->all();
        $actors     = $this->actor->all();

        require __DIR__ . '/../views/movies/edit.php';
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->movie->delete($id);
            header('Location: /movies');
            exit;
        }
    }
}