SELECT title, summary FROM film
WHERE title LIKE "%42%" OR summary LIKE "%42%"
ORDER BY char_length(title);