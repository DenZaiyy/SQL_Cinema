<?php
require_once 'app/DAO.php';
require_once 'controller/DirectorController.php';

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

    public function formFilm()
    {
        $dao = new DAO();

        $sql = 'SELECT d.id_director, p.firstname, p.lastname, p.picture
                FROM director d INNER JOIN person p
                ON d.id_person = p.id_person';

        $sql2 = 'SELECT id_genre, label
                 FROM genre';

        $directors = $dao->executeRequest($sql);
        $genres = $dao->executeRequest($sql2);

        require 'view/film/addFilm.php';
    }

    public function addFilm()
    {
        $dao = new DAO();
        $db = $dao->getBDD();

        if (isset($_POST['submit'])) {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = $_POST['date'];
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $director = $_POST['directors'];

            if ($title && $date && $duration && $synopsis && $note && $director) {

                $sql = "INSERT INTO film (title, date_release, duration, synopsis, note, id_director)
                    VALUES (:title, :date, :duration, :synopsis, :note, :director)";

                $params = [
                    'title' => $title,
                    'date' => $date,
                    'duration' => $duration,
                    'synopsis' => $synopsis,
                    'note' => $note,
                    'director' => $director
                ];

                $addFilm = $dao->executeRequest($sql, $params);

                $id = $db->lastInsertId();
                $this->detailFilm($id);
                require 'view/film/detailFilm.php';
            }
        } else {
            header('Location: index.php');
        }
    }
}
