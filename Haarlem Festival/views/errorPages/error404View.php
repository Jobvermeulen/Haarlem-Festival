<?php
    $controller = new baseController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    //Load the head
    $controller->loadHead('Haarlem Festival - Error 404', 'error');
    ?>  
</head>

<body>
    <?php
    // Load the menu
    $controller->loadMenu('');
    ?>

    <section class="page_section">
    <div>
        <div>
            <div>
                <h1>Oops</h1>
                <h1>We can't find the page you are looking for.</h1>
                <p><strong>Error code: 404</strong></p>
                <p>Here are some helpfull links</p>
                <a href="/">Home</a><br>
                <a href="/jazz">Jazz</a><br>
                <a href="/dance">Dance</a><br>
                <a href="/historic">Historic</a><br>
                <a href="/food">Food</a>
            </div>
        </div>
    </div>
    </section>
    <?php
    // Load the menu
    $controller->loadFooter();
    ?>

</body>

</html>
