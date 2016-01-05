

<?php
include("../db/db.php");


$create_db=mysql_query("create database vms_nethram");
mysql_query("use vms_nethram");
$create_categories=mysql_query("CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7") ;



$add_categories=mysql_query("INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Music'),
(2, 'Movie'),
(3, 'Tech')");



$create_settings=mysql_query("CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s3_upload` int(11) DEFAULT NULL,
  `720p` int(11) DEFAULT NULL,
  `360p` int(11) DEFAULT NULL,
  `240p` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6");



$create_videos=mysql_query("CREATE TABLE IF NOT EXISTS `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `thumnail` varchar(256) NOT NULL,
  `s3_url` varchar(1024) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ");



$create_vid_cat=mysql_query("CREATE TABLE IF NOT EXISTS `vid_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `video_id` (`video_id`,`cat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52");


$alter_vid_cat=mysql_query("
	ALTER TABLE `vid_cat`
  ADD CONSTRAINT `vid_cat_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`video_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vid_cat_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE");

if($alter_vid_cat)
{
  header("location:../index.php");
}
else
{
  echo "Something went wrong... Read installation guide carefully and try again..!!";
}
