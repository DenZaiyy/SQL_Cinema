<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/css/uikit.min.css">
    <link rel="shortcut icon" href="../public/img/icons8-film-projector-48.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit.min.js" integrity="sha512-OZ9Sq7ecGckkqgxa8t/415BRNoz2GIInOsu8Qjj99r9IlBCq2XJlm9T9z//D4W1lrl+xCdXzq0EYfMo8DZJ+KA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit-icons.min.js" integrity="sha512-hcz3GoZLfjU/z1OyArGvM1dVgrzpWcU3jnYaC6klc2gdy9HxrFkmoWmcUYbraeS+V/GWSgfv6upr9ff4RVyQPw==" crossorigin="anonymous"></script>
    <script src="app/script.js"></script>
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

                        <div class="uk-margin-right">
                            <form class="uk-search uk-search-default">
                                <span uk-search-icon></span>
                                <input class="uk-search-input" type="search" name="searchbar" placeholder="Search" id="input" autocomplete="off" aria-label="Search">
                                <ul uk-dropdown="mode: click" id="dropdown" class="uk-list uk-list-divider uk-link-text"></ul>
                            </form>
                        </div>

                        <ul class="uk-navbar-nav">
                            <li>
                                <a href="#">Admin</a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class="uk-nav-header">Add</li>
                                        <li><a href="index.php?action=formFilm">Add film</a></li>
                                        <li><a href="index.php?action=formDirector">Add director</a></li>
                                        <li><a href="index.php?action=formActor">Add actor</a></li>
                                        <li><a href="index.php?action=formRole">Add role</a></li>
                                        <li><a href="index.php?action=formGenre">Add genre</a></li>
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
</body>

</html>