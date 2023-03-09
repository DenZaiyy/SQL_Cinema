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

        $params = ['id' => $id];

        $films = $dao->executeRequest($sql, $params);
        require 'view/film/detailFilm.php';
    }
}
