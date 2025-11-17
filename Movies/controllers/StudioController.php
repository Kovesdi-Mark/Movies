<?php

namespace Controllers;

use Models\Studio;

class StudioController
{
    private Studio $studio;

    public function __construct()
    {
        $this->studio = new Studio();
    }

    public function index(): void
    {
        $studios = $this->studio->all();
        require __DIR__ . '/../views/studios/index.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->studio->create(['name' => trim($_POST['name'])]);
            header('Location: /studios');
            exit;
        }
        require __DIR__ . '/../views/studios/create.php';
    }

    public function edit(int $id): void
    {
        $studio = $this->studio->find($id);
        if (!$studio) { http_response_code(404); echo "Nem található."; return; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->studio->update($id, ['name' => trim($_POST['name'])]);
            header('Location: /studios');
            exit;
        }
        require __DIR__ . '/../views/studios/edit.php';
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->studio->delete($id);
            header('Location: /studios');
            exit;
        }
    }
}