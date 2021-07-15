DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `reviewId` INT UNSIGNED NOT NULL PRIMARY KEY  AUTO_INCREMENT,
  `reviewText` TEXT COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` INT NOT NULL REFERENCES `inventory` (`invId`) ON DELETE CASCADE,
  `clientId` INT(10) NOT NULL REFERENCES `client` (`clientId`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `reviews`
  ADD CONSTRAINT `review_rfk_1` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`),
  ADD CONSTRAINT `review_rfk_2` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`);

SHOW CREATE TABLE reviews


