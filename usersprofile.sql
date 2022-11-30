-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 25 2022 г., 17:49
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
-- Структура таблицы `usersprofile`
--

CREATE TABLE `usersprofile` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `img` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(180) NOT NULL,
  `joined_date` varchar(100) CHARACTER SET utf8 NOT NULL,
  `followers_number` int(11) NOT NULL,
  `following_number` int(11) NOT NULL,
  `tweets_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `usersprofile`
--

INSERT INTO `usersprofile` (`id`, `full_name`, `username`, `img`, `description`, `joined_date`, `followers_number`, `following_number`, `tweets_number`) VALUES
(1, 'User', 'User49491', '\"https://cdn-icons-png.flaticon.com/512/456/456212.png\"', '', 'October 2022', 0, 0, 0),
(2, 'Anime', 'AllAnimeVibe', '\"https://pbs.twimg.com/profile_images/1595338330463412224/c8VjWWDf_400x400.jpg\"', 'Parody account | Posting all types of anime content! | I own no content posted', 'May 2019', 917351, 46, 1304),
(3, 'nickmuse', 'nickmuse', '\"https://pbs.twimg.com/profile_images/1581302653547577349/xxIvVkSm_400x400.jpg\"', 'dev', 'July 2009', 6796, 313, 254),
(4, 'Polterguys Game', 'PolterguysGame', '\"https://pbs.twimg.com/profile_images/1568258402266091521/H-R4Q0Vm_400x400.jpg\"', 'The official Twitter account for the Polterguys game!', 'May 2022', 58, 3, 38),
(5, 'Crockz', 'CrockzNFT', '\"https://pbs.twimg.com/profile_images/1583263674260766722/7cH2EFEA_400x400.jpg\"', '𝒐𝒉 𝑪𝒓𝒊𝒌𝒆𝒚! 𝑻𝒉𝒆 𝑪𝒓𝒐𝒄𝒌𝒛 𝒂𝒓𝒆 𝒐𝒏 𝒕𝒉𝒆 𝑳𝒐𝒐𝒔𝒆...', 'September 2021', 19937, 1, 61),
(6, 'Elon Musk', 'elonmusk', '\"https://pbs.twimg.com/profile_images/1590968738358079488/IY9Gx6Ok_400x400.jpg\"', '', 'June 2009', 118937517, 129, 20742),
(7, 'Qasym-Jomart Toqayev', 'TokayevKZ', '\"https://pbs.twimg.com/profile_images/1156552846013272064/E5Ks-y-H_400x400.jpg\"', 'President of the Republic of Kazakhstan', 'June 2009', 335726, 135, 8150),
(8, 'NASA', 'NASA', '\"https://pbs.twimg.com/profile_images/1321163587679784960/0ZxKlEKB_400x400.jpg\"', 'There\'s space for everybody. ✨', 'December 2007', 67367113, 185, 69267321),
(9, 'Twitter', 'Twitter', '\"https://pbs.twimg.com/profile_images/1488548719062654976/u6qfBBkF_400x400.jpg\"', 'What\'s happening?!', 'February 2007', 65367113, 5, 15383),
(10, 'SpaceX', 'SpaceX', '\"https://pbs.twimg.com/profile_images/1082744382585856001/rH_k3PtQ_400x400.jpg\"', 'SpaceX designs, manufactures and launches the world’s most advanced rockets and spacecraft', 'April 2009', 26475825, 99, 6320);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `usersprofile`
--
ALTER TABLE `usersprofile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `usersprofile`
--
ALTER TABLE `usersprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
