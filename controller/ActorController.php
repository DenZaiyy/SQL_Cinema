<?php
require_once 'app/DAO.php';

class ActorController
{
    public function listActors()
    {
        $dao = new DAO();

        $sql = "SELECT a.id_actor, p.firstname, p.lastname, p.picture
                FROM actor a INNER JOIN person p
                ON a.id_person = p.id_person
                ORDER BY p.lastname";

        $actors = $dao->executeRequest($sql);
        require 'view/actor/listActors.php';
    }

    public function detailActor($id)
    {
        $dao = new DAO();

        $sql = 'SELECT p.picture, p.lastname, p.firstname
                FROM actor a, person p
                WHERE a.id_person = p.id_person
                AND a.id_actor = :id';

        $sql2 = 'SELECT f.title, r.label, DATE_FORMAT(f.date_release, "%Y") Year
                FROM film f, role r, actor a, person p, casting c
                WHERE a.id_person = p.id_person
                AND c.id_actor = a.id_actor
                AND c.id_film = f.id_film
                AND c.id_role = r.id_role
                AND c.id_actor = :id';

        $params = ['id' => $id];

        $actors = $dao->executeRequest($sql, $params);
        $cast = $dao->executeRequest($sql2, $params);
        require 'view/actor/detailActor.php';
    }
}
