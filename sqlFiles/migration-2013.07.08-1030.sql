-- Create new tables
CREATE TABLE IF NOT EXISTS `actions` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 50 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `availabilities` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 50 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `buildingFloors` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `buildingID` int(10) unsigned NOT NULL,
  `floorID` int(10) unsigned NOT NULL,
  KEY `buildingID` (`buildingID`),
  KEY `floorID` (`floorID`)
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `functions` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 50 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `operatingSystems` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 50 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tableLocations` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 50 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tableNames` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tableTypeID` INT( 10 ) UNSIGNED NOT NULL,
  `buildingFloorID` INT( 10 ) UNSIGNED NOT NULL,
  `name` VARCHAR( 50 ) NOT NULL,
  KEY `tableTypeID` (`tableTypeID`),
  KEY `buildingFloorID` (`buildingFloorID`)
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tableTypes` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 50 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tableTypeLocs` (
  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tableTypeID` int(10) unsigned NOT NULL,
  `tableLocationID` int(10) unsigned NOT NULL,
  KEY `tableTypeID` (`tableTypeID`),
  KEY `tableLocationID` (`tableLocationID`)
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Normalize log actions
INSERT INTO `actions` (`ID`,`name`) VALUES (1,'login'),(2,'logoff');
UPDATE `log` SET `action`='1' WHERE `action`='login';
UPDATE `log` SET `action`='2' WHERE `action`='logoff';

ALTER TABLE `log` CHANGE `id`  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `log` CHANGE `action`  `actionID` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE `log` CHANGE `computer_id`  `computerID` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE `log` ADD INDEX (`actionID`);
ALTER TABLE `log` ADD INDEX (`computerID`);


-- Normalize availabilities
INSERT INTO `availabilities` (`ID`,`name`) VALUES (1,'available'),(2,'unavailable'),(3,'offline');
UPDATE `computers` SET `availability`='1' WHERE `availability`='available';
UPDATE `computers` SET `availability`='2' WHERE `availability`='unavailable';
UPDATE `computers` SET `availability`='3' WHERE `availability`='offline';
ALTER TABLE `computers` CHANGE `availability`  `availabilityID` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE `computers` ADD INDEX (`availabilityID`);


-- Normalize operating systems
INSERT INTO `operatingSystems` (`ID`,`name`) VALUES (1,'windows'),(2,'macintosh');
UPDATE `computers` SET `os`='1' WHERE `os`='windows';
UPDATE `computers` SET `os`='2' WHERE `os`='mac';
ALTER TABLE `computers` CHANGE `os`  `osID` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE `computers` ADD INDEX (`osID`);


-- Normalize functions
INSERT INTO `functions` (`ID`,`name`) VALUES (1,'standard'),(2,'multimedia');
UPDATE `computers` SET `function`='1' WHERE `function`='normal';
UPDATE `computers` SET `function`='2' WHERE `function`='multimedia';
ALTER TABLE `computers` CHANGE `function`  `functionID` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE `computers` ADD INDEX (`functionID`);


-- Normalize buildings and floors
INSERT INTO `buildingFloors` (`ID`,`buildingID`,`floorID`) VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,2,6),(7,2,2),(8,2,3);

ALTER TABLE `buildings` CHANGE  `building_id`  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `floors` DROP `building_id`;
ALTER TABLE `floors` CHANGE `id`  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `floors` CHANGE `floor_name`  `name` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `floors` CHANGE `floor`  `code` VARCHAR( 3 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
DELETE FROM `floors` WHERE `ID`='7';
DELETE FROM `floors` WHERE `ID`='8';


-- Normalize tables
INSERT INTO `tableTypes` (`ID`,`name`) VALUES (1,'leftHalfRound'),(2,'rightHalfRound'),(3,'lowerHalfRound'),(4,'upperHalfRound'),(5,'sixTriple'),(6,'lowerTriple'),(7,'upperTriple'),(8,'lowerClassroomTable'),(9,'rightTriple'),(10,'leftTriple'),(11,'upperClassroomTable'),(12,'fourCarrel'),(13,'sixCarrel'),(14,'round'),(15,'evlclassroom');
INSERT INTO `tableLocations` (`ID`,`name`) VALUES (1,'s'),(2,'sw'),(3,'w'),(4,'nw'),(5,'n'),(6,'i'),(7,'se'),(8,'e'),(9,'ne'),(10,'ll'),(11,'lr'),(12,'u'),(13,'l'),(14,'r'),(15,'ur'),(16,'ul'),(17,'m');
INSERT INTO `tableTypeLocs` (`ID`,`tableTypeID`,`tableLocationID`) VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,2,6),(8,2,1),(9,2,7),(10,2,8),(11,2,9),(12,2,5),(13,3,3),(14,3,2),(15,3,1),(16,3,7),(17,3,8),(18,3,6),(19,4,6),(20,4,8),(21,4,9),(22,4,5),(23,4,4),(24,4,3),(25,5,6),(26,5,8),(27,5,9),(28,5,5),(29,5,4),(30,5,3),(31,6,10),(32,6,11),(33,6,12),(34,7,10),(35,7,11),(36,7,12),(37,8,10),(38,8,11),(39,9,15),(40,9,11),(41,9,13),(42,10,14),(43,10,10),(44,10,16),(45,11,14),(46,11,13),(47,12,2),(48,12,4),(49,12,7),(50,12,9),(51,13,2),(52,13,3),(53,13,4),(54,13,7),(55,13,8),(56,13,9),(57,14,2),(58,14,3),(59,14,4),(60,14,9),(61,14,8),(62,14,7),(63,15,13),(64,15,17),(65,15,14);

