-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 09 2021 г., 22:03
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `datereg` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` smallint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `datereg`, `email`, `status`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2021-02-09 20:47:23', 'adminn@unknown.ru', 2),
(2, 'user0', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'fda@unknown.ru', 1),
(3, 'user1', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'asdfsad@unknown.ru', 1),
(4, 'user2', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'asfsaf@unknown.ru', 1),
(5, 'user3', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'asfsafa@unknown.ru', 1),
(6, 'user4', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'aasf@unknown.ru', 1),
(7, 'user5', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', '23525@unknown.ru', 1),
(8, 'user6', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', '235325@unknown.ru', 1),
(9, 'user7', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'a325@unknown.ru', 1),
(10, 'user8', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'an@unknown.ru', 1),
(11, 'user9', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'nn@unknown.ru', 1),
(12, 'user10', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'ainn@unknown.ru', 1),
(13, 'user11', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'an@unknown.ru', 1),
(14, 'user12', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'au898nn@unknown.ru', 1),
(15, 'user13', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'au8l8uln@unknown.ru', 1),
(16, 'user14', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'au8ln@unknown.ru', 1),
(17, 'user15', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'a888888n@unknown.ru', 1),
(18, 'user16', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', '8888888888nn@unknown.ru', 1),
(19, 'user17', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'a88888nn@unknown.ru', 1),
(20, 'user18', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'a888inn@unknown.ru', 1),
(21, 'user19', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'ad8888@unknown.ru', 1),
(22, 'user20', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'a8888nn@unknown.ru', 1),
(23, 'user21', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', 'a8888nn@unknown.ru', 1),
(24, 'user22', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', '2021-02-09 20:47:23', '88888n@unknown.ru', 1),
(25, 'user23', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '2021-02-09 20:47:23', 'u8888881@mail.ru', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
