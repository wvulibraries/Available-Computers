ALTER TABLE `log` ADD INDEX (`time`);

INSERT INTO `functions` (`ID`,`name`) VALUES (3,'laptop'),(4,'studyroom');

INSERT INTO `computers` (`buildingID`,`name`,`availabilityID`,`osID`,`functionID`) VALUES (1,'DCL-01',1,1,3),(1,'DCL-02',1,1,3),(1,'DCL-03',1,1,3),(1,'DCL-04',1,1,3),(1,'DCL-05',1,1,3),(1,'DCL-06',1,1,3),(1,'DCL-07',1,1,3),(1,'DCL-08',1,1,3),(1,'DCL-09',1,1,3),(1,'DCL-10',1,1,3),(1,'DCL-11',1,1,3),(1,'DCL-12',1,1,3),(1,'DCL-13',1,1,3),(1,'DCL-14',1,1,3),(1,'DCL-15',1,1,3),(1,'DCL-16',1,1,3),(1,'DCL-17',1,1,3),(1,'DCL-18',1,1,3),(1,'DCL-19',1,1,3),(1,'DCL-20',1,1,3),(1,'DCL-21',1,1,3),(1,'DCL-22',1,1,3),(1,'DCL-23',1,1,3),(1,'DCL-24',1,1,3),(1,'DCL-25',1,1,3),(1,'DCL-26',1,1,3),(1,'DCL-27',1,1,3),(1,'DCL-28',1,1,3),(1,'DCL-29',1,1,3),(1,'DCL-30',1,1,3),(1,'DCL-31',1,1,3),(1,'DCL-32',1,1,3),(1,'DCL-33',1,1,3),(1,'DCL-34',1,1,3),(1,'DCL-35',1,1,3),(1,'DCL-36',1,1,3),(1,'DCL-37',1,1,3),(1,'DCL-38',1,1,3),(1,'DCL-39',1,1,3),(1,'DCL-40',1,1,3),(1,'DCL-61',1,1,3),(1,'DCL-62',1,1,3),(1,'DCL-63',1,1,3),(1,'DCL-64',1,1,3),(1,'DCL-65',1,1,3),(1,'DCL-66',1,1,3),(1,'DCL-67',1,1,3),(1,'DCL-68',1,1,3),(1,'DCL-69',1,1,3),(1,'DCL-70',1,1,3),(1,'DCL-71',1,1,3),(1,'DCL-72',1,1,3),(1,'DCL-73',1,1,3),(1,'DCL-74',1,1,3),(1,'DCL-75',1,1,3),(1,'DCL-76',1,1,3),(1,'DCL-77',1,1,3),(1,'DCL-78',1,1,3),(1,'DCL-79',1,1,3),(2,'EVL-01',1,1,3),(2,'EVL-02',1,1,3),(2,'EVL-03',1,1,3),(2,'EVL-04',1,1,3),(2,'EVL-05',1,1,3),(2,'EVL-06',1,1,3),(2,'EVL-07',1,1,3),(2,'EVL-08',1,1,3),(2,'EVL-09',1,1,3),(2,'EVL-10',1,1,3),(2,'EVL-11',1,1,3),(2,'EVL-12',1,1,3),(2,'EVL-13',1,1,3),(2,'EVL-14',1,1,3),(2,'EVL-15',1,1,3),(1,'DCL-MacBook-081',1,2,3),(1,'DCL-MacBook-082',1,2,3),(1,'DCL-MacBook-083',1,2,3),(1,'DCL-MacBook-084',1,2,3),(1,'DCL-MacBook-085',1,2,3),(1,'DCL-MacBook-086',1,2,3),(1,'DCL-MacBook-087',1,2,3),(1,'DCL-MacBook-088',1,2,3),(1,'DCL-MacBook-089',1,2,3),(1,'DCL-MacBook-090',1,2,3),(1,'DCL-MacBook-091',1,2,3),(1,'DCL-MacBook-092',1,2,3),(1,'DCL-MacBook-093',1,2,3),(1,'DCL-MacBook-094',1,2,3),(1,'DCL-MacBook-095',1,2,3),(1,'DCL-MacBook-096',1,2,3),(1,'DCL-MacBook-097',1,2,3),(1,'DCL-MacBook-098',1,2,3),(1,'DCL-MacBook-099',1,2,3),(1,'DCL-MacBook-100',1,2,3),(1,'DCL-MacBook-101',1,2,3),(1,'DCL-MacBook-102',1,2,3),(1,'DCL-MacBook-103',1,2,3),(1,'DCL-MacBook-104',1,2,3),(1,'DCL-MacBook-105',1,2,3),(1,'DCL-MacBook-106',1,2,3),(1,'DCL-MacBook-107',1,2,3),(1,'DCL-MacBook-108',1,2,3),(1,'DCL-MacBook-109',1,2,3),(1,'DCL-MacBook-110',1,2,3),(1,'DCL-MacBook-111',1,2,3),(1,'DCL-MacBook-112',1,2,3),(1,'DCL-MacBook-113',1,2,3),(1,'DCL-MacBook-114',1,2,3),(1,'DCL-MacBook-115',1,2,3),(1,'DCL-MacBook-116',1,2,3),(1,'DCL-MacBook-117',1,2,3),(1,'DCL-MacBook-118',1,2,3),(1,'DCL-MacBook-119',1,2,3),(1,'DCL-MacBook-120',1,2,3),(1,'DCL-MacBook-121',1,2,3),(1,'DCL-MacBook-122',1,2,3),(1,'DCL-MacBook-123',1,2,3),(1,'DCL-MacBook-124',1,2,3),(1,'DCL-MacBook-125',1,2,3),(1,'DCL-MacBook-126',1,2,3),(1,'DCL-MacBook-127',1,2,3),(1,'DCL-MacBook-128',1,2,3),(1,'DCL-MacBook-129',1,2,3),(1,'DCL-MacBook-130',1,2,3),(1,'DCL-MacBook-131',1,2,3),(1,'DCL-MacBook-132',1,2,3),(1,'DCL-MacBook-133',1,2,3),(1,'DCL-MacBook-134',1,2,3),(1,'DCL-MacBook-135',1,2,3),(1,'DCL-MacBook-136',1,2,3),(1,'DCL-MacBook-137',1,2,3),(1,'DCL-MacBook-138',1,2,3),(1,'DCL-MacBook-139',1,2,3),(1,'DCL-MacBook-140',1,2,3),(2,'EVL-MacBook-001',1,2,3),(2,'EVL-MacBook-002',1,2,3),(2,'EVL-MacBook-003',1,2,3),(2,'EVL-MacBook-004',1,2,3),(2,'EVL-MacBook-005',1,2,3),(2,'EVL-MacBook-006',1,2,3),(2,'EVL-MacBook-007',1,2,3),(2,'EVL-MacBook-008',1,2,3),(2,'EVL-MacBook-009',1,2,3),(2,'EVL-MacBook-010',1,2,3),(1,'DLCP-LL-114',1,1,4),(1,'DLCP-LL-124',1,1,4),(1,'DLCP-LL-134',1,1,4),(1,'DLCP-1-1028TV',1,1,4),(1,'DLCP-4-4000A-TV',1,1,4),(1,'DLCP-4-4000B-TV',1,1,4),(1,'DLCP-4-4000C-TV',1,1,4),(1,'DLCP-4-4000D-TV',1,1,4),(1,'DLCP-4-4036-TV',1,1,4),(1,'DLCP-4-4038-TV',1,1,4),(1,'DLCP-6-6000A-TV',1,1,4),(1,'DLCP-6-6000B-TV',1,1,4),(1,'DLCP-6-6000C-TV',1,1,4),(1,'DLCP-6-6000D-TV',1,1,4),(1,'DLCP-6-6036-TV',1,1,4),(1,'DLCP-6-6038-TV',1,1,4);
