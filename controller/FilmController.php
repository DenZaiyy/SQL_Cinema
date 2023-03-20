<?php
require_once 'app/DAO.php';
require_once 'controller/DirectorController.php';

class FilmController
{
    // function qui permet de récupérer la liste de tout les films ajoutés en BDD
    public function listFilms()
    {
        $dao = new DAO();

        $sql = 'SELECT id_film, title, date_format(date_release, "%Y") year, duration, synopsis, note, picture 
                FROM film
                ORDER BY date_release DESC';

        $films = $dao->executeRequest($sql);
        require 'view/film/listFilms.php';
    }

    // function qui permet d'avoir un détail de film (casting) se basant sur son ID (référencer sur la bdd)
    public function detailFilm($id)
    {
        $dao = new DAO();

        $sql = 'SELECT id_film, title, date_format(date_release, "%Y") Year, duration, synopsis, note, picture
                FROM film
                WHERE id_film = :id
                ORDER BY date_release DESC';

        $sql2 = 'SELECT a.id_actor, p.id_person, r.id_role, p.lastname, p.firstname, p.gender, r.label
                 FROM casting c, person p, film f, actor a, role r
                 WHERE c.id_actor = a.id_actor
                 AND c.id_role = r.id_role
                 AND a.id_person = p.id_person
                 AND c.id_film = f.id_film
                 AND c.id_film = :id';

        $params = ['id' => $id];

        $films = $dao->executeRequest($sql, $params);
        $castings = $dao->executeRequest($sql2, $params);
        require 'view/film/detailFilm.php';
    }

    // function qui permet de récupérer la liste des réalisateurs à l'ajout d'un film et renvoie vers le formulaire pour ajouter un nouveau film
    public function formFilm()
    {
        $dao = new DAO();

        $sql = 'SELECT d.id_director, p.firstname, p.lastname, p.picture
                FROM director d INNER JOIN person p
                ON d.id_person = p.id_person';

        $sql2 = 'SELECT id_genre, label
                 FROM genre';

        $directors = $dao->executeRequest($sql);
        $genres = $dao->executeRequest($sql2);

        require 'view/film/addFilm.php';
    }

    // function qui permet d'ajouter un film en base de données à l'aide de son formulaire crée
    // On fitre les input pour éviter les fails de sécurité, puis on filtre l'upload d'image pour éviter d'upload autre chose qu'une image ainsi que sa taille
    public function addFilm()
    {
        $dao = new DAO();
        $db = $dao->getBDD();

        $target_dir = "public/img/uploads/"; //chemin ou l'image va être upload
        $target_file = $target_dir . uniqid() . "-" . basename($_FILES['picture']['name']); //chemin du fichier avec le nom contenant un id unique + extension du fichier
        $file_tmp = $_FILES['picture']['tmp_name']; //le nom temporaire qui va être utiliser pour l'upload sur le serveur
        $uploadOk = 1; //initialisation du statu d'upload à 1
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //permet de récuperer l'extension du fichier à upload

        if (isset($_POST['submit'])) {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = $_POST['date'];
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $picture = $target_file;
            $director = $_POST['directors'];

            $genre = $_POST['id_genre'];

            if ($title && $date && $duration && $synopsis && $note && $picture && $director && $genre) {

                $sql = "INSERT INTO film (title, date_release, duration, synopsis, note, picture, id_director)
                    VALUES (:title, :date, :duration, :synopsis, :note, :picture, :director)";

                $sql2 = 'INSERT INTO movie_genre (id_film, id_genre)
                         VALUES (LAST_INSERT_ID(), :id_genre)';

                $params = [
                    'title' => $title,
                    'date' => $date,
                    'duration' => $duration,
                    'synopsis' => $synopsis,
                    'note' => $note,
                    'picture' => $picture,
                    'director' => $director
                ];

                $params2 = [
                    'id_genre' => $genre
                ];

                $check = getimagesize($_FILES["picture"]["tmp_name"]); //vérifie si le fichier est une vrai image ou non
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

                $addFilm = $dao->executeRequest($sql, $params);
                $addGenre = $dao->executeRequest($sql2, $params2);

                $this->listFilms();
            }
        } else {
            header('Location: index.php');
        }
    }

    public function deleteFilm($id)
    {
        if (isset($_POST['submit'])) {
            $dao = new DAO();

            $sql2 = 'DELETE FROM film
                    WHERE id_film = :id';

            $params = ['id' => $id];

            $delete = $dao->executeRequest($sql2, $params);

            header('location: index.php');
        } else {
            echo "Erreur de suppression";
        }
    }

    // Function permettant la recherche de film dans la barre de recherche se situant dans la nav
    public function searchFilm()
    {
        if (isset($_POST['s'])) {

            $dao = new DAO();

            $key = "%{$_POST['s']}%";

            $sql = 'SELECT * FROM film
                    WHERE title
                    LIKE ?
                    LIMIT 5';

            $params = [$key];

            $stmt = $dao->executeRequest($sql, $params);

            $results = $stmt->fetchAll();

            if ($stmt->rowCount() > 0) {
                foreach ($results as $result) { ?>
                    <li>
                        <a href="index.php?action=detailFilm&id=<?= $result['id_film'] ?>"><?= $result['title'] ?></a>
                    </li>
<?php }
            } else {
                echo "not found";
            }
        }
    }
}
