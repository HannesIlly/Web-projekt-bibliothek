<?php
// This file contains various useful functions.

/**
 * Reads the given directory path and returns the folders and files that are in it.
 * The read folders/files are returned as follows:
 *  - result['directories'] is an array of the folders that are in the given directory.
 *  - result['names'] is a two-dimensional array that contains all the filenames.
 *     - result['names'][0] contains the file names that are in the directory result['directories'][0]
 *  - result['paths'] is a two-dimensional array that contains all the file paths.
 *     - result['paths'][0] contains the file paths that are in the directory result['directories'][0]
 *
 * @param string $path The path of the directory that is read.
 * @return array The contents of the directory as an array.
 */
function readFiles($path) {
    $iterator = new DirectoryIterator($path);

    $directories = [];
    $fileNames = [];
    $filePaths = [];

    // iterate each directory
    foreach ($iterator as $fileInfo) {
        // skip entries '.' and '..'
        if ($fileInfo->isDot()) continue;
        if ($fileInfo->isDir()) {
            $directories[] = $fileInfo->getFilename();
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
    return ['directories' => $directories, 'names' => $fileNames, 'paths' => $filePaths];
}

/**
 * Displays a file upload dialog. The name is displayed as the title of the dialog.
 * The main category shows to which category this file uploader belongs.
 * The user can choose a sub-category (elements of $categories) within the main category to which the file will be uploaded.
 *
 * @param $name string The name of this file upload dialog.
 * @param $mainCategory string The category to which this dialog belongs.
 * @param $categories array The sub-categories from which the user can choose.
 * @param $returnPage string The page to which the user should return after a successful file upload.
 */
function fileUploader($name, $mainCategory, $categories, $returnPage='../hauptseite.php') {
    echo '<form class="upload" action="php/upload.php" method="POST" enctype="multipart/form-data" ><fieldset><legend>' . $name . ' hochladen</legend>';
    echo '<label for="sub-category">Kategorie:</label>';
    echo '<select id="sub-category" name="sub-category">';
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
    echo '<input type="hidden" name="return-page" value="' . $returnPage . '" />';
    echo '<label for="file-upload">Dateien hinzufügen:</label>';
    echo '<input id="file-upload" name="file" type="file" />';
    echo '</fieldset>';
    echo '<input type="submit" value="Hochladen" />';
    echo '</form>';
}