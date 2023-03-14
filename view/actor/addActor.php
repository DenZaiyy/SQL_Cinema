<?php
ob_start();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <form action="index.php?action=addActor" method="post" class="uk-grid-small" uk-grid>
            <legend class="uk-legend">Add new actor</legend>
            <div class="uk-margin-small uk-width-1-4">
                <label for="lastname">Lastname:</label>
                <input class="uk-input" type="text" name="lastname" placeholder="Lastname of actor" aria-label="Lastname of actor" required>
            </div>
            <div class="uk-margin-small uk-width-1-4">
                <label for="firstname">Firstname:</label>
                <input class="uk-input" type="text" name="firstname" placeholder="Firstname of actor" aria-label="Firstname of actor" required>
            </div>
            <div class="uk-margin-small uk-width-1-4">
                <label for="gender">Gender:</label>
                <select name="gender" class="uk-select">
                    <option value="H">H</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="uk-margin-small uk-width-1-4">
                <label for="dateOfBirth">Date of birth:</label>
                <input class="uk-input" type="date" name="dateOfBirth" aria-label="Date of birth" required>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <label for="film">Film:</label>
                <select name="film" class="uk-select">
                    <?php foreach ($films as $film) { ?>
                        <option value="<?= $film['id_film'] ?>"><?= $film['title'] ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <label for="role">Role:</label>
                <select name="role" class="uk-select">
                    <?php foreach ($roles as $role) { ?>
                        <option value="<?= $role['id_role'] ?>"><?= $role['label'] ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="submit" name="submit" value="Add actor" class="uk-button uk-button-default uk-width-1-1">
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="reset" value="Reset values" class="uk-button uk-button-default uk-width-1-1">
            </div>
        </form>
    </div>
</div>




<?php
$title = "Add new actor";
$content = ob_get_clean();
require "view/template.php";
