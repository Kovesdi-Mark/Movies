-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Nov 17. 16:34
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `movie_app`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `actors`
--

INSERT INTO `actors` (`id`, `name`) VALUES
(1, 'Robert Downey Jr.'),
(2, 'Chris Evans'),
(3, 'Scarlett Johansson'),
(4, 'Chris Hemsworth'),
(5, 'Tom Holland'),
(6, 'Ryan Reynolds'),
(7, 'Dwayne Johnson'),
(8, 'Gal Gadot'),
(9, 'Leonardo DiCaprio'),
(10, 'Margot Robbie'),
(11, 'Cillian Murphy'),
(12, 'Zendaya');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Akció'),
(2, 'Sci-Fi'),
(3, 'Kaland'),
(4, 'Vígjáték'),
(5, 'Dráma'),
(6, 'Fantasy');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `studio_id` int(11) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `age_rating` varchar(50) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `subtitled` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `movies`
--

INSERT INTO `movies` (`id`, `title`, `studio_id`, `director`, `category_id`, `age_rating`, `language`, `subtitled`, `description`, `poster_url`, `trailer_url`) VALUES
(1, 'Bosszúállók: Végjáték', 1, 'Anthony Russo, Joe Russo', 1, '12+', 'angol', 1, 'A Marvel Moziverzum eddigi csúcspontja – a világ legnagyobb szuperhősei egyesítik erőiket Thanos ellen.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7RyHsO4DjXwuLE2OrfbQ0d9e3jd.jpg', 'https://www.youtube.com/watch?v=TcMBFSGVi1c'),
(2, 'Oppenheimer', 2, 'Christopher Nolan', 5, '16+', 'angol', 1, 'Az atombomba atyja, J. Robert Oppenheimer élete és a Manhattan-terv izgalmas története.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8Gxv8gSFC1y9a1fV6YHk3cL1SS.jpg', 'https://www.youtube.com/watch?v=uYPbbksJxIg'),
(3, 'Deadpool & Wolverine', 1, 'Shawn Levy', 1, '18+', 'angol', 1, 'A szájhős Deadpool és Rozsomák együtt száll szembe a multiverzum fenyegetésével – durva poénokkal és akcióval.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/jb5w7QzQo4q7zqY0zqB7J7F0QqI.jpg', 'https://www.youtube.com/watch?v=73_1biulkYk'),
(4, 'Dűne: Második rész', 2, 'Denis Villeneuve', 2, '12+', 'angol', 1, 'Paul Atreides folytatja harcát az Arrakis bolygóért és a fremenekkel együtt száll szembe a Harkonnenekkel.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8cdWvZJUe1JmqO3yTzyW2iG6R0Q.jpg', 'https://www.youtube.com/watch?v=_YUzQa_1dEu'),
(5, 'Barbie', 2, 'Greta Gerwig', 4, '12+', 'angol', 1, 'Barbie és Ken kalandja a való világban – színes, vicces és elgondolkodtató.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg', 'https://www.youtube.com/watch?v=pBk4NYhF7U0'),
(6, 'Top Gun: Maverick', 4, 'Joseph Kosinski', 1, '12+', 'angol', 1, '36 év után Maverick visszatér, hogy kiképezze a fiatal pilótákat egy lehetetlen küldetésre.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/62HCnUTziyWcpDaBO2i1DX17ljH.jpg', 'https://www.youtube.com/watch?v=giXco2jaZ_4'),
(7, 'A galaxis őrzői vol. 3', 1, 'James Gunn', 1, '12+', 'angol', 1, 'A csapat utolsó nagy kalandja – Rocket múltja és a High Evolutionary elleni harc.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg', 'https://www.youtube.com/watch?v=uG5P8uU1p8U'),
(8, 'John Wick Chapter 4', 5, 'Chad Stahelski', 1, '18+', 'angol', 1, 'John Wick a világ minden táján harcol a High Table ellen – még durvább, még látványosabb.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/vZloFAK7NmvMGKE7VkB5IQ9lR3E.jpg', 'https://www.youtube.com/watch?v=qEVUtrk8_B4'),
(9, 'Pókember: Nincs hazaút', 1, 'Jon Watts', 1, '12+', 'angol', 1, 'Peter Parker multiverzumos kalandja – minden idők egyik legnagyobb Marvel-filmje.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/uJYYizSuA9Y3DCs0qS4qWvHfZg4.jpg', 'https://www.youtube.com/watch?v=JfVOs4VSpmA'),
(10, 'Avatar: A víz útja', 5, 'James Cameron', 3, '12+', 'angol', 1, '13 évvel az első rész után Jake Sully és családja új kalandokba keveredik Pandora óceánjaiban.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg', 'https://www.youtube.com/watch?v=d9MyW72ELq0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `movie_actors`
--

CREATE TABLE `movie_actors` (
  `movie_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `movie_actors`
--

INSERT INTO `movie_actors` (`movie_id`, `actor_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 9),
(2, 11),
(3, 6),
(3, 7),
(4, 5),
(4, 12),
(5, 8),
(5, 10),
(6, 1),
(6, 7),
(7, 1),
(7, 2),
(7, 3),
(8, 7),
(9, 5),
(9, 12),
(10, 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `ratings`
--

INSERT INTO `ratings` (`id`, `movie_id`, `rating`, `created_at`) VALUES
(1, 1, 5, '2025-11-17 14:52:27'),
(2, 1, 5, '2025-11-17 14:52:27'),
(3, 1, 4, '2025-11-17 14:52:27'),
(4, 1, 5, '2025-11-17 14:52:27'),
(5, 1, 5, '2025-11-17 14:52:27'),
(6, 1, 4, '2025-11-17 14:52:27'),
(7, 1, 5, '2025-11-17 14:52:27'),
(8, 1, 5, '2025-11-17 14:52:27'),
(9, 2, 5, '2025-11-17 14:52:27'),
(10, 2, 5, '2025-11-17 14:52:27'),
(11, 2, 4, '2025-11-17 14:52:27'),
(12, 2, 5, '2025-11-17 14:52:27'),
(13, 2, 5, '2025-11-17 14:52:27'),
(14, 3, 5, '2025-11-17 14:52:27'),
(15, 3, 5, '2025-11-17 14:52:27'),
(16, 3, 5, '2025-11-17 14:52:27'),
(17, 3, 4, '2025-11-17 14:52:27'),
(18, 3, 5, '2025-11-17 14:52:27'),
(19, 3, 5, '2025-11-17 14:52:27'),
(20, 4, 5, '2025-11-17 14:52:27'),
(21, 4, 4, '2025-11-17 14:52:27'),
(22, 4, 5, '2025-11-17 14:52:27'),
(23, 4, 5, '2025-11-17 14:52:27'),
(24, 4, 5, '2025-11-17 14:52:27'),
(25, 4, 4, '2025-11-17 14:52:27'),
(26, 5, 5, '2025-11-17 14:52:27'),
(27, 5, 4, '2025-11-17 14:52:27'),
(28, 5, 5, '2025-11-17 14:52:27'),
(29, 5, 5, '2025-11-17 14:52:27'),
(30, 5, 4, '2025-11-17 14:52:27'),
(31, 6, 5, '2025-11-17 14:52:27'),
(32, 6, 5, '2025-11-17 14:52:27'),
(33, 6, 5, '2025-11-17 14:52:27'),
(34, 6, 4, '2025-11-17 14:52:27'),
(35, 7, 5, '2025-11-17 14:52:27'),
(36, 7, 5, '2025-11-17 14:52:27'),
(37, 7, 4, '2025-11-17 14:52:27'),
(38, 7, 5, '2025-11-17 14:52:27'),
(39, 8, 5, '2025-11-17 14:52:27'),
(40, 8, 5, '2025-11-17 14:52:27'),
(41, 8, 5, '2025-11-17 14:52:27'),
(42, 8, 4, '2025-11-17 14:52:27'),
(43, 9, 5, '2025-11-17 14:52:27'),
(44, 9, 5, '2025-11-17 14:52:27'),
(45, 9, 5, '2025-11-17 14:52:27'),
(46, 9, 5, '2025-11-17 14:52:27'),
(47, 9, 4, '2025-11-17 14:52:27'),
(48, 9, 5, '2025-11-17 14:52:27'),
(49, 10, 4, '2025-11-17 14:52:27'),
(50, 10, 5, '2025-11-17 14:52:27'),
(51, 10, 4, '2025-11-17 14:52:27'),
(52, 10, 5, '2025-11-17 14:52:27');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `studios`
--

CREATE TABLE `studios` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `studios`
--

INSERT INTO `studios` (`id`, `name`) VALUES
(1, 'Marvel Studios'),
(2, 'Warner Bros. Pictures'),
(3, 'Disney'),
(4, 'Universal Pictures'),
(5, '20th Century Studios');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studio_id` (`studio_id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD PRIMARY KEY (`movie_id`,`actor_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- A tábla indexei `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- A tábla indexei `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT a táblához `studios`
--
ALTER TABLE `studios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Megkötések a táblához `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD CONSTRAINT `movie_actors_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movie_actors_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`);

--
-- Megkötések a táblához `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
