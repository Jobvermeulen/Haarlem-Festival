<?php
$page = "thankyou";

$controller = new baseController();

$pdf = $_SESSION["pdf"];
$pdf->Output("youtickets.pdf", "D");
?>

<html>
    <head>
    <?php
    $controller->loadHead("Haarlem Festival - Thank You", $page);
    ?>
    </head>
    <body>
        <?php 
        $controller->loadMenu($page);
        ?>

        <section class="page_section">
                <h1>Thank You For Your Purchase</h1>
            </section>
            <section class="page_section">
                <img class="tickets-arrows"src="../../images/ticket_arrows.png">
            </section>
            <section class="page_section">
            </section>
        </section>

        <?php
        $controller->loadFooter($page);
        ?>
    </body>
</html>