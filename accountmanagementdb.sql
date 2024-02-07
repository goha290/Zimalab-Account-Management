-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 07 2024 г., 02:15
-- Версия сервера: 5.7.24
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `accountmanagementdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(320) NOT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `secondaryPhone` varchar(20) DEFAULT NULL,
  `alternatePhone` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `firstName`, `lastName`, `emailAddress`, `companyName`, `position`, `phoneNumber`, `secondaryPhone`, `alternatePhone`) VALUES
(69, 'Leonid', 'Sergeev', 'leonid@mail.ru', '', '', '', '', ''),
(66, 'Arina', 'Iriske', 'arina@rambler.ru', '', '', '', '', ''),
(65, 'Fedor', 'Babaykin', 'fedor@gmail.com', 'Zimalab', 'Backend Developer', '89137780911', '', ''),
(64, 'Aleksey', 'Priluchny', 'aleksey@yandex.ru', 'Zimalab', 'Frontend Developer', '89135567781', '89023456177', ''),
(63, 'Irina', 'Fedorova', 'irina@mail.ru', 'Zimalab', 'Data Analyst', '89990000123', '', ''),
(62, 'Georgyi', 'Antonov', 'georgiy@icloud.com', 'Zimalab', 'Backend Developer', '89137093313', '', ''),
(59, 'Andrew', 'Popov', 'andrew@yandex.ru', 'Zimalab', 'HR Manager', '89137893144', '', ''),
(61, 'Kirill', 'Gorohov', 'kirill@gmail.com', 'Zimalab', 'Frontend Developer', '89687653341', '89539010133', '89023422132'),
(60, 'Maksim', 'Amashev', 'maksim@yandex.ru', 'Zimalab', 'PHP Developer', '89137771344', '89026762366', ''),
(58, 'Bezdeleva', 'Angelina', 'angelina@icloud.com', 'Zimalab', 'QA engineer', '89855759919', '', ''),
(68, 'Egor', 'Zyablitsev', 'egor@icloud.com', 'Zimalab', 'Fullstack Developer', '89137091350', '89855759919', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
