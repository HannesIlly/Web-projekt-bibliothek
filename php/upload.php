<?php
function processFileUpload($file, $targetDirectory, $maxFileSize=10000000) {
    if (isset($file)) {
        $filename = $file['name'];
        $targetFile = $targetDirectory . '/' . $filename;
        // check if file already exists + check max file size
        if (file_exists($targetFile) || $file['size'] > $maxFileSize) {
            return false;
        }

        // move file from temporary to the target destination
        return move_uploaded_file($file['tmp_name'], $targetFile);
    }
    return false;
}



if (isset($_POST['main-category']) && isset($_POST['sub-category'])) {
    $subCategory = $_POST['sub-category'];
    $mainCategory = $_POST['main-category'];
    $file = $_FILES['file'];

    $directory = '../unterrichtsunterlagen/' . $mainCategory . '/' . $subCategory;

    if (processFileUpload($file, $directory)) {
        // if a page is set return to that page
        if (isset($_POST['return-page'])) {
            header('Location: ' . $_POST['return-page']);
        } else {
            header('Location: ../hauptseite.php');
        }
    } else {
        echo 'Ein Fehler ist aufgetreten!';
    }
}

