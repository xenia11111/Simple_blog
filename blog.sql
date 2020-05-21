CREATE TABLE `articles` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `summary content` text NOT NULL,
  `full content` text NOT NULL,
  PRIMARY KEY  (`id`)
); 

CREATE TABLE `comments` (
  `article_id` int(11) NOT NULL,
  `comment` text NOT NULL
); 

CREATE TABLE `users` (
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
); 
