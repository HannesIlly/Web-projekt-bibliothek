<?php
function processFileUpload($name, $targetDirectory, $maxFileSize=10000000) {
    if (isset($_FILES[$name])) {
        $filename = $_FILES[$name]['name'];
        $targetFile = $targetDirectory . '/' . $filename;
        // check if file already exists + check max file size
        if (file_exists($targetFile) || $_FILES[$name]["size"] > $maxFileSize) {
            return false;
        }

        // move file from temporary to the target destination
        return move_uploaded_file($_FILES[$name]['tmp_name'], $targetFile);
    }
    return false;
}



if (isset($_POST['main-category']) && isset($_POST['sub-category'])) {
    $subCategory = $_POST['sub-category'];
    $mainCategory = $_POST['main-category'];
    $file = $_FILES['file'];

    $directory = '../unterrichtsunterlagen/' . $mainCategory . '/' . $subCategory;

    if (processFileUpload('file', $directory)) {
        // go back to page 'unterlagen'
        header('Location: ../hauptseite.php?seite=unterlagen');
    } else {
        echo 'Ein Fehler ist aufgetreten!';
    }
}

