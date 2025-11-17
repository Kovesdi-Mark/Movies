<?php

namespace Controllers;

use Models\Rating;

class RatingController
{
    private Rating $rating;

    public function __construct()
    {
        $this->rating = new Rating();
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /movies');
            exit;
        }

        $movieId = (int)$_POST['movie_id'];
        $score   = (int)$_POST['rating'];

        if ($movieId > 0 && $score >= 1 && $score <= 5) {
            $this->rating->create($movieId, $score);
        }

        // Vissza a film részletes oldalára
        header("Location: /movies/$movieId");
        exit;
    }
}