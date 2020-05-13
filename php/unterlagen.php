<?php
/**
 * @param string $path The path of the directory that is read.
 */
function readFiles($path) {
    $iterator = new DirectoryIterator($path);

    $categories = [];
    $fileNames = [];
    $filePaths = [];

    // iterate each directory
    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isDot()) continue;
        if ($fileInfo->isDir()) {
            $categories[] = $fileInfo->getFilename();
            $currentFolder = [[], []]; // filenames, pathname of files

            // iterate each file
            foreach (new DirectoryIterator($fileInfo->getPathname()) as $file) {
                if ($file->isDot()) continue;
                $currentFolder[0][] = $file->getFilename();
                $currentFolder[1][] = $file->getPathname();
            }
            $fileNames[] = $currentFolder[0];
            $filePaths[] = $currentFolder[1];
        }
    }

    // display table with files
    fileTable($categories, $fileNames, $filePaths);

    // add option for admins to add files
    if ($_SESSION['role'] == 'admin') {
        fileUploader('Unterlagen', 'skripte', $categories);
    }
}

function fileTable($categories, $fileNames, $filePaths) {
    echo '<table>';
    // print column titles
    echo '<tr>';
    $length = count($categories);
    for ($i = 0; $i < $length; $i++) {
        echo '<th>' . $categories[$i] . '</th>';
    }
    echo '</tr>';
    // print column contents
    echo '<tr>';
    for ($i = 0; $i < $length; $i++) {
        echo '<td>';
        $count = count($fileNames[$i]);
        for ($j = 0; $j < $count; $j++) {
            echo '<a href="' . $filePaths[$i][$j] . '">' . $fileNames[$i][$j] . '</a>';
        }
        echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
}

function fileUploader($name, $mainCategory, $categories) {
    echo '<form class="upload" action="php/upload.php" method="POST" enctype="multipart/form-data" ><fieldset><legend>' . $name . ' hochladen</legend>';
    echo '<label for="category">Kategorie:</label>';
    echo '<select id="category" name="sub-category">';
    $length = count($categories);
    for ($i = 0; $i < $length; $i++) {
        $directoryName = $categories[$i];
        echo '<option value="' . $directoryName . '">';
        echo $directoryName;
        echo '</option>';
    }
    echo '</select>';
    // define the directory of the categories here
    echo '<input type="hidden" name="main-category" value="' . $mainCategory . '" />';
    echo '<label for="file-upload">Dateien hinzufügen:</label>';
    echo '<input id="file-upload" name="file" type="file" />';
    echo '</fieldset>';
    echo '<input type="submit" value="Hochladen" />';
    echo '</form>';
}

?>

<h1>Unterlagen</h1>
<?php readFiles('unterrichtsunterlagen/skripte'); ?>