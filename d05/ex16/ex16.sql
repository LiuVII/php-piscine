SELECT COUNT(*) AS 'movies' FROM `member_history`
WHERE (DATE(date) >= DATE("2006-10-30") AND DATE(date) < DATE("2007-07-27"))
OR (EXTRACT(MONTH FROM date) = 12 AND EXTRACT(DAY FROM date) = 24);