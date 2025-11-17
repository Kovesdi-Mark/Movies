<?php

namespace Controllers;

use Models\Category;

class CategoryController
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index(): void
    {
        $categories = $this->category->all();
        require __DIR__ . '/../views/categories/index.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->create(['name' => trim($_POST['name'])]);
            header('Location: /categories');
            exit;
        }
        require __DIR__ . '/../views/categories/create.php';
    }

    public function edit(int $id): void
    {
        $category = $this->category->find($id);
        if (!$category) { http_response_code(404); echo "Nem található."; return; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->update($id, ['name' => trim($_POST['name'])]);
            header('Location: /categories');
            exit;
        }
        require __DIR__ . '/../views/categories/edit.php';
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->delete($id);
            header('Location: /categories');
            exit;
        }
    }
}