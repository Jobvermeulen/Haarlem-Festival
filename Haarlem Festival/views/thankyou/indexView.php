<?php
require_once("/home/thomaur292/domains/haarlem-festival.nl/public_html/controllers/paymentController.php");
$page = "thankyou";

session_start();

$controller = new baseController();
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
                <h2>Payment successfull</h2>
                <p>Download your tickets <a href="<?php echo $_SESSION['pdfstring']; ?>">here</a></p>
            </section>
        </section>

        <?php
        $controller->loadFooter($page);
        ?>
    </body>
</html>
<?php
$paymentController = $_SESSION["pdf"];
$paymentController->createPdf();

session_destroy();
?>