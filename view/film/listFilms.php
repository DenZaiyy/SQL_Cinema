<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of films</h1>

        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
            <?php
            while ($film = $films->fetch()) { ?>

                <div>
                    <figure>
                        <a href="index.php?action=detailFilm&id=<?= $film['id_film']; ?>">
                            <img src="<?= $film["picture"]; ?>" alt="picture of film : <?= $film["title"]; ?>" width="310px" height="auto">
                        </a>
                    </figure>

                    <strong><?= $film['title'] ?></strong>
                </div>

            <?php }
            ?>
        </div>

    </div>
</div>







<?php
$title = "List of Films";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
