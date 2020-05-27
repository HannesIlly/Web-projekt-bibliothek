<?php
include 'functions.php';

function displayFiles($categories, $fileNames, $filePaths) {
    for ($i = 0; $i < count($categories); $i++) {
        echo '<details class="img-' . $categories[$i] . '"><summary>' . $categories[$i] .'</summary><div class="details-content">';
        for ($f = 0; $f < count($fileNames[$i]); $f++) {
            echo '<a href="' . $filePaths[$i][$f] . '">' . $fileNames[$i][$f] . '</a>';
        }
        echo '</div></details>';
    }
}



$directoryContent = readFiles('unterrichtsunterlagen/aufgaben');
$directories = $directoryContent['directories'];
$fileNames = $directoryContent['names'];
$filePaths = $directoryContent['paths'];
?>

<h1>Aufgaben</h1>
<div id="aufgaben">
    <?php
    // display the files
    displayFiles($directories, $fileNames, $filePaths);
    ?>
</div>
<?php // add option for admins to upload files
if ($_SESSION['role'] == 'admin') {
    fileUploader('Aufgaben', 'aufgaben', $directories, '../hauptseite.php?seite=aufgaben');
}
?>
