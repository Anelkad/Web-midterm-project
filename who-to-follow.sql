-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 21 2022 г., 08:40
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
-- Структура таблицы `who-to-follow`
--

CREATE TABLE `who-to-follow` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `img` varchar(200) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `who-to-follow`
--

INSERT INTO `who-to-follow` (`id`, `name`, `img`, `username`, `description`) VALUES
(1, 'SpaceX', '\"https://pbs.twimg.com/profile_images/1082744382585856001/rH_k3PtQ_400x400.jpg\"', 'SpaceX', 'SpaceX designs, manufactures and launches the world’s most advanced rockets and spacecraft'),
(2, 'Twitter', '\"https://pbs.twimg.com/profile_images/1488548719062654976/u6qfBBkF_400x400.jpg\"', 'Twitter', 'What\'s happening?!'),
(3, 'NASA', '\"https://pbs.twimg.com/profile_images/1321163587679784960/0ZxKlEKB_400x400.jpg\"', 'NASA', 'There\'s space for everybody. ✨');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `who-to-follow`
--
ALTER TABLE `who-to-follow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `who-to-follow`
--
ALTER TABLE `who-to-follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
