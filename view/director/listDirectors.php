<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of directors <span class="uk-badge"><?= $directors->rowCount() ?></span></h1>

        <div class="uk-grid-match uk-flex-center" uk-grid>
            <?php
            while ($director = $directors->fetch()) { ?>
                <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">

                    <div class="uk-card uk-card-small uk-card-default uk-height-match uk-border-rounded">
                        <figure class="uk-height-match uk-border-rounded">
                            <a href="index.php?action=detailDirector&id=<?= $director['id_director'] ?>">
                                <img class="uk-border-rounded" src="<?= $director["picture"] ?>" alt="picture of <?= strtoupper($director["lastname"]) . ' ' . $director["firstname"] ?>" width="250">
                            </a>
                            <figcaption>
                                <a class="uk-link-toggle" href="index.php?action=detailDirector&id=<?= $director['id_director'] ?>">
                                    <p class="uk-text-center uk-margin-small-top"><?= strtoupper($director["lastname"]) . ' ' . $director["firstname"] ?></p>
                                </a>
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
