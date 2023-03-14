<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of directors <span class="uk-badge"><?= $directors->rowCount() ?></span></h1>

        <div class="uk-grid-match uk-flex-center uk-grid-small" uk-grid>
            <?php
            while ($director = $directors->fetch()) { ?>
                <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">

                    <div class="uk-card uk-card-small uk-card-default uk-height-match">
                        <figure class="uk-padding-small uk-height-match">
                            <a href="index.php?action=detailDirector&id=<?= $director['id_director'] ?>">
                                <img src="<?= $director["picture"] ?>" alt="picture of <?= strtoupper($director["lastname"]) . ' ' . $director["firstname"] ?>" width="250">
                            </a>
                            <figcaption>
                                <p class="uk-text-center uk-margin-small-top"><?= strtoupper($director["lastname"]) . ' ' . $director["firstname"] ?></p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

            <?php }
            ?>
        </div>

    </div>
</div>







<?php
$title = "List of Directors";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
