<?php
ob_start(); //def :
// $genre = $genres->fetch();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <h1>List of movies for this genre</h1>

        <div class="uk-grid-match uk-grid-small" uk-grid>
            <?php
            while ($genre = $genres->fetch()) { ?>
                <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                    <div class="uk-card uk-card-small uk-card-default uk-height-match">
                        <figure class="uk-padding-small uk-height-match">
                            <a href="index.php?action=detailFilm&id=<?= $genre['id_film']; ?>">
                                <img src="<?= $genre["picture"]; ?>" alt="picture of film : <?= $genre["title"]; ?>" width="300">
                            </a>
                            <figcaption class="uk-text-center uk-margin-small-top">
                                <strong><?= $genre['title']; ?></strong>
                            </figcaption>
                        </figure>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>




<?php
$title = "List of movies for genre";
$content = ob_get_clean(); //def 
require "view/template.php";
