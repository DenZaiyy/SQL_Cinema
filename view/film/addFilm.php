<?php
ob_start();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <form enctype="multipart/form-data" action="index.php?action=addFilm" method="post" class="uk-grid-small" uk-grid>
            <legend class="uk-legend">Add new film</legend>
            <div class="uk-margin-small uk-width-1-1">
                <input class="uk-input" type="text" name="title" placeholder="Title of movie" aria-label="Title of movie" required>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input class="uk-input" type="date" name="date" aria-label="date of paruption" required>
            </div>
            <div class="uk-margin-small uk-width-1-4">
                <input class="uk-input" type="number" name="duration" placeholder="Duration in minutes" aria-label="duration of movie" required>
            </div>
            <div class="uk-margin-small uk-width-1-4">
                <input class="uk-input" type="number" step="0.1" name="note" placeholder="Note of movie /5" aria-label="Note of movie /5" max="5">
            </div>
            <div class="uk-margin-small uk-width-1-1">
                <textarea class="uk-textarea" rows="5" name="synopsis" placeholder="Synopsis of movie" aria-label="Synopsis of movie"></textarea>
            </div>
            <div class="uk-margin-small uk-width-1-1" uk-form-custom="target: true">
                <input type="file" class="uk-width-1-1" name="picture" aria-label="Custom controls">
                <input class="uk-input uk-form-width-medium uk-width-1-1" type="text" placeholder="Select file" aria-label="Custom controls" disabled>
            </div>
            <div class="uk-margin-small uk-width-1-1">
                <select name="directors" class="uk-select">
                    <option value="">Choose director</option>
                    <?php foreach ($directors as $director) {
                        echo "<option value='" . $director['id_director'] . "'>" . $director['lastname'] . " " . $director['firstname'] . "</option>";
                    } ?>
                </select>
            </div>
            <div class="uk-margin-small uk-width-1-1">
                <label for="default"><input type="checkbox" name="default" value="">Nothing</label>
                <?php foreach ($genres as $genre) { ?>
                    <label class="uk-margin-small-left"><input class="uk-checkbox" type="checkbox" name="id_genre" value="<?= $genre['id_genre'] ?>"> <?= $genre['label'] ?></label>
                <?php } ?>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="submit" name="submit" value="Add film" class="uk-button uk-button-default uk-width-1-1">
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="reset" value="Reset values" class="uk-button uk-button-default uk-width-1-1">
            </div>
        </form>
    </div>
</div>




<?php
$title = "Add new film";
$content = ob_get_clean();
require "view/template.php";
