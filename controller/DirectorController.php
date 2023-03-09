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
}
