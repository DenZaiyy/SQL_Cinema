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
}
