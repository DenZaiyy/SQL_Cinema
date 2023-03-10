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
                            <td><?= $film['note']; ?></td>
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
                                    <td><?= strtoupper($casting['lastname']) . " " . $casting['firstname']; ?></td>
                                    <td><?= $casting['gender']; ?></td>
                                    <td><?= $casting['label']; ?></td>
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
