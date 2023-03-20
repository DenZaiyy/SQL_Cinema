<?php
require_once 'app/DAO.php';

class GenreController
{
    // function permettant de récupérer la liste de tout les genres de films enregistrées en bdd
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

    // function permettant de récupérer la liste de tout les films étant associé a ce genre ci
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

    // function qui appel le formulaire d'ajout de nouveaux genres
    public function formGenre()
    {
        require 'view/genre/addGenre.php';
    }

    // function pour ajouter un nouveau genre en se basant sur le formulaire crée
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

                $this->listGenres();
            }
        } else {
            header('Location: index.php');
        }
    }
}
