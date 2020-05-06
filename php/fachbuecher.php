<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery accordionToggle Plugin Demo</title>
<link rel="stylesheet" href="../css/fachbuecher.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/jquery.accordion.js"></script>
<script type="text/javascript">
    $(function () {
        $('.tab_container').accordion({
            clickItem: $('.same_open'),
            contentItem: $('.same_open_content'),
            contentWidth: '650px',
            closeTime: 500,
            openTime: 500,
            tmpInput: $('#tmp'),
            clickItemBgColor: '#3280bd',
            contentItemBgColor: '#ffffff'
        });
    });
</script>

<?php
/**
 * This function reads the contents of the given subdirectory in 'leseproben'. The contents are displayed as an unsorted list.
 * @param string $directory The directory of which the files are read.
 * @param string $classes The classes that will be assigned to the list.
 */
function showFileList($directory, $classes='leseproben')
{
    $iterator = new DirectoryIterator('../leseproben/' . $directory);
    $isEmpty = true;

    echo '<ul class="' . $classes . '">';
    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isDot()) continue;
        $isEmpty = false;
        echo '<li><a href="' . $fileInfo->getPathname() . '">' . $fileInfo->getFilename() . '</a></li>';
    }
    echo '</ul>';
    if ($isEmpty) {
        echo '<p>Es wurden keine Leseproben gefunden! :/</p>';
    }
}

?>

<div class="accordion_content">
    <div class="same_open same_offset" data="tab-1">
        <h1>WCP</h1>
    </div>
    <div id="tab-1" class="same_open_content same_offset open_content">
        <img src="../bilder/acc_html.jpg" alt="Bild HTML"/>
        <div class="open_article">
            <h1>Web Client Programmierung</h1>
            <?php showFileList('wcp_proben'); ?>
        </div>
    </div>

    <div class="same_open same_offset" data="tab-2">
        <h1>WSP</h1>
    </div>
    <div id="tab-2" class="same_open_content same_offset">
        <img src="../bilder/acc_php.jpg" alt="Bild PHP"/>
        <div class="open_article">
            <h1>Web Server Programmierung</h1>
            <?php showFileList('php_proben'); ?>
        </div>
    </div>

    <div class="same_open same_offset" data="tab-3">
        <h1>JAVA</h1>
    </div>
    <div id="tab-3" class="same_open_content same_offset">
        <img src="../bilder/acc_java.jpg" alt="Bild Java"/>
        <div class="open_article">
            <h1>Java</h1>
            <?php showFileList('java_proben'); ?>
        </div>
    </div>

    <div class="same_open same_offset" data="tab-4">
        <h1>SWT</h1>
    </div>
    <div id="tab-4" class="same_open_content same_offset">
        <img src="../bilder/acc_swt.jpg" alt="Bild SWT">
        <div class="open_article">
            <h1>Softwaretechnik</h1>
            <?php showFileList('swt_proben'); ?>
        </div>
    </div>