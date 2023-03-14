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

    public function formDirector()
    {
        $dao = new DAO();

        $sql = 'SELECT id_film, title
                FROM film';

        $sql2 = 'SELECT id_role, label
                 FROM role';

        $films = $dao->executeRequest($sql);
        $roles = $dao->executeRequest($sql2);

        require 'view/director/addDirector.php';
    }

    public function addDirector()
    {
        $dao = new DAO();
        $db = $dao->getBDD();

        if (isset($_POST['submit'])) {
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dob = $_POST['dateOfBirth'];
            $film = filter_input(INPUT_POST, "film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($firstname && $lastname && $gender && $dob && $film) {

                $sql = "INSERT INTO person (firstname, lastname, gender, birthDate)
                        VALUES (:firstname, :lastname, :gender, :birthdate)";

                $params = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'birthdate' => $dob
                ];

                $sql2 = "INSERT INTO director (id_person)
                         VALUES (LAST_INSERT_ID())";

                if ($film !== "") {
                    $sql3 = 'INSERT INTO film (id_director)
                         VALUES (:director, LAST_INSERT_ID(), :id_role)';

                    $params2 = [
                        'director' => $film
                    ];

                    $addToFilm = $dao->executeRequest($sql3, $params2);
                }

                $addPerson = $dao->executeRequest($sql, $params);
                $addDirector = $dao->executeRequest($sql2);

                $id = $db->lastInsertId();
                $this->detailDirector($id);

                require 'view/director/detailDirector.php';
            }
        } else {
            header('Location: index.php');
        }
    }
}
