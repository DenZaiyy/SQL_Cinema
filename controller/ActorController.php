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

    public function formActor()
    {
        $dao = new DAO();

        $sql = 'SELECT id_film, title
                FROM film';

        $sql2 = 'SELECT id_role, label
                 FROM role';

        $films = $dao->executeRequest($sql);
        $roles = $dao->executeRequest($sql2);

        require 'view/actor/addActor.php';
    }

    public function addActor()
    {
        $dao = new DAO();
        $db = $dao->getBDD();

        if (isset($_POST['submit'])) {
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dob = $_POST['dateOfBirth'];
            $film = filter_input(INPUT_POST, "film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($firstname && $lastname && $gender && $dob && $film && $role) {

                $sql = "INSERT INTO person (firstname, lastname, gender, birthDate)
                        VALUES (:firstname, :lastname, :gender, :birthdate)";

                $sql2 = "INSERT INTO actor (id_person)
                         VALUES (LAST_INSERT_ID())";

                $sql3 = 'INSERT INTO casting (id_film, id_actor, id_role)
                         VALUES (:film, LAST_INSERT_ID(), :id_role)';

                $params = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'birthdate' => $dob
                ];

                $params2 = [
                    'film' => $film,
                    'id_role' => $role
                ];

                $addPerson = $dao->executeRequest($sql, $params);
                $addActor = $dao->executeRequest($sql2);

                $id = $db->lastInsertId();
                $this->detailActor($id);

                $addCasting = $dao->executeRequest($sql3, $params2);

                require 'view/actor/detailActor.php';
            }
        } else {
            header('Location: index.php');
        }
    }
}
