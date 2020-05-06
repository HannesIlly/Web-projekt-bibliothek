<?php
/**
 * @param string $path The path of the directory that is read.
 */
function readFiles($path) {
    $iterator = new DirectoryIterator($path);
    $directoryContent = [];

    // iterate each directory
    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isDot()) continue;
        if ($fileInfo->isDir()) {
            // iterate each file
            $currentFolder = [$fileInfo->getFilename(), [], []]; // dirname, filenames, pathname of files
            foreach (new DirectoryIterator($fileInfo->getPathname()) as $file) {
                if ($file->isDot()) continue;
                $currentFolder[1][] = $file->getFilename();
                $currentFolder[2][] = $file->getPathname();
            }
            $directoryContent[] = $currentFolder;
        }
    }

    echo '<table>';
    // print column titles
    echo '<tr>';
    $length = count($directoryContent);
    for ($i = 0; $i < $length; $i++) {
        echo '<th>'. $directoryContent[$i][0] . '</th>';
    }
    echo '</tr>';
    // print column contents
    echo '<tr>';
    $length = count($directoryContent);
    for ($i = 0; $i < $length; $i++) {
        echo '<td>';
        $count = count($directoryContent[$i][1]);
        for ($j = 0; $j < $count; $j++) {
            echo '<a href="' . $directoryContent[$i][2][$j] . '">' . $directoryContent[$i][1][$j] . '</a>';
        }
        echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
}
?>

<h1>Unterlagen</h1>
<?php readFiles('unterrichtsunterlagen/skripte'); ?>