ALTER TABLE `computers` ADD `tableLocationID` INT( 10 ) UNSIGNED NULL DEFAULT NULL AFTER `functionID`;
ALTER TABLE `computers` ADD INDEX (`tableLocationID`);
UPDATE `computers` SET `tableLocationID`='1' WHERE `table_location`='s';
UPDATE `computers` SET `tableLocationID`='2' WHERE `table_location`='sw';
UPDATE `computers` SET `tableLocationID`='3' WHERE `table_location`='w';
UPDATE `computers` SET `tableLocationID`='4' WHERE `table_location`='nw';
UPDATE `computers` SET `tableLocationID`='5' WHERE `table_location`='n';
UPDATE `computers` SET `tableLocationID`='6' WHERE `table_location`='i';
UPDATE `computers` SET `tableLocationID`='7' WHERE `table_location`='se';
UPDATE `computers` SET `tableLocationID`='8' WHERE `table_location`='e';
UPDATE `computers` SET `tableLocationID`='9' WHERE `table_location`='ne';
UPDATE `computers` SET `tableLocationID`='10' WHERE `table_location`='ll';
UPDATE `computers` SET `tableLocationID`='11' WHERE `table_location`='lr';
UPDATE `computers` SET `tableLocationID`='12' WHERE `table_location`='u';
UPDATE `computers` SET `tableLocationID`='13' WHERE `table_location`='l';
UPDATE `computers` SET `tableLocationID`='14' WHERE `table_location`='r';
UPDATE `computers` SET `tableLocationID`='15' WHERE `table_location`='ur';
UPDATE `computers` SET `tableLocationID`='16' WHERE `table_location`='ul';
UPDATE `computers` SET `tableLocationID`='17' WHERE `table_location`='m';
ALTER TABLE `computers` DROP `table_type`;
ALTER TABLE `computers` DROP `table_location`;

INSERT INTO `tableNames` (`ID`,`tableTypeID`,`buildingFloorID`,`name`) VALUES (1,1,2,'halfRound1'),(2,2,2,'halfRound2'),(3,1,2,'halfRound3'),(4,2,2,'halfRound4'),(5,1,2,'halfRound5'),(6,2,2,'halfRound6'),(7,3,2,'halfRound7'),(8,4,2,'halfRound8'),(9,2,2,'halfRound9'),(10,1,2,'halfRound10'),(11,2,2,'halfRound11'),(12,1,2,'halfRound12'),(13,1,2,'halfRound13'),(14,2,2,'halfRound14'),(15,3,3,'halfRound1'),(16,4,3,'halfRound2'),(17,1,4,'halfRound1'),(18,2,4,'halfRound2'),(19,3,4,'halfRound3'),(20,4,4,'halfRound4'),(21,3,4,'halfRound5'),(22,4,4,'halfRound6'),(23,1,5,'halfRound1'),(24,2,5,'halfRound2'),(25,3,5,'halfRound3'),(26,4,5,'halfRound4'),(27,3,5,'halfRound5'),(28,4,5,'halfRound6'),(29,5,1,'backTable1'),(30,7,1,'backTable2'),(31,6,1,'backTable3'),(32,5,1,'backTable4'),(33,8,1,'classroom1'),(34,8,1,'classroom2'),(35,8,1,'classroom3'),(36,8,1,'classroom4'),(37,8,1,'classroom5'),(38,8,1,'classroom6'),(39,8,1,'classroom7'),(40,8,1,'classroom8'),(41,8,1,'classroom9'),(42,8,1,'classroom10'),(43,8,1,'classroom11'),(44,8,1,'classroom12'),(45,8,1,'classroom13'),(46,8,1,'classroom14'),(47,8,1,'classroom15'),(48,8,1,'classroom16'),(49,10,1,'frontTriple1'),(50,9,1,'frontTriple2'),(51,10,1,'frontTriple3'),(52,9,1,'frontTriple4'),(53,11,1,'map1'),(54,12,7,'carrel1'),(55,13,7,'carrel2'),(56,12,7,'carrel3'),(57,12,7,'carrel4'),(58,13,7,'carrel5'),(59,12,7,'carrel6'),(60,14,7,'round1'),(61,14,7,'round2'),(62,14,7,'round3'),(63,14,7,'round4'),(64,15,7,'classroom1'),(65,15,7,'classroom2'),(66,15,7,'classroom3'),(67,15,7,'classroom4'),(68,15,7,'classroom5'),(69,15,7,'classroom6'),(70,15,7,'classroom7'),(71,15,7,'classroom8'),(72,15,7,'classroom9'),(73,15,7,'classroom10'),(74,3,3,'halfRound3'),(75,4,3,'halfRound4'),(76,3,3,'halfRound5'),(77,4,3,'halfRound6'),(78,3,3,'halfRound7'),(79,4,3,'halfRound8');

