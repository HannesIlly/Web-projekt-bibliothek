<?php
function readFiles($path) {
    $iterator = new DirectoryIterator($path);
    foreach($iterator as $fileInfo) {
        if ($fileInfo->isDot()) continue;
        if ($fileInfo->isDir()) {
            echo '<details class="img-' . strtolower($fileInfo->getFilename()) . '"><summary>' . $fileInfo->getFilename() .'</summary><div class="details-content">';
            foreach(new DirectoryIterator($fileInfo->getPathname()) as $file) {
                if ($file->isDot()) continue;
                if ($file->isFile()) {
                    echo '<a href="' . $file->getPathname() . '">' . $file->getFilename() . '</a>';
                }
            }
            echo '</div></details>';
        }
    }
}

?>

<h1>Aufgaben</h1>
<div id="aufgaben">
    <?php readFiles('unterrichtsunterlagen/aufgaben') ?>
</div>
