<?php

namespace Controllers;

use Models\Actor;

class ActorController
{
    private Actor $actor;

    public function __construct()
    {
        $this->actor = new Actor();
    }

    public function index(): void
    {
        $actors = $this->actor->all();
        require __DIR__ . '/../views/actors/index.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->actor->create(['name' => trim($_POST['name'])]);
            header('Location: /actors');
            exit;
        }
        require __DIR__ . '/../views/actors/create.php';
    }

    public function edit(int $id): void
    {
        $actor = $this->actor->find($id);
        if (!$actor) { http_response_code(404); echo "Nem található."; return; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->actor->update($id, ['name' => trim($_POST['name'])]);
            header('Location: /actors');
            exit;
        }
        require __DIR__ . '/../views/actors/edit.php';
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->actor->delete($id);
            header('Location: /actors');
            exit;
        }
    }
}