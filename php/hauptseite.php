<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/hauptseite.css">
    <title>Bibliothek</title>
</head>
<body>
<div id="header" class="content-frame">

</div>
<div id="nav">
    <ul>
        <a href="?seite=fachbuecher">Fachbücher</a>
        <a href="?seite=unterlagen">Skripte</a>
        <a href="?seite=aufgaben">Übungsaufgaben</a>
    </ul>
</div>
<div id="content" class="content-frame">
    <?php
        if (isset($_GET['seite'])) {
            $seite = $_GET['seite'];
            switch ($seite) {
                case 'fachbuecher':
                    include 'fachbuecher.php';
                    break;
                case 'unterlagen':
                    include 'unterlagen.php';
                    break;
                case 'aufgaben':
                    include 'aufgaben.php';
                    break;
                default:
                    include 'wilkommen.php';
            }
        } else {
            include 'wilkommen.php';
        }
    ?>
</div>
</body>
</html>