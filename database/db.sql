-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `chunks`;
CREATE TABLE `chunks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `chunks` (`id`, `name`, `title`, `body`, `options`, `author`, `created_at`, `updated_at`, `status`) VALUES
(1,	'card-3',	'Card Three',	'Industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',	'[{\"name\":\"title\",\"value\":\"Card Three\"}]',	'Anonymous',	NULL,	'2019-08-21 13:45:33',	1),
(2,	'applicationsCreators',	'Applications Creators',	'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',	'[{\"name\":\"author_1_photo\",\"value\":\"icon.png\"},{\"name\":\"author_1_name\",\"value\":\"Author Name\"},{\"name\":\"author_1_post\",\"value\":\"PHP Developer\"},{\"name\":\"author_2_photo\",\"value\":\"icon.png\"},{\"name\":\"author_2_name\",\"value\":\"Author Name\"},{\"name\":\"author_2_post\",\"value\":\"JS Developer\"},{\"name\":\"author_3_photo\",\"value\":\"icon.png\"},{\"name\":\"author_3_name\",\"value\":\"Author Name\"},{\"name\":\"author_3_post\",\"value\":\"Python Developer\"}]',	'Anonymous',	NULL,	'2019-08-21 13:56:49',	1),
(3,	'mobileAdaptive',	'Mobile Adaptive',	'Morbi mattis ullamcorper velit. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Fusce convallis metus id felis luctus adipiscing. Aenean massa. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nulla consequat massa quis enim. Praesent venenatis metus at tortor pulvinar varius. Donec venenatis vulputate lorem. Phasellus accumsan cursus velit. Pellentesque ut neque.',	'[]',	'Anonymous',	NULL,	'2019-08-21 13:45:09',	1),
(11,	'header',	'Header',	'Praesent venenatis metus at tortor pulvinar varius. Donec venenatis vulputate lorem. Phasellus accumsan cursus velit.',	'[{\"name\":\"title\",\"value\":\"Page Title\"}]',	'Anonimus',	'2019-08-06 12:38:32',	'2019-08-27 10:33:32',	1),
(51,	'card-2',	'Card Two',	'Dolores esse fuga laudantium quasi vero! Alias autem error, ex explicabo hic illum magnam obcaecati. Assumenda ea id, iure non saepe veniam.',	'[{\"name\":\"title\",\"value\":\"Card Two\"}]',	'Anonymous',	'2019-08-12 11:30:05',	'2019-08-21 14:12:38',	1),
(52,	'environmentForApplication',	'Environment for application',	'Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Fusce convallis metus id felis luctus adipiscing. Aenean massa. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.\n\nNulla consequat massa quis enim. Praesent venenatis metus at tortor pulvinar varius. Donec venenatis vulputate lorem. Phasellus accumsan cursus velit. Pellentesque ut neque.',	'[]',	'Anonymous',	'2019-08-13 04:10:56',	'2019-08-21 14:00:00',	1),
(55,	'card-1',	'Card One',	'Ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis cumque earum, id ipsam saepe totam. Assumenda beatae delectus eligendi eveniet excepturi, illo ipsam itaque omnis quo saepe ullam.',	'[]',	'Anonymous',	'2019-08-13 13:42:41',	'2019-08-27 12:30:58',	1),
(57,	'mobileAdaptive',	'Мобильный Адаптивный',	'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).',	'[]',	'Anonymous',	NULL,	'2019-08-27 12:25:44',	1),
(58,	'header',	'Головатор',	'В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.',	'[]',	'Anonymous',	NULL,	'2019-08-27 12:26:42',	1),
(59,	'applicationsCreators',	'Создатели приложений',	'Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, \"consectetur\", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник',	'[{\"name\":\"author_1_photo\",\"value\":\"icon.png\"},{\"name\":\"author_1_name\",\"value\":\"Author Name\"},{\"name\":\"author_1_post\",\"value\":\"PHP Developer\"},{\"name\":\"author_2_photo\",\"value\":\"icon.png\"},{\"name\":\"author_2_name\",\"value\":\"Author Name\"},{\"name\":\"author_2_post\",\"value\":\"JS Developer\"},{\"name\":\"author_3_photo\",\"value\":\"icon.png\"},{\"name\":\"author_3_name\",\"value\":\"Author Name\"},{\"name\":\"author_3_post\",\"value\":\"Python Developer\"}]',	'Anonymous',	NULL,	'2019-08-27 12:29:05',	1),
(60,	'environmentForApplication',	'Окружающая среда для применения',	'Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или \"невозможных\" слов.',	'[]',	'Anonymous',	NULL,	'2019-08-27 12:29:56',	1),
(61,	'card-1',	'Карта один',	'Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь.',	'[]',	'Anonymous',	NULL,	'2019-08-27 12:31:05',	1),
(62,	'card-2',	'Карта два',	'Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца.',	'[]',	'Anonymous',	NULL,	'2019-08-27 12:31:31',	1),
(63,	'card-3',	'Карта три',	'За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).',	'[]',	'Anonymous',	NULL,	'2019-08-27 12:32:09',	1);

DROP TABLE IF EXISTS `mixins`;
CREATE TABLE `mixins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_chunk` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_chunk` (`id_chunk`),
  CONSTRAINT `mixins_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `mixins_ibfk_2` FOREIGN KEY (`id_chunk`) REFERENCES `chunks` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mixins` (`id`, `title`, `type`, `id_user`, `id_chunk`, `created_at`, `updated_at`, `status`) VALUES
(136,	'page',	'page',	2,	3,	NULL,	'2019-08-21 13:45:09',	0),
(137,	'page',	'page',	2,	1,	NULL,	'2019-08-21 13:45:33',	0),
(146,	'page',	'page',	2,	2,	NULL,	'2019-08-21 13:56:49',	0),
(151,	'page',	'page',	2,	52,	NULL,	'2019-08-21 14:00:00',	0),
(157,	'page',	'page',	2,	51,	NULL,	'2019-08-21 14:12:38',	0),
(161,	'page',	'page',	2,	11,	NULL,	'2019-08-27 10:33:32',	0),
(163,	'page_ru',	'page_ru',	2,	57,	NULL,	'2019-08-27 12:25:44',	0),
(164,	'page_ru',	'page_ru',	2,	58,	NULL,	'2019-08-27 12:26:42',	0),
(167,	'page_ru',	'page_ru',	2,	59,	NULL,	'2019-08-27 12:29:05',	0),
(168,	'page_ru',	'page_ru',	2,	60,	NULL,	'2019-08-27 12:29:56',	0),
(169,	'page',	'page',	2,	55,	NULL,	'2019-08-27 12:30:58',	0),
(170,	'page_ru',	'page_ru',	2,	61,	NULL,	'2019-08-27 12:31:05',	0),
(171,	'page_ru',	'page_ru',	2,	62,	NULL,	'2019-08-27 12:31:31',	0),
(172,	'page_ru',	'page_ru',	2,	63,	NULL,	'2019-08-27 12:32:09',	0);

-- 2019-08-28 16:29:48
