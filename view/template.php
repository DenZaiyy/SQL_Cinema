<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/css/uikit.min.css">
    <link rel="shortcut icon" href="../public/img/icons8-film-projector-48.png" type="image/x-icon">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <nav class="uk-navbar-container">
            <div class="uk-container">
                <div uk-navbar>

                    <div class="uk-navbar-left">

                        <ul class="uk-navbar-nav">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="index.php?action=listFilms">Films</a>
                            </li>
                            <li>
                                <a href="index.php?action=listActors">Actors</a>
                            </li>
                            <li>
                                <a href="index.php?action=listDirectors">Directors</a>
                            </li>
                            <li>
                                <a href="index.php?action=listGenres">Genres</a>
                            </li>
                            <li>
                                <a href="index.php?action=listRoles">Roles</a>
                            </li>
                        </ul>

                    </div>
                    <div class="uk-navbar-right">

                        <ul class="uk-navbar-nav">
                            <li>
                                <a href="#">Admin</a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li><a href="index.php?action=formFilm" class="uk-button uk-button-default">Add film</a></li>
                                        <li><a href="index.php?action=formDirector" class="uk-button uk-button-default uk-margin-small-top uk-disabled">Add director</a></li>
                                        <li><a href="index.php?action=formActor" class="uk-button uk-button-default uk-margin-small-top uk-disabled">Add actor</a></li>
                                        <li><a href="index.php?action=formRole" class="uk-button uk-button-default uk-margin-small-top uk-disabled">Add role</a></li>
                                        <li><a href="index.php?action=formGenre" class="uk-button uk-button-default uk-margin-small-top uk-disabled">Add genre</a></li>
                                        <!-- <li class="uk-nav-header">Header</li>
                                        <li><a href="#">Item</a></li>
                                        <li><a href="#">Item</a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="#">Item</a></li> -->
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer class="uk-flex uk-flex-center uk-flex-middle">
        <small>2023 &copy; Cinema - Cinema by <a href="https://github.com/DenZaiyy" target="_blank">KevinG</a></small>

    </footer>


    <script src="../public/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit.min.js" integrity="sha512-OZ9Sq7ecGckkqgxa8t/415BRNoz2GIInOsu8Qjj99r9IlBCq2XJlm9T9z//D4W1lrl+xCdXzq0EYfMo8DZJ+KA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit-icons.min.js" integrity="sha512-hcz3GoZLfjU/z1OyArGvM1dVgrzpWcU3jnYaC6klc2gdy9HxrFkmoWmcUYbraeS+V/GWSgfv6upr9ff4RVyQPw==" crossorigin="anonymous"></script>
</body>

</html>