<?php

namespace Models;

use Config\Database;
use PDO;

class Rating
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /** Egy film összes értékelése */
    public function getByMovieId(int $movieId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM ratings WHERE movie_id = ? ORDER BY created_at DESC");
        $stmt->execute([$movieId]);
        return $stmt->fetchAll();
    }

    /** Átlag és darabszám egy filmhez */
    public function getAverage(int $movieId): ?array
    {
        $stmt = $this->db->prepare("
            SELECT AVG(rating) AS average_rating, COUNT(*) AS rating_count 
            FROM ratings 
            WHERE movie_id = ?
        ");
        $stmt->execute([$movieId]);
        $result = $stmt->fetch();
        return $result['rating_count'] > 0 ? $result : null;
    }

    public function create(int $movieId, int $rating): bool
    {
        if ($rating < 1 || $rating > 5) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO ratings (movie_id, rating) VALUES (?, ?)");
        return $stmt->execute([$movieId, $rating]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM ratings WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}