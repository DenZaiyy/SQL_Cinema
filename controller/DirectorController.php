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

            if ($firstname && $lastname && $gender && $dob && $picture) {

                $sql = "INSERT INTO person (firstname, lastname, gender, birthDate, picture)
                        VALUES (:firstname, :lastname, :gender, :birthdate, :picture)";

                $params = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'birthdate' => $dob,
                    'picture' => $picture
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

                $sql2 = "INSERT INTO director (id_person)
                         VALUES (LAST_INSERT_ID())";

                $addPerson = $dao->executeRequest($sql, $params);
                $id = $db->lastInsertId();
                $this->detailDirector($id);
                $addDirector = $dao->executeRequest($sql2);
            }
        } else {
            header('Location: index.php');
        }
    }
}
