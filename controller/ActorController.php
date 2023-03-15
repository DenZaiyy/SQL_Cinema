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

        $target_dir = "public/img/uploads/";
        $target_file = $target_dir . uniqid() . "-" . basename($_FILES['picture']['name']);
        $file_tmp = $_FILES['picture']['tmp_name'];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST['submit'])) {
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dob = $_POST['dateOfBirth'];
            $picture = $target_file;
            $film = filter_input(INPUT_POST, "film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($firstname && $lastname && $gender && $dob && $film && $role) {

                $sql = "INSERT INTO person (firstname, lastname, gender, birthDate, picture)
                        VALUES (:firstname, :lastname, :gender, :birthdate, :picture)";

                $sql2 = "INSERT INTO actor (id_person)
                         VALUES (LAST_INSERT_ID())";

                $sql3 = 'INSERT INTO casting (id_film, id_actor, id_role)
                         VALUES (:film, LAST_INSERT_ID(), :id_role)';

                $params = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'birthdate' => $dob,
                    'picture' => $picture
                ];

                $params2 = [
                    'film' => $film,
                    'id_role' => $role
                ];

                $check = getimagesize($_FILES["picture"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.<br>";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["picture"]["size"] > 200000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "svg"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & SVG files are allowed.<br>";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.<br>";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($file_tmp, $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["picture"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.<br>";
                    }
                }

                $addPerson = $dao->executeRequest($sql, $params);
                $addActor = $dao->executeRequest($sql2);
                $addCasting = $dao->executeRequest($sql3, $params2);

                $this->listActors();
            }
        } else {
            header('Location: index.php');
        }
    }
}