ALTER TABLE `computers` ADD `tableNameID` INT( 10 ) UNSIGNED NULL DEFAULT NULL AFTER `functionID`;
ALTER TABLE `computers` ADD INDEX (`tableNameID`);
UPDATE `computers` SET `tableNameID`='1' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound1';
UPDATE `computers` SET `tableNameID`='2' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound2';
UPDATE `computers` SET `tableNameID`='3' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound3';
UPDATE `computers` SET `tableNameID`='4' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound4';
UPDATE `computers` SET `tableNameID`='5' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound5';
UPDATE `computers` SET `tableNameID`='6' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound6';
UPDATE `computers` SET `tableNameID`='7' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound7';
UPDATE `computers` SET `tableNameID`='8' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound8';
UPDATE `computers` SET `tableNameID`='9' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound9';
UPDATE `computers` SET `tableNameID`='10' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound10';
UPDATE `computers` SET `tableNameID`='11' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound11';
UPDATE `computers` SET `tableNameID`='12' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound12';
UPDATE `computers` SET `tableNameID`='13' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound13';
UPDATE `computers` SET `tableNameID`='14' WHERE `building`='1' AND `floor`='1' AND `table_name`='halfRound14';
UPDATE `computers` SET `tableNameID`='15' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound1';
UPDATE `computers` SET `tableNameID`='16' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound2';
UPDATE `computers` SET `tableNameID`='17' WHERE `building`='1' AND `floor`='4' AND `table_name`='halfRound1';
UPDATE `computers` SET `tableNameID`='18' WHERE `building`='1' AND `floor`='4' AND `table_name`='halfRound2';
UPDATE `computers` SET `tableNameID`='19' WHERE `building`='1' AND `floor`='4' AND `table_name`='halfRound3';
UPDATE `computers` SET `tableNameID`='20' WHERE `building`='1' AND `floor`='4' AND `table_name`='halfRound4';
UPDATE `computers` SET `tableNameID`='21' WHERE `building`='1' AND `floor`='4' AND `table_name`='halfRound5';
UPDATE `computers` SET `tableNameID`='22' WHERE `building`='1' AND `floor`='4' AND `table_name`='halfRound6';
UPDATE `computers` SET `tableNameID`='23' WHERE `building`='1' AND `floor`='6' AND `table_name`='halfRound1';
UPDATE `computers` SET `tableNameID`='24' WHERE `building`='1' AND `floor`='6' AND `table_name`='halfRound2';
UPDATE `computers` SET `tableNameID`='25' WHERE `building`='1' AND `floor`='6' AND `table_name`='halfRound3';
UPDATE `computers` SET `tableNameID`='26' WHERE `building`='1' AND `floor`='6' AND `table_name`='halfRound4';
UPDATE `computers` SET `tableNameID`='27' WHERE `building`='1' AND `floor`='6' AND `table_name`='halfRound5';
UPDATE `computers` SET `tableNameID`='28' WHERE `building`='1' AND `floor`='6' AND `table_name`='halfRound6';
UPDATE `computers` SET `tableNameID`='29' WHERE `building`='1' AND `floor`='ll' AND `table_name`='backTable1';
UPDATE `computers` SET `tableNameID`='30' WHERE `building`='1' AND `floor`='ll' AND `table_name`='backTable2';
UPDATE `computers` SET `tableNameID`='31' WHERE `building`='1' AND `floor`='ll' AND `table_name`='backTable3';
UPDATE `computers` SET `tableNameID`='32' WHERE `building`='1' AND `floor`='ll' AND `table_name`='backTable4';
UPDATE `computers` SET `tableNameID`='33' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom1';
UPDATE `computers` SET `tableNameID`='34' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom2';
UPDATE `computers` SET `tableNameID`='35' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom3';
UPDATE `computers` SET `tableNameID`='36' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom4';
UPDATE `computers` SET `tableNameID`='37' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom5';
UPDATE `computers` SET `tableNameID`='38' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom6';
UPDATE `computers` SET `tableNameID`='39' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom7';
UPDATE `computers` SET `tableNameID`='40' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom8';
UPDATE `computers` SET `tableNameID`='41' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom9';
UPDATE `computers` SET `tableNameID`='42' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom10';
UPDATE `computers` SET `tableNameID`='43' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom11';
UPDATE `computers` SET `tableNameID`='44' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom12';
UPDATE `computers` SET `tableNameID`='45' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom13';
UPDATE `computers` SET `tableNameID`='46' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom14';
UPDATE `computers` SET `tableNameID`='47' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom15';
UPDATE `computers` SET `tableNameID`='48' WHERE `building`='1' AND `floor`='ll' AND `table_name`='classroom16';
UPDATE `computers` SET `tableNameID`='49' WHERE `building`='1' AND `floor`='ll' AND `table_name`='frontTriple1';
UPDATE `computers` SET `tableNameID`='50' WHERE `building`='1' AND `floor`='ll' AND `table_name`='frontTriple2';
UPDATE `computers` SET `tableNameID`='51' WHERE `building`='1' AND `floor`='ll' AND `table_name`='frontTriple3';
UPDATE `computers` SET `tableNameID`='52' WHERE `building`='1' AND `floor`='ll' AND `table_name`='frontTriple4';
UPDATE `computers` SET `tableNameID`='53' WHERE `building`='1' AND `floor`='ll' AND `table_name`='map1';
UPDATE `computers` SET `tableNameID`='54' WHERE `building`='2' AND `floor`='1' AND `table_name`='carrel1';
UPDATE `computers` SET `tableNameID`='55' WHERE `building`='2' AND `floor`='1' AND `table_name`='carrel2';
UPDATE `computers` SET `tableNameID`='56' WHERE `building`='2' AND `floor`='1' AND `table_name`='carrel3';
UPDATE `computers` SET `tableNameID`='57' WHERE `building`='2' AND `floor`='1' AND `table_name`='carrel4';
UPDATE `computers` SET `tableNameID`='58' WHERE `building`='2' AND `floor`='1' AND `table_name`='carrel5';
UPDATE `computers` SET `tableNameID`='59' WHERE `building`='2' AND `floor`='1' AND `table_name`='carrel6';
UPDATE `computers` SET `tableNameID`='60' WHERE `building`='2' AND `floor`='1' AND `table_name`='round1';
UPDATE `computers` SET `tableNameID`='61' WHERE `building`='2' AND `floor`='1' AND `table_name`='round2';
UPDATE `computers` SET `tableNameID`='62' WHERE `building`='2' AND `floor`='1' AND `table_name`='round3';
UPDATE `computers` SET `tableNameID`='63' WHERE `building`='2' AND `floor`='1' AND `table_name`='round4';
UPDATE `computers` SET `tableNameID`='64' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom1';
UPDATE `computers` SET `tableNameID`='65' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom2';
UPDATE `computers` SET `tableNameID`='66' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom3';
UPDATE `computers` SET `tableNameID`='67' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom4';
UPDATE `computers` SET `tableNameID`='68' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom5';
UPDATE `computers` SET `tableNameID`='69' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom6';
UPDATE `computers` SET `tableNameID`='70' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom7';
UPDATE `computers` SET `tableNameID`='71' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom8';
UPDATE `computers` SET `tableNameID`='72' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom9';
UPDATE `computers` SET `tableNameID`='73' WHERE `building`='2' AND `floor`='1' AND `table_name`='classroom10';
UPDATE `computers` SET `tableNameID`='74' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound3';
UPDATE `computers` SET `tableNameID`='75' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound4';
UPDATE `computers` SET `tableNameID`='76' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound5';
UPDATE `computers` SET `tableNameID`='77' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound6';
UPDATE `computers` SET `tableNameID`='78' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound7';
UPDATE `computers` SET `tableNameID`='79' WHERE `building`='1' AND `floor`='2' AND `table_name`='halfRound8';
ALTER TABLE `computers` DROP `floor`;
ALTER TABLE `computers` DROP `table_name`;
ALTER TABLE `computers` DROP `number`;

ALTER TABLE `computers` CHANGE `id`  `ID` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `computers` CHANGE `computer_name`  `name` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `computers` CHANGE `building`  `buildingID` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE `computers` ADD INDEX (`buildingID`);
