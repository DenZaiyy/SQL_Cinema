<?php
// {# gestion des requêtes et aiguilleur #}
// {# ajouter les sanitize, incl sur les array #}
// instanciation des contrôleurs
// require_once "controller/ActorController.php";
// require_once "controller/DirectorController.php";
// require_once "controller/FilmController.php";
// require_once "controller/GenreController.php";
// require_once "controller/HomeController.php";
// require_once "controller/RoleController.php";

spl_autoload_register(function ($class_name) {
    require_once 'controller/' . $class_name . '.php';
});

// variable declaration
$ctrActor = new ActorController();
$ctrDirector = new DirectorController();
// $ctrFilm = new FilmController();
// $ctrGenre = new GenreController();
$ctrHome = new HomeController();
// $ctrRole = new RoleController();

if (isset($_GET['action'])) {
    // if there is an id, get the id and use it.
    $id = (isset($_GET['id'])) ? $_GET['id'] : "";
    switch ($_GET['action']) {
            //insert here all the request to generate new page
            // add as the functions are added to fill all cases possible
            // LISTS 
        case "listActors":
            $ctrActor->listActors();
            break;
        case "listDirectors":
            $ctrDirector->listDirectors();
            break;
        case "listFilms":
            $ctrFilm->listFilms();
            break;
        case "listGenres":
            $ctrGenre->listGenres();
            break;
        case "listRoles":
            $ctrRole->listRoles();
            break;
            //DETAILS
            // case "detailActor":
            //     $ctrActor->detailActor($id);
            //     break;
        case "detailFilm":
            $ctrFilm->detailFilm($id);
            break;
            // case "detailDirector":
            //     $ctrDirector->detailDirector($id);
            //     break;
        case "detailGenre":
            $ctrGenre->detailGenre($id);
            break;
        case "detailRole":
            $ctrRole->detailRole($id);
            break;
    }
} else {
    $ctrHome->homePage();
}
