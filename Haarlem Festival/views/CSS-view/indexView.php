<?php
    $controller = new baseController();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Haarlem Festival Home Page</title>
    <link rel="stylesheet" href="public_html/css/main.css">
    <?php
    //Load head
    $controller->loadHead();
    ?>  
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu('index');
    ?>

    <h1>Dit is een h1</h1>
    <h2>Dit is een h2</h2>
    <h3>Dit is een h3</h3>
    <h4>Dit is een h4</h4>

    <p>Dit is een paragraph</p>

    <a>Dit is een hyperlink</a>

    <br>

   <button class="button_green"><span>Hover </span></button>

   <br>

   <button class="button_grey"><span>Hover </span></button>


    <?php
    //Load menu
    $controller->loadFooter();
    ?>
</body>
</html>