SELECT `name_cinema`, CEIL(AVG(`nb_seats`)) AS `average` FROM `cinema`
GROUP BY `name_cinema`;