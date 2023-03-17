<?php
ob_start(); //def :
$actor = $actors->fetch();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">

        <div class="uk-flex uk-flex-between">


            <div class="uk-width-auto">
                <figure>
                    <img src="<?= $actor["picture"] ?>" alt="picture of <?= strtoupper($actor["lastname"]) . ' ' . $actor["firstname"] ?>" style="height: auto; max-width: 300px;">
                </figure>
            </div>

            <div class="uk-width-auto">
                <h1>Details of <strong><?= strtoupper($actor["lastname"]) . ' ' . $actor["firstname"] ?></strong></h1>

                <p class="uk-margin">We have a filmographie of <strong><?= strtoupper($actor["lastname"]) . ' ' . $actor["firstname"] ?></strong></p>

                <table class="uk-table uk-table-striped uk-text-center">
                    <thead>
                        <tr>
                            <th>Title of film</th>
                            <th>Role</th>
                            <th>Date of parruption</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cast->fetchAll() as $casting) { ?>
                            <tr>
                                <td><a href="index.php?action=detailFilm&id=<?= $casting['id_film'] ?>"><?= $casting['title']; ?></a></td>
                                <td><a href="index.php?action=detailRole&id=<?= $casting['id_role'] ?>"><?= $casting['label']; ?></a></td>
                                <td><?= $casting['Year']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?php
$title = strtoupper($actor["lastname"]) . ' ' . $actor["firstname"];
$content = ob_get_clean(); //def 
require "view/template.php";
