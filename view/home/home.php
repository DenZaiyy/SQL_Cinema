<?php
ob_start(); //def :
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of films</h1>
        <p>We order this list by the most recent date</p>

        <div class="uk-grid-match uk-grid-small" uk-grid>

            <?php
            while ($film = $films->fetch()) { ?>

                <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                    <div class="uk-card uk-card-small uk-card-default uk-height-match">
                        <figure class="uk-padding-small uk-height-match uk-margin-remove">
                            <a href="index.php?action=detailFilm&id=<?= $film['id_film']; ?>">
                                <img src="<?= $film["picture"] ?>" alt="picture of <?= $film["title"] ?>" width="310px" height="auto">
                            </a>
                            <figcaption class="uk-text-center uk-margin-small-top">
                                <strong class="uk-margin-remove"><?= $film["title"] ?></strong>
                                <p class="uk-margin-remove">Duration: <?= $film["duration"] ?></p>
                                <p class="uk-margin-remove">Date of release: <?= $film["dateRealease"] ?></p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

            <?php }
            ?>
        </div>

    </div>
    <aside>

    </aside>
</div>





<?php
$title = "Home Page";
$content = ob_get_clean(); //def 
require "view/template.php";
