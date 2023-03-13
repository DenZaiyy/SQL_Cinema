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

    public function formFilm()
    {
        require 'view/film/addFilm.php';
    }

    public function addFilm()
    {
        $dao = new DAO();
        $db = $dao->getBDD();


        if (isset($_POST['submit']) || !empty($_POST['submit'])) {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = $_POST['date'];
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $picture = $_POST['picture'];

            $sql = "INSERT INTO film (title, date_release, duration, synopsis, note, picture)
                VALUES (':title', ':date', ':duration', ':synopsis', ':note', ':picture'";

            $params = [
                'title' => $title,
                'date' => $date,
                'duration' => $duration,
                'synopsis' => $synopsis,
                'note' => $note,
                'picture' => $picture
            ];

            if ($title && $date && $duration) {
                $dao->executeRequest($sql, $params);
                $id = $db->lastInsertId();
                $this->detailFilm($id);
                require 'view/film/detailFilm.php';
            }
        } else {
            header('Location: index.php');
        }
    }
}
