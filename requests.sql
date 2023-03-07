-- a : Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur
SELECT f.title "Titre de film", date_format(date_release, "%Y") "Année", TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') "Durée", CONCAT_WS(" ", p.lastname, p.firstname) "Réalisateur"
FROM film f, director d, person p
WHERE f.Id_director = d.Id_director
AND d.Id_person = p.Id_person
AND f.Id_film = 5

-- b : Liste des films dont la durée excède 2h15 classés par durée (du plus long au plus court)
SELECT title, DATE_FORMAT(date_release, "%Y") annee, TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') duree 
FROM film
WHERE duration > 135
ORDER BY duration DESC

-- c: Liste des films d’un réalisateur (en précisant l’année de sortie)
SELECT title, date_format(date_release, "%Y") annee
FROM film
WHERE Id_director = 3

-- d: Nombre de films par genre (classés dans l’ordre décroissant)
SELECT g.label Genre, COUNT(mg.Id_film) nbFilm
FROM movie_genre mg, genre g
WHERE mg.Id_genre = g.Id_genre
GROUP BY g.label
ORDER BY nbFilm DESC

-- e: Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT CONCAT_WS(" ", p.firstname,p.lastname) Realisateur, COUNT(f.Id_film) nbFilm
FROM person p, film f, director d
WHERE d.Id_director = f.Id_director
AND d.Id_person = p.Id_person
GROUP BY Realisateur
ORDER BY nbFilm DESC

-- f: Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
SELECT p.lastname, p.firstname, p.gender
FROM casting c, person p, film f, actor a
WHERE c.Id_actor = a.Id_actor
AND a.Id_person = p.Id_person
AND c.Id_film = f.Id_film
AND c.Id_film = 2

-- g: Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)

SELECT f.title "Titre de film", r.label "Rôle du film", DATE_FORMAT(f.date_release, "%Y") "Année"
FROM film f, role r, actor a, person p, casting c
WHERE a.Id_person = p.Id_person
AND c.Id_actor = a.Id_actor
AND c.Id_film = f.Id_film
AND c.Id_role = r.Id_role
AND c.Id_actor = 9

-- h: Listes des personnes qui sont à la fois acteurs et réalisateurs
SELECT CONCAT_WS(" ", p.lastname, p.firstname) Personne
FROM person p, actor a, director d
WHERE p.Id_person = a.Id_person
AND p.Id_person = d.Id_person

-- i: Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
SELECT title, DATE_FORMAT(date_release, "%Y") "Année", TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') "Durée"
FROM film
WHERE DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_release)),'%Y') < 5
ORDER BY date_release DESC

-- j: Nombre d’hommes et de femmes parmi les acteurs
SELECT COUNT(p.Id_person) Total, SUM(case when gender = "H" then 1 ELSE 0 END) Hommes, SUM(case when gender = "F" then 1 ELSE 0 END) Femmes
FROM person p, actor a
WHERE p.Id_person = a.Id_person

-- k: Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
SELECT CONCAT_WS(" ", UCASE(p.lastname), p.firstname) Acteurs, TIMESTAMPDIFF(YEAR, p.birthDate, CURDATE()) "Age révolu", TIMESTAMPDIFF(YEAR, p.birthDate, CURDATE()) +1  "Age non révolu"
FROM person p, actor a
WHERE p.Id_person = a.Id_person
AND p.birthdate < DATE_SUB(CURDATE(), INTERVAL 50 YEAR)

-- l: Acteurs ayant joué dans 3 films ou plus
SELECT CONCAT_WS(" ", UCASE(p.lastname), p.firstname) Acteur, COUNT(c.Id_film) NbFilm
FROM person p, actor a, casting c
WHERE c.Id_actor = a.Id_actor
AND a.Id_person = p.Id_person
GROUP BY Acteur
HAVING COUNT(c.Id_film) >= 3
ORDER BY NbFilm DESC