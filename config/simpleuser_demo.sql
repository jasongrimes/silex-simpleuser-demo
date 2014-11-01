
--
-- Use this to reset the demo database periodically, with a crontab like this:
--
-- 0 * * * * root /usr/bin/mysql --defaults-extra-file={mysql.cnf} {db} < /path/to/silex-simpleuser-demo/config/simpleuser_demo.sql
--

TRUNCATE TABLE user_custom_fields;
LOCK TABLES `user_custom_fields` WRITE;
/*!40000 ALTER TABLE `user_custom_fields` DISABLE KEYS */;
INSERT INTO `user_custom_fields` VALUES (1,'twitterUsername','@jason_grimes'),(2,'twitterUsername',''),(3,'twitterUsername','');
/*!40000 ALTER TABLE `user_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

TRUNCATE TABLE users;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (id, email, password, salt, roles, name, time_created)
VALUES (1,'jason@grimesit.com','yY2SobUMvwpGMW0tnOCN1r1X/ZG6IrPm2tAn98Y6yU5eY2vbQwXK7cCbj6xH3pAKvo/fUqXPQCWaTPbtBjyHQw==','k94xf6eulyookwooo0ookc4g0o4gcwg','ROLE_USER','Jason Grimes',1410732423),(2,'admin@example.com','GZvr4yFKRLkai8kr9Td1Pzl2B9/00DLDyrQytg49+Gh7ZFz5H88YQL6u/v1JSjjeMlFRLkfo+KJv5E996saaXQ==','dih3xah826o84o80gs088ccwggog8kc','ROLE_ADMIN,ROLE_USER','Ms. Admin',1410914863),(3,'user@example.com','S2pv8CgH0fxRGUFW8/Dc93FXSYTxR5oUmC2qNcsKjt5HPI6IWgdnrvc8u5BPWSPhaazaD6ir5BYeTYeW0LVgRg==','9t57m85zu8848cck0wkookwgg0ccw0c','ROLE_USER','Mr. User',1410960296);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
