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
-- Структура таблицы `trends`
--

CREATE TABLE `trends` (
  `id` int(11) NOT NULL,
  `title` varchar(80) CHARACTER SET utf8 NOT NULL,
  `subtitle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tweets` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `trends`
--

INSERT INTO `trends` (`id`, `title`, `subtitle`, `tweets`) VALUES
(1, 'Казахстане', 'Trending in Kazakhstan', 0),
(2, 'Скоро', 'Trending in Kazakhstan', 6790),
(3, 'Алматы', 'Trending in Kazakhstan', 0),
(4, 'Поздравляю', 'Trending in Kazakhstan', 2735),
(5, '#Astana', 'Trending in Kazakhstan', 1758),
(6, 'Пусть', 'Trending in Kazakhstan', 5142),
(7, 'Кстати', 'Trending in Kazakhstan', 5831);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `trends`
--
ALTER TABLE `trends`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `trends`
--
ALTER TABLE `trends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
