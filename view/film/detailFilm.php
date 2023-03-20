<?php
ob_start(); //def :
$film = $films->fetch();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">

        <div class="uk-flex uk-flex-between">


            <div class="uk-width-auto">
                <figure>
                    <img src="<?= $film["picture"] ?>" alt="picture of film : <?= $film["title"]; ?>" width="310px" height="auto">
                </figure>
            </div>

            <div class="uk-width-auto">
                <h1>Details of <strong><?= $film["title"] ?></strong></h1>
                <form action="index.php?action=deleteFilm&id=<?= $film['id_film']; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this film?')">
                    <input class="uk-button uk-button-default" type="submit" name="submit" value="Delete this film">
                </form>

                <table class="uk-table uk-table-striped uk-text-center uk-table-hover">
                    <thead>
                        <tr>
                            <th>Title of film</th>
                            <th>Date of parruption</th>
                            <th>Duration (min)</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $film['title']; ?></td>
                            <td><?= $film['Year']; ?></td>
                            <td><?= $film['duration']; ?></td>
                            <td><?= $film['note']; ?> / 5</td>
                        </tr>
                    </tbody>
                </table>

                <div class="uk-width-auto uk-margin-large-top">
                    <h2>Castings</h2>
                    <table class="uk-table uk-table-striped uk-table-hover uk-table-small">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($casting = $castings->fetch()) { ?>
                                <tr>
                                    <td><a href="index.php?action=detailActor&id=<?= $casting['id_actor'] ?>"><?= strtoupper($casting['lastname']) . " " . $casting['firstname']; ?></a></td>
                                    <td><?= $casting['gender']; ?></td>
                                    <td><a href="index.php?action=detailRole&id=<?= $casting['id_role'] ?>"><?= $casting['label']; ?></a></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
$title = $film["title"];
$content = ob_get_clean(); //def 
require "view/template.php";
