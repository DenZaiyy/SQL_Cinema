<?php
require_once 'app/DAO.php';

class GenreController
{
    public function listGenres()
    {
        $dao = new DAO();

        $sql = 'SELECT DISTINCT  g.id_genre, g.label
                FROM genre g, movie_genre mg
                WHERE g.id_genre = mg.id_genre
                ORDER BY label ASC';

        $genres = $dao->executeRequest($sql);
        require 'view/genre/listGenres.php';
    }

    public function detailGenre($id)
    {
        $dao = new DAO();

        $sql = 'SELECT f.id_film, f.title, DATE_FORMAT(f.date_release, "%Y") year, TIME_FORMAT(SEC_TO_TIME(f.duration*60),"%H:%i") duration, f.picture, g.label
                FROM film f, genre g, movie_genre mg
                WHERE mg.id_film = f.id_film
                AND mg.id_genre = g.id_genre
                AND g.id_genre = :id
                ORDER BY year DESC ';

        $params = ['id' => $id];

        $genres = $dao->executeRequest($sql, $params);
        require 'view/genre/detailGenre.php';
    }

    public function formGenre()
    {
        require 'view/genre/addGenre.php';
    }

    public function addGenre()
    {
        $dao = new DAO();
        $db = $dao->getBDD();

        if (isset($_POST['submit'])) {
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($label) {

                $sql = "INSERT INTO genre (label)
                        VALUES (:label)";

                $params = [
                    'label' => $label
                ];

                $addGenre = $dao->executeRequest($sql, $params);

                $id = $db->lastInsertId();
                $this->detailGenre($id);

                header('Location: index.php?action=detailGenre?id=' . $id);
            }
        } else {
            header('Location: index.php');
        }
    }
}
