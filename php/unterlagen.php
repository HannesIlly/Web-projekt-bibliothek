<?php
include 'functions.php';

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



$directoryContent = readFiles('unterrichtsunterlagen/skripte');
$directories = $directoryContent['directories'];
$fileNames = $directoryContent['names'];
$filePaths = $directoryContent['paths'];
?>

<h1>Unterlagen</h1>
<?php
// display table with files
fileTable($directories, $fileNames, $filePaths);
// add option for admins to add files
if ($_SESSION['role'] == 'admin') {
    fileUploader('Unterlagen', 'skripte', $directories, '../hauptseite.php?seite=unterlagen');
}