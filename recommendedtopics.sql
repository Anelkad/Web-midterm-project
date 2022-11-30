-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 29 2022 г., 17:15
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `recommendedtopics`
--

CREATE TABLE `recommendedtopics` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `recommendedtopics`
--

INSERT INTO `recommendedtopics` (`id`, `topic_id`) VALUES
(134, 1),
(135, 2),
(136, 3),
(86, 4),
(82, 5),
(26, 6),
(79, 7),
(28, 8),
(29, 9),
(30, 10),
(31, 11),
(32, 12),
(33, 13),
(34, 14),
(39, 15),
(83, 16),
(137, 17),
(4, 18),
(5, 19),
(6, 20),
(21, 21),
(36, 22),
(19, 23),
(10, 24),
(20, 25),
(12, 26),
(13, 27),
(14, 28),
(15, 29),
(16, 30),
(76, 31),
(45, 32),
(46, 33),
(47, 34),
(48, 35),
(138, 36),
(50, 37),
(51, 38),
(52, 39),
(53, 40),
(54, 41),
(55, 42),
(56, 43),
(57, 44),
(58, 45),
(84, 46),
(61, 47),
(62, 48),
(63, 49),
(64, 50),
(65, 51),
(66, 52),
(67, 53),
(68, 54),
(69, 55),
(70, 56),
(85, 57),
(72, 58),
(73, 59),
(74, 60),
(88, 61),
(89, 63),
(90, 64),
(91, 65),
(92, 66),
(93, 67),
(94, 68),
(95, 69),
(96, 70),
(97, 71),
(98, 72),
(99, 73),
(100, 74),
(101, 75),
(102, 76),
(103, 77),
(104, 78),
(105, 79),
(106, 80),
(107, 81),
(108, 82),
(109, 83),
(110, 84),
(111, 85),
(112, 86),
(113, 87),
(114, 88),
(115, 89),
(116, 90),
(117, 91),
(118, 92),
(119, 93),
(120, 94),
(121, 95),
(122, 96),
(123, 97),
(124, 98),
(125, 99),
(126, 100),
(127, 101),
(128, 102),
(129, 103),
(130, 104),
(131, 105);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `recommendedtopics`
--
ALTER TABLE `recommendedtopics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topic_id` (`topic_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `recommendedtopics`
--
ALTER TABLE `recommendedtopics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
