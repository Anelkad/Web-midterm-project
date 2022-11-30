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
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `title`, `description`, `category_id`) VALUES
(1, 'Education', 'All about education', 1),
(2, 'Marvel Universe', 'All about Marvel universe', 1),
(3, 'Movies', 'All about movies', 1),
(4, 'Careers', 'All about careers', 1),
(5, 'Web development', 'All about web dev', 1),
(6, 'Sports', 'All about sports', 1),
(7, 'Fitness', 'All about fitness', 1),
(8, 'Cybersecurity', 'All about cybersecurity', 1),
(9, 'Serials', 'All about serials', 1),
(10, 'Data science', 'All about data science', 1),
(11, 'Photography', 'All about photography', 1),
(12, 'Comedy', 'All about comedy', 1),
(13, 'K-pop', 'All about k-pop', 1),
(14, 'Machine learning', 'All about machine learning', 1),
(15, 'Small business', 'All about small business', 1),
(16, 'Scientists', 'All about scientists', 2),
(17, 'Dinosaurs', 'All about dinosaurs', 2),
(18, 'Science news', 'All about science news', 2),
(19, 'Agriculture', 'All about agriculture', 2),
(20, 'Geography', 'All about geography', 2),
(21, 'Geology', 'All about geology', 2),
(22, 'Weather', 'All about weather', 2),
(23, 'Chemistry', 'All about chemistry', 2),
(24, 'Space', 'All about space', 2),
(25, 'Space missions', 'All about space missions', 2),
(26, 'Supernatural', 'All about supernatural', 2),
(27, 'Earthquakes', 'All about earthquakes', 2),
(28, 'Zoology', 'All about zoology', 2),
(29, 'Paranormal', 'All about paranormal', 2),
(30, 'Blue Origin', 'All about blue origin', 2),
(31, 'ONE PIECE', 'All about ONE PIECE', 3),
(32, 'Anime', 'All about anime', 3),
(33, 'Comics', 'All about comics', 3),
(34, 'Animation', 'All about animation', 3),
(35, 'Animated films', 'All about animated films', 3),
(36, 'Disney', 'All about disney', 3),
(37, 'Concept art', 'All about concept art', 3),
(38, 'Pokemon', 'All about pokemon', 3),
(39, 'Naruto', 'All about naruto', 3),
(40, 'Attack on Titan', 'All about attack on titan', 3),
(41, 'Cartoons', 'All about cartoons', 3),
(42, 'Avatar', 'All about avatar', 3),
(43, '3D animation', 'All about 3D animation', 3),
(44, '2D animation', 'All about 2D animation', 3),
(45, 'Kaiju', 'All about Kaiju', 3),
(46, 'Black Pink', 'All about Black Pink', 4),
(47, 'BTS', 'All about BTS', 4),
(48, 'BTS', 'All about BTS', 4),
(49, 'Shakira', 'All about Shakira', 4),
(50, 'Lopez', 'All about Lopez', 4),
(51, 'Music news', 'All about music news', 4),
(52, 'Rap', 'All about rap', 4),
(53, 'Lady Gaga', 'All about Lady Gaga', 4),
(54, 'Pop', 'All about pop', 4),
(55, 'Elissa', 'All about Elissa', 4),
(56, 'Jass', 'All about Jass', 4),
(57, 'Cardi B', 'All about Cardi B', 4),
(58, 'Drake', 'All about Drake', 4),
(59, 'Latin pop', 'All about latin pop', 4),
(60, 'Swift', 'All about Swift', 4),
(61, 'Camping', 'All about camping', 5),
(62, 'Environment', 'All about environment', 5),
(63, 'Nature', 'All about nature', 5),
(64, 'Dogs', 'All about dogs', 5),
(65, 'Pets', 'All about pets', 5),
(66, 'Cats', 'All about cats', 5),
(67, 'Horses', 'All about horses', 5),
(68, 'Fishing', 'All about fishing', 5),
(69, 'Animals', 'All about animals', 5),
(70, 'Surfing', 'All about surfing', 5),
(71, 'Rabbits', 'All about rabbits', 5),
(72, 'Birdwatching', 'All about birds', 5),
(73, 'Sailing', 'All about sailing', 5),
(74, 'Sharks', 'All about sharks', 5),
(75, 'Hiking', 'All about hiking', 5),
(76, 'Pizza', 'All about pizza', 6),
(77, 'Cooking', 'All about cooking', 6),
(78, 'Vegetarian', 'All about vegetarian', 6),
(79, 'Organic foods', 'All about organic foods', 6),
(80, 'Food inspiration', 'All about food inspiration', 6),
(81, 'Chefs', 'All about chefs', 6),
(82, 'Fast food', 'All about fast food', 6),
(83, 'Brunch', 'All about brunch', 6),
(84, 'Tea', 'All about tea', 6),
(85, 'Baking', 'All about baking', 6),
(86, 'Cooking videos', 'All about cooking videos', 6),
(87, 'Spicy food', 'All about spicy food', 6),
(88, 'Burritos', 'All about burritos', 6),
(89, 'Pasta', 'All about pasta', 6),
(90, 'Cake decorations', 'All about cake decorations', 6),
(91, 'Rom-com films', 'All about rom-com films', 7),
(92, 'Bollywood films', 'All about Bollywood films', 7),
(93, 'Documentary films', 'All about documentary films', 7),
(94, 'Fantasy films', 'All about fantasy films', 7),
(95, 'Horror films', 'All about horror films', 7),
(96, 'Star Wars', 'All about Star Wars', 7),
(97, 'Harry Potter', 'All about Harry Potter', 7),
(98, 'Holiday films', 'All about holiday films', 7),
(99, 'Comedy films', 'All about comedy films', 7),
(100, 'Animated films', 'All about animated films', 7),
(101, 'Indie films', 'All about Indie films', 7),
(102, 'Spider Man', 'All about Spider Man', 7),
(103, 'Drama films', 'All about drama films', 7),
(104, 'Musicals', 'All about musicals', 7),
(105, 'Crime films', 'All about crime films', 7);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
