-- Версия сервера: Apache 8.0.16
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `agta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `el_book`
--

CREATE TABLE `el_book` (
  `el_book_id` int(10) UNSIGNED NOT NULL,
  `el_book_auth` varchar(100) NOT NULL DEFAULT '',
  `el_book_name` varchar(100) NOT NULL DEFAULT '',
  `el_book_date` varchar(100) NOT NULL DEFAULT '',
  `el_book_file` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `file_id` int(10) UNSIGNED NOT NULL,
  `file_host` varchar(100) NOT NULL DEFAULT '$url_file_site/',
  `file_dir` varchar(100) NOT NULL DEFAULT 'files/',
  `file_name` varchar(200) NOT NULL DEFAULT '',
  `file_count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(10) UNSIGNED NOT NULL,
  `gallery_filename` varchar(100) NOT NULL DEFAULT '',
  `gallery_section_id` int(10) NOT NULL DEFAULT '0',
  `gallery_comment` text NOT NULL,
  `gallery_comment_small` varchar(100) NOT NULL DEFAULT '',
  `gallery_date` varchar(20) NOT NULL DEFAULT '',
  `gallery_auth` varchar(100) NOT NULL DEFAULT '',
  `gallery_count` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_section`
--

CREATE TABLE `gallery_section` (
  `gallery_section_id` int(10) UNSIGNED NOT NULL,
  `gallery_section` varchar(20) NOT NULL DEFAULT '',
  `gallery_section_title` varchar(100) NOT NULL DEFAULT '',
  `gallery_section_comment` text NOT NULL,
  `gallery_section_access` varchar(100) NOT NULL DEFAULT '',
  `gallery_section_sort` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `methodics`
--

CREATE TABLE `methodics` (
  `methodics_id` int(10) UNSIGNED NOT NULL,
  `methodics_discipline` varchar(60) NOT NULL DEFAULT '',
  `methodics_auth` varchar(100) NOT NULL DEFAULT '',
  `methodics_name` varchar(100) NOT NULL DEFAULT '',
  `methodics_date` varchar(100) NOT NULL DEFAULT '',
  `methodics_file` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `news_id` int(10) UNSIGNED NOT NULL,
  `news_content` text NOT NULL,
  `news_section` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `news_public` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `news_date` varchar(100) NOT NULL DEFAULT '1169478238',
  `news_life` int(11) NOT NULL DEFAULT '30',
  `news_auth` varchar(30) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_public`
--

