<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of directors (<?= $directors->rowCount() ?>)</h1>

        <div class="uk-grid-match uk-grid-medium" uk-grid>
            <?php
            while ($director = $directors->fetch()) { ?>
                <div>
                    <figure>
                        <a href="index.php?action=detailDirector&id=<?= $director['id_director'] ?>">
                            <img src="<?= $director["picture"] ?>" alt="picture of <?= $director["firstname"] . ' ' .  $director["lastname"] ?>" style="height: auto; max-width: 250px;">
                        </a>
                        <figcaption>
                            <p><?= $director["firstname"] . ' ' .  $director["lastname"] ?></p>
                        </figcaption>
                    </figure>
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
