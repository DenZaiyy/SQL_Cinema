<?php
require_once 'app/DAO.php';

class FilmController
{
    public function listFilms()
    {
        $dao = new DAO();

        $sql = 'SELECT id_film, title, date_format(date_release, "%Y") year, duration, synopsis, note, picture 
                FROM film
                ORDER BY date_release DESC';

        $films = $dao->executeRequest($sql);
        require 'view/film/listFilms.php';
    }

    public function detailFilm($id)
    {
        $dao = new DAO();

        $sql = 'SELECT title, date_format(date_release, "%Y") Year, duration, synopsis, note, picture
                FROM film
                WHERE id_film = :id
                ORDER BY date_release DESC';

        $sql2 = 'SELECT p.id_person, p.lastname, p.firstname, p.gender, r.label
                 FROM casting c, person p, film f, actor a, role r
                 WHERE c.id_actor = a.id_actor
                 AND c.id_role = r.id_role
                 AND a.id_person = p.id_person
                 AND c.id_film = f.id_film
                 AND c.id_film = :id';

        $params = ['id' => $id];

        $films = $dao->executeRequest($sql, $params);
        $castings = $dao->executeRequest($sql2, $params);
        require 'view/film/detailFilm.php';
    }

    public function addFilm($title, $date, $duration, $synopsis, $note, $picture)
    {
        $dao = new DAO();


        $sql = "INSERT INTO film (title, date_release, duration, synopsis, note, picture)
                VALUES (:title, :date, :duration, :synopsis, :note, :picture";

        $params = [
            'title' => $title,
            'date' => $date,
            'duration' => $duration,
            'synopsis' => $synopsis,
            'note' => $note,
            'picture' => $picture
        ];
    }
}
