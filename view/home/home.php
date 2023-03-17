<?php
ob_start(); //def :
?>

<div class="uk-section uk-section-secondary">
    <h1 class="uk-heading-line uk-text-center"><span>Last releases</span></h1>
    <h2 class="uk-text-center">The 5 most recent movies</h2>

    <div class="uk-grid-match uk-flex-center" uk-grid>

        <?php
        while ($film = $films->fetch()) { ?>

            <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                <div class="uk-card uk-card-small uk-card-default uk-height-match uk-border-rounded ">
                    <figure class="uk-height-match uk-margin-remove uk-border-rounded">
                        <a href="index.php?action=detailFilm&id=<?= $film['id_film']; ?>">
                            <img class="uk-border-rounded" src="<?= $film["picture"] ?>" alt="picture of <?= $film["title"] ?>" width="310px" height="auto">
                        </a>
                        <figcaption class="uk-text-center uk-margin-small-top uk-margin-small-bottom">
                            <a class="uk-link-toggle" href="index.php?action=detailFilm&id=<?= $film['id_film']; ?>"><strong class="uk-margin-remove"><?= $film["title"] ?></strong></a>
                            <p class="uk-margin-remove">Duration: <?= $film["duration"] ?></p>
                            <p class="uk-margin-remove">Date of release: <?= $film["dateRealease"] ?></p>
                            <p class="uk-margin-remove">Note: <?= $film["note"] ?>/5</p>
                        </figcaption>
                    </figure>
                </div>
            </div>

        <?php }
        ?>
    </div>

    <hr class="uk-divider-small uk-text-center">

    <h2 class="uk-text-center">Top 5 rated movies</h2>

    <div class="uk-grid-match uk-flex-center" uk-grid>
        <?php foreach ($notes as $note) { ?>
            <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                <div class="uk-card uk-card-small uk-card-default uk-height-match uk-border-rounded ">
                    <figure class="uk-height-match uk-margin-remove uk-border-rounded">
                        <a href="index.php?action=detailFilm&id=<?= $note['id_film']; ?>">
                            <img class="uk-border-rounded" src="<?= $note["picture"] ?>" alt="picture of <?= $note["title"] ?>" width="310px" height="auto">
                        </a>
                        <figcaption class="uk-text-center uk-margin-small-top uk-margin-small-bottom">
                            <a class="uk-link-toggle" href="index.php?action=detailFilm&id=<?= $note['id_film']; ?>"><strong class="uk-margin-remove"><?= $note["title"] ?></strong></a>
                            <p class="uk-margin-remove">Duration: <?= $note["duration"] ?></p>
                            <p class="uk-margin-remove">Date of release: <?= $note["dateRealease"] ?></p>
                            <p class="uk-margin-remove">Note: <?= $note["note"] ?>/5</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- uk-padding-small -->

<?php
$title = "Home Page";
$content = ob_get_clean(); //def 
require "view/template.php";
