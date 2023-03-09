-- a : Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur
SELECT f.title, date_format(date_release, "%Y") "year", TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') "duration", CONCAT_WS(" ", p.lastname, p.firstname) "director"
FROM film f, director d, person p
WHERE f.id_director = d.id_director
AND d.id_person = p.id_person
AND f.id_film = 5

-- b : Liste des films dont la durée excède 2h15 classés par durée (du plus long au plus court)
SELECT title, DATE_FORMAT(date_release, "%Y") "year", TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') duration 
FROM film
WHERE duration > 135
ORDER BY duration DESC

-- c: Liste des films d’un réalisateur (en précisant l’année de sortie)
SELECT title, date_format(date_release, "%Y") "year"
FROM film
WHERE id_director = 3

-- d: Nombre de films par genre (classés dans l’ordre décroissant)
SELECT g.label Genre, COUNT(mg.id_film) nbFilms
FROM movie_genre mg, genre g
WHERE mg.id_genre = g.id_genre
GROUP BY g.label
ORDER BY nbFilms DESC

-- e: Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT CONCAT_WS(" ", p.firstname,p.lastname) director, COUNT(f.id_film) nbFilms
FROM person p, film f, director d
WHERE d.id_director = f.id_director
AND d.id_person = p.id_person
GROUP BY director
ORDER BY nbFilms DESC

-- f: Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
SELECT f.title, p.lastname, p.firstname, p.gender
FROM casting c, person p, film f, actor a
WHERE c.id_actor = a.id_actor
AND a.id_person = p.id_person
AND c.id_film = f.id_film
AND c.id_film = 2

-- g: Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)

SELECT f.title, r.label "rôle", DATE_FORMAT(f.date_release, "%Y") "Year"
FROM film f, role r, actor a, person p, casting c
WHERE a.id_person = p.id_person
AND c.id_actor = a.id_actor
AND c.id_film = f.id_film
AND c.id_role = r.id_role
AND c.id_actor = 9

-- h: Listes des personnes qui sont à la fois acteurs et réalisateurs
SELECT CONCAT_WS(" ", p.lastname, p.firstname) Person
FROM person p, actor a, director d
WHERE p.id_person = a.id_person
AND p.id_person = d.id_person

-- i: Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
SELECT title, DATE_FORMAT(date_release, "%Y") "Year", TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') "Duration"
FROM film
WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_release)),'%Y') < 5
ORDER BY date_release DESC

-- j: Nombre d’hommes et de femmes parmi les acteurs
SELECT COUNT(p.id_person) Total, SUM(case when gender = "H" then 1 ELSE 0 END) Men, SUM(case when gender = "F" then 1 ELSE 0 END) Women
FROM person p, actor a
WHERE p.id_person = a.id_person

-- k: Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
SELECT CONCAT_WS(" ", UCASE(p.lastname), p.firstname) Actors, TIMESTAMPDIFF(YEAR, p.birthDate, CURDATE()) "Age révolu", TIMESTAMPDIFF(YEAR, p.birthDate, CURDATE()) +1  "Age non révolu"
FROM person p, actor a
WHERE p.id_person = a.id_person
AND p.birthdate < DATE_SUB(CURDATE(), INTERVAL 50 YEAR)

-- l: Acteurs ayant joué dans 3 films ou plus
SELECT CONCAT_WS(" ", UCASE(p.lastname), p.firstname) Actor, COUNT(c.id_film) NbFilms
FROM person p, actor a, casting c
WHERE c.id_actor = a.id_actor
AND a.id_person = p.id_person
GROUP BY Actor
HAVING COUNT(c.id_film) >= 3
ORDER BY NbFilms DESC