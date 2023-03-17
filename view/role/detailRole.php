<?php
ob_start(); //def :
$role = $roles->fetch();
?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <h1>List of actors playing "<?= $role['label'] ?>"</h1>

        <table class="uk-table uk-table-striped">
            <thead>
                <tr>
                    <th>Name of actor</th>
                    <th>Title of film</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($casting = $castings->fetch()) { ?>
                    <tr>
                        <td><a href="index.php?action=detailActor&id=<?= $casting['id_actor'] ?>"><?= strtoupper($casting["lastname"]) . ' ' . $casting["firstname"] ?></a></td>
                        <td><a href="index.php?action=detailFilm&id=<?= $casting['id_film'] ?>"><?= $casting['title']; ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>




<?php
$title = "List for " . $role['label'];
$content = ob_get_clean(); //def 
require "view/template.php";
