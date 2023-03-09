<?php
require_once 'app/DAO.php';

class DirectorController
{
    public function listDirectors()
    {
        $dao = new DAO();

        $sql = "SELECT d.id_director, p.firstname, p.lastname, p.picture
                FROM director d INNER JOIN person p
                ON d.id_person = p.id_person
                ORDER BY p.lastname";

        $directors = $dao->executeRequest($sql);
        require 'view/director/listDirectors.php';
    }

    public function detailDirector($id)
    {
        $dao = new DAO();

        $sql = 'SELECT p.picture, p.lastname, p.firstname
                FROM director d, person p
                WHERE d.id_person = p.id_person
                AND d.id_director = :id';

        $sql2 = 'SELECT title, date_format(date_release, "%Y") Year, duration
                FROM film
                WHERE id_director = :id';

        $params = ['id' => $id];

        $cast = $dao->executeRequest($sql2, $params);
        $directors = $dao->executeRequest($sql, $params);
        require 'view/director/detailDirector.php';
    }
}
