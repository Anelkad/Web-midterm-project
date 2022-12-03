-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 02 2022 г., 06:08
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 7.4.30

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
-- Структура таблицы `postslist`
--

CREATE TABLE `postslist` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes_number` bigint(255) NOT NULL,
  `liked` tinyint(1) NOT NULL,
  `retweets_number` bigint(255) NOT NULL,
  `image_url` text NOT NULL,
  `posted_date` text NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `postslist`
--

INSERT INTO `postslist` (`id`, `title`, `user_id`, `likes_number`, `liked`, `retweets_number`, `image_url`, `posted_date`, `topic_id`) VALUES
(1, 'Mood', 2, 243, 0, 182, 'https://pbs.twimg.com/media/Fikqay9XoAAqDDS?format=jpg&name=large', 'November 27', 1),
(2, 'Getting back to gamedev more as the weather gets colder at night... Here\'s a lil watercolor I made though:', 3, 215, 0, 122, 'https://pbs.twimg.com/media/Ek3lkeVXEAIG2lK?format=jpg&name=large', 'October 21, 2020', 2),
(3, 'New mode: PG Body Bingo', 4, 153, 0, 85, 'https://pbs.twimg.com/media/Fi0e8TZWQAE5Oqf?format=jpg&name=medium', 'November 30', 3),
(4, 'Crockz Mint Information\r\n\r\nSuply: 5,555 | WL Mint Price: .022\r\n\r\nDate: 11/23 | Time: 11 AM EST\r\n\r\n-------------------------------------------------\r\n\r\n~ RT, Like + Tag Friends', 5, 90, 0, 12, '', 'November 21', 4),
(5, '', 6, 251, 0, 211, 'https://pbs.twimg.com/media/FipKW8TVsAA9zQm?format=jpg&name=small', 'November 28', 5),
(6, 'Working visit to New York.', 7, 250, 0, 189, 'https://pbs.twimg.com/media/FdhAr35X0AEWpZX?format=jpg&name=large', 'September 25', 6),
(7, 'Across NASA, we celebrated the Indigenous Native American culture and heritage that has been passed down from generation to generation for centuries. Check out our recap of #NativeAmericanHeritageMonth highlights from team members who take us higher.', 8, 165, 0, 99, 'https://pbs.twimg.com/media/FQpeUR6XsAYlbc4?format=jpg&name=900x900', '1h', 7),
(8, 'now you can search for really important things in your DMs', 9, 111, 0, 71, 'https://pbs.twimg.com/media/FOj0lgmX0A0Wnev?format=jpg&name=4096x4096', 'March 24', 8),
(9, 'Falcon 9 is vertical on pad 40 in Florida ahead of launch of the @ispace_inc HAKUTO-R Mission 1 – the first privately-led Japanese mission to land on the lunar surface', 10, 222, 0, 208, 'https://pbs.twimg.com/media/FixgQ_XUAAIU1Cp?format=jpg&name=small', 'November 29', 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `postslist`
--
ALTER TABLE `postslist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `postslist`
--
ALTER TABLE `postslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
