-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 23 2022 г., 06:38
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userimg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `lists`
--

INSERT INTO `lists` (`id`, `title`, `img`, `user`, `username`, `userimg`) VALUES
(2, 'RUSSIA news', '"https://pbs.twimg.com/list_banner_img/1469633749386207236/_YhQuvny?format=jpg&name=900x900"', 'Douh Abdeslam', '@DAdeslam', '"https://pbs.twimg.com/profile_images/1570960909362728960/b4rERZBz_400x400.jpg"'),
(4, 'Ukraine', '"https://pbs.twimg.com/list_banner_img/1499112773690793996/mQFv92yU?format=jpg&name=900x900"', 'Vincent Luyendijk', '@vincentl75', '"https://pbs.twimg.com/profile_images/1563527241354866689/kGEenW5X_400x400.jpg"'),
(5, 'Turkmenistan', '"https://pbs.twimg.com/list_banner_img/1525236174633193472/JIKjxTGK?format=jpg&name=900x900"', 'Nina L. Diamond', '@ninatypewriter', '"https://pbs.twimg.com/profile_images/458687512395788289/1MfaX0M0_400x400.jpeg"'),
(6, '#TeamPixel', '"https://pbs.twimg.com/list_banner_img/1422899160886517766/dutA-gNU?format=jpg&name=small"', 'Michael Brown', '@ABrownMichael', '"https://pbs.twimg.com/profile_images/1589734552083341319/lZ6gnm7O_400x400.jpg"');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
