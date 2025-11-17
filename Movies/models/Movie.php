<?php

namespace Models;

use Config\Database;
use PDO;

class Movie
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /** Összes film lekérdezése szűrőkkel + átlag értékelés */
    public function all(array $filters = []): array
    {
        $sql = "SELECT 
                    m.*, 
                    s.name AS studio_name,
                    c.name AS category_name,
                    GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') AS actors,
                    AVG(r.rating) AS average_rating,
                    COUNT(r.id) AS rating_count
                FROM movies m
                LEFT JOIN studios s ON m.studio_id = s.id
                LEFT JOIN categories c ON m.category_id = c.id
                LEFT JOIN movie_actors ma ON m.id = ma.movie_id
                LEFT JOIN actors a ON ma.actor_id = a.id
                LEFT JOIN ratings r ON m.id = r.movie_id
                WHERE 1=1";

        $params = [];

        if (!empty($filters['studio'])) {
            $sql .= " AND s.name = :studio";
            $params[':studio'] = $filters['studio'];
        }
        if (!empty($filters['category'])) {
            $sql .= " AND c.name = :category";
            $params[':category'] = $filters['category'];
        }
        if (!empty($filters['actor'])) {
            $sql .= " AND a.name LIKE :actor";
            $params[':actor'] = '%' . $filters['actor'] . '%';
        }

        $sql .= " GROUP BY m.id ORDER BY m.title";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT 
                    m.*, 
                    s.name AS studio_name,
                    c.name AS category_name,
                    GROUP_CONCAT(DISTINCT a.id) AS actor_ids,
                    GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') AS actors,
                    AVG(r.rating) AS average_rating,
                    COUNT(r.id) AS rating_count
                FROM movies m
                LEFT JOIN studios s ON m.studio_id = s.id
                LEFT JOIN categories c ON m.category_id = c.id
                LEFT JOIN movie_actors ma ON m.id = ma.movie_id
                LEFT JOIN actors a ON ma.actor_id = a.id
                LEFT JOIN ratings r ON m.id = r.movie_id
                WHERE m.id = :id
                GROUP BY m.id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $movie = $stmt->fetch();

        if ($movie) {
            $movie['actor_ids'] = $movie['actor_ids'] ? explode(',', $movie['actor_ids']) : [];
        }
        return $movie ?: null;
    }

    public function create(array $data, array $actorIds = []): int
    {
        $sql = "INSERT INTO movies 
                (title, studio_id, director, category_id, age_rating, language, subtitled, description, poster_url, trailer_url)
                VALUES 
                (:title, :studio_id, :director, :category_id, :age_rating, :language, :subtitled, :description, :poster_url, :trailer_url)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title'       => $data['title'],
            ':studio_id'   => $data['studio_id'],
            ':director'    => $data['director'],
            ':category_id' => $data['category_id'],
            ':age_rating'  => $data['age_rating'],
            ':language'    => $data['language'],
            ':subtitled'   => $data['subtitled'] ?? 0,
            ':description' => $data['description'],
            ':poster_url'  => $data['poster_url'],
            ':trailer_url' => $data['trailer_url'] ?? null,
        ]);

        $movieId = (int)$this->db->lastInsertId();

        foreach ($actorIds as $actorId) {
            $this->db->prepare("INSERT INTO movie_actors (movie_id, actor_id) VALUES (?, ?)")
                     ->execute([$movieId, $actorId]);
        }

        return $movieId;
    }

    public function update(int $id, array $data, array $actorIds = []): bool
    {
        $sql = "UPDATE movies SET
                title = :title,
                studio_id = :studio_id,
                director = :director,
                category_id = :category_id,
                age_rating = :age_rating,
                language = :language,
                subtitled = :subtitled,
                description = :description,
                poster_url = :poster_url,
                trailer_url = :trailer_url
                WHERE id = :id";

        $data[':id'] = $id;
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($data);

        // Színészek frissítése
        $this->db->prepare("DELETE FROM movie_actors WHERE movie_id = ?")->execute([$id]);
        foreach ($actorIds as $actorId) {
            $this->db->prepare("INSERT INTO movie_actors (movie_id, actor_id) VALUES (?, ?)")
                     ->execute([$id, $actorId]);
        }

        return $result;
    }

    public function delete(int $id): bool
    {
        $this->db->prepare("DELETE FROM movie_actors WHERE movie_id = ?")->execute([$id]);
        $this->db->prepare("DELETE FROM ratings WHERE movie_id = ?")->execute([$id]);
        $stmt = $this->db->prepare("DELETE FROM movies WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}