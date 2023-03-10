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
}
