-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 jan 2019 om 10:43
-- Serverversie: 10.1.32-MariaDB
-- PHP-versie: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenshift`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `surname`, `user_id`) VALUES
(1, 'Usame', 'Yilanci', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `starthour` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `class`
--

INSERT INTO `class` (`class_id`, `instructor_id`, `date`, `starthour`, `student_id`) VALUES
(1, 1, '2019-01-28', 8, NULL),
(2, 1, '2019-01-29', 8, NULL),
(3, 1, '2019-01-30', 8, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instructor`
--

CREATE TABLE `instructor` (
  `instructor_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` text NOT NULL,
  `hours` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `name`, `surname`, `email`, `phone`, `hours`, `user_id`) VALUES
(1, 'Luuk', 'Burgers', 'abda@live.as', '0612321311', 3, 3),
(2, 'Pascal', 'Wouters', 'ashbdhas@live.nl', '0612312321', 12, 4),
(4, 'Pascal', 'Mariany', 'a@hotmail.com', '0614254678', 22, 24);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `packages`
--

CREATE TABLE `packages` (
  `packages_id` int(11) NOT NULL,
  `classes` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `adress` varchar(225) NOT NULL,
  `zip-code` varchar(10) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `student`
--

INSERT INTO `student` (`student_id`, `name`, `surname`, `adress`, `zip-code`, `email`, `phone`, `user_id`, `instructor_id`) VALUES
(1, 'abc', 'a', 'appelmoes 1', '1243 BK', 'usame.y@live.nl', '0683146888', 18, 1),
(2, 'Luuk', 'Burgers', 'Heilige Stoel', '6601FC', 'l@l.nl', '0615151515', 19, 2),
(3, 'b', 'b', 'a1', 'b', '1@live.nl', '0615141513', 28, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `student_packages`
--

CREATE TABLE `student_packages` (
  `student_packages_id` int(11) NOT NULL,
  `packages_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(3, 'burlu', 'test', 'instructor'),
(4, 'woupa', 'test', 'instructor'),
(18, 'a', 'a', 'student'),
(19, 'Lubusam', 'hoi123', 'student'),
(24, 'Marps', 'a', 'instructor'),
(28, 'b', 'b', 'student');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK_user_admin` (`user_id`);

--
-- Indexen voor tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `FK_instructor_class` (`instructor_id`),
  ADD KEY `FK_student_class` (`student_id`);

--
-- Indexen voor tabel `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_id`),
  ADD KEY `FK_user_instructor` (`user_id`);

--
-- Indexen voor tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packages_id`);

--
-- Indexen voor tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `FK_user_student` (`user_id`),
  ADD KEY `FK_instructor_student` (`instructor_id`);

--
-- Indexen voor tabel `student_packages`
--
ALTER TABLE `student_packages`
  ADD PRIMARY KEY (`student_packages_id`),
  ADD KEY `FK_student_studentpackages` (`student_id`),
  ADD KEY `FK_packages_studentpackage` (`packages_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `packages_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `student_packages`
--
ALTER TABLE `student_packages`
  MODIFY `student_packages_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_user_admin` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_instructor_class` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student_class` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `FK_user_instructor` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_instructor_student` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_student` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `student_packages`
--
ALTER TABLE `student_packages`
  ADD CONSTRAINT `FK_packages_studentpackage` FOREIGN KEY (`packages_id`) REFERENCES `packages` (`packages_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_student_studentpackages` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