CREATE TABLE `news_public` (
  `id_public` int(10) UNSIGNED NOT NULL,
  `public_code` varchar(100) NOT NULL DEFAULT '',
  `public_title` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_section`
--

CREATE TABLE `news_section` (
  `id_section` int(10) UNSIGNED NOT NULL,
  `section_code` varchar(100) NOT NULL DEFAULT '',
  `section_title` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `page_name` varchar(100) NOT NULL DEFAULT '',
  `page_owner` varchar(100) NOT NULL DEFAULT '',
  `page_title` varchar(100) NOT NULL DEFAULT '',
  `page_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_answer`
--

CREATE TABLE `testing_answer` (
  `testing_answer_id` int(11) NOT NULL,
  `testing_questions_id` int(11) NOT NULL DEFAULT '0',
  `testing_de_id` int(11) NOT NULL DEFAULT '0',
  `testing_answer_content` varchar(100) NOT NULL DEFAULT '',
  `testing_answer_true` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_de`
--

CREATE TABLE `testing_de` (
  `testing_de_id` int(11) NOT NULL,
  `testing_disc_id` int(11) NOT NULL DEFAULT '0',
  `testing_de_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_disc`
--

CREATE TABLE `testing_disc` (
  `testing_disc_id` int(11) NOT NULL,
  `testing_disc_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_group`
--

CREATE TABLE `testing_group` (
  `testing_group_id` int(11) NOT NULL,
  `testing_group_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_questions`
--

CREATE TABLE `testing_questions` (
  `testing_questions_id` int(11) NOT NULL,
  `testing_de_id` int(11) NOT NULL DEFAULT '0',
  `testing_questions_content` varchar(100) NOT NULL DEFAULT '',
  `testing_questions_level` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_result`
--

CREATE TABLE `testing_result` (
  `testing_result_id` int(11) NOT NULL,
  `testing_disc_id` int(11) NOT NULL DEFAULT '0',
  `testing_users_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_resulttest`
--

CREATE TABLE `testing_resulttest` (
  `testing_resulttest_id` int(11) NOT NULL,
  `testing_result_id` int(11) NOT NULL DEFAULT '0',
  `testing_resultest_questions` int(11) NOT NULL DEFAULT '0',
  `testing_resultest_answer` int(11) NOT NULL DEFAULT '0',
  `testing_resultest_level` int(11) NOT NULL DEFAULT '0',
  `testing_resultest_true` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_test`
--

CREATE TABLE `testing_test` (
  `testing_test_id` int(11) NOT NULL,
  `testing_disc_id` int(11) NOT NULL DEFAULT '0',
  `testing_test_name` varchar(100) NOT NULL DEFAULT '',
  `testing_test_de1` int(11) NOT NULL DEFAULT '0',
  `testing_test_de2` int(11) NOT NULL DEFAULT '0',
  `testing_test_de3` int(11) NOT NULL DEFAULT '0',
  `testing_test_de4` int(11) NOT NULL DEFAULT '0',
  `testing_open` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `testing_users`
--

CREATE TABLE `testing_users` (
  `testing_users_id` int(11) NOT NULL,
  `testing_users_login` varchar(100) NOT NULL DEFAULT '',
  `testing_users_pass` varchar(100) NOT NULL DEFAULT '',
  `testing_users_group` int(11) NOT NULL DEFAULT '0',
  `testing_users_privilege` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `urls`
--

CREATE TABLE `urls` (
  `url_id` int(10) UNSIGNED NOT NULL,
  `url_name` char(200) NOT NULL DEFAULT '',
  `url_link` char(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_login` char(20) NOT NULL DEFAULT '',
  `user_name` char(50) NOT NULL DEFAULT '',
  `user_pass` char(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `el_book`
--
ALTER TABLE `el_book`
  ADD PRIMARY KEY (`el_book_id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Индексы таблицы `gallery_section`
--
ALTER TABLE `gallery_section`
  ADD PRIMARY KEY (`gallery_section_id`);

--
-- Индексы таблицы `methodics`
--
ALTER TABLE `methodics`
  ADD PRIMARY KEY (`methodics_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Индексы таблицы `news_public`
--
ALTER TABLE `news_public`
  ADD PRIMARY KEY (`id_public`);

--
-- Индексы таблицы `news_section`
--
ALTER TABLE `news_section`
  ADD PRIMARY KEY (`id_section`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Индексы таблицы `testing_answer`
--
ALTER TABLE `testing_answer`
  ADD PRIMARY KEY (`testing_answer_id`);

--
-- Индексы таблицы `testing_de`
--
ALTER TABLE `testing_de`
  ADD PRIMARY KEY (`testing_de_id`);

--
-- Индексы таблицы `testing_disc`
--
ALTER TABLE `testing_disc`
  ADD PRIMARY KEY (`testing_disc_id`);

--
-- Индексы таблицы `testing_group`
--
ALTER TABLE `testing_group`
  ADD PRIMARY KEY (`testing_group_id`);

--
-- Индексы таблицы `testing_questions`
--
ALTER TABLE `testing_questions`
  ADD PRIMARY KEY (`testing_questions_id`);

--
-- Индексы таблицы `testing_result`
--
ALTER TABLE `testing_result`
  ADD PRIMARY KEY (`testing_result_id`);

--
-- Индексы таблицы `testing_resulttest`
--
ALTER TABLE `testing_resulttest`
  ADD PRIMARY KEY (`testing_resulttest_id`);

--
-- Индексы таблицы `testing_test`
--
ALTER TABLE `testing_test`
  ADD PRIMARY KEY (`testing_test_id`);

--
-- Индексы таблицы `testing_users`
--
ALTER TABLE `testing_users`
  ADD PRIMARY KEY (`testing_users_id`);

--
-- Индексы таблицы `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`url_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `el_book`
--
ALTER TABLE `el_book`
  MODIFY `el_book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `gallery_section`
--
ALTER TABLE `gallery_section`
  MODIFY `gallery_section_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `methodics`
--
ALTER TABLE `methodics`
  MODIFY `methodics_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `news_public`
--
ALTER TABLE `news_public`
  MODIFY `id_public` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `news_section`
--
ALTER TABLE `news_section`
  MODIFY `id_section` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT для таблицы `testing_answer`
--
ALTER TABLE `testing_answer`
  MODIFY `testing_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `testing_de`
--
ALTER TABLE `testing_de`
  MODIFY `testing_de_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `testing_disc`
--
ALTER TABLE `testing_disc`
  MODIFY `testing_disc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `testing_group`
--
ALTER TABLE `testing_group`
  MODIFY `testing_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `testing_questions`
--
ALTER TABLE `testing_questions`
  MODIFY `testing_questions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `testing_result`
--
ALTER TABLE `testing_result`
  MODIFY `testing_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `testing_resulttest`
--
ALTER TABLE `testing_resulttest`
  MODIFY `testing_resulttest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `testing_test`
--
ALTER TABLE `testing_test`
  MODIFY `testing_test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `testing_users`
--
ALTER TABLE `testing_users`
  MODIFY `testing_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `urls`
--
ALTER TABLE `urls`
  MODIFY `url_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
