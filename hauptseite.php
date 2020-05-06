<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 'ok') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/hauptseite.css">
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
        <a href="php/logout.php">Logout</a>
    </ul>
</div>
<div id="content" class="content-frame">
    <?php
        if (isset($_GET['seite'])) {
            $seite = $_GET['seite'];
            switch ($seite) {
                case 'fachbuecher':
                    include 'php/fachbuecher.php';
                    break;
                case 'unterlagen':
                    include 'php/unterlagen.php';
                    break;
                case 'aufgaben':
                    include 'php/aufgaben.php';
                    break;
                default:
                    include 'php/wilkommen.php';
            }
        } else {
            include 'php/wilkommen.php';
        }
    ?>
</div>
</body>
</html>
<?php
} else {
    $seite = 'html/login_form.html';
    header('Location: ' . $seite);
}
?>