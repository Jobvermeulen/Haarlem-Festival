<?php
session_start();
$page = "tickets";

$controller = new baseController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["delete"])) {
        removeTicket($_POST["ticket"]);
    }
}

function removeTicket($ticket)
{
    for ($i = 0; $i < count($_SESSION); $i++) {
        if ($_SESSION["ticket" . $i]["ticketID"] == $ticket) {
            unset($_SESSION["ticket" . $i]);
        }
    }
}

function calculatePrice()
{
    $price = 0;

    for ($i = 0; $i < count($_SESSION); $i++) {
        $price += $_SESSION['ticket' . $i]['price'] * $_SESSION['ticket' . $i]['amount'];
    }

    return $price;
}

function calculateAmount()
{
    $amount = 0;

    for ($i = 0; $i < count($_SESSION); $i++) {
        $amount += $_SESSION['ticket' . $i]['amount'];
    }

    return $amount;
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    //Load head
    $controller->loadHead('Haarlem Festival - Ticket Page', $page);
    ?>  
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu($page);
    ?>
    <section class="page_section">
        <h1>TICKETS</h1>
    </section>
    <section class="page_section">
        <img class="tickets-arrows"src="../../images/ticket_arrows.png">
    </section>
    <section class="page_section">
        <div class="ticket_box">
            <table>
                <tr>
                    <th>Selected tickets</th>
                    <th>Date/Time</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
                <?php
                // session_destroy();
                for ($i = 0; $i < count($_SESSION); $i++) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION['ticket' . $i]['name'] . "</td>";
                    echo "<td>" . $_SESSION['ticket' . $i]['time'] . "</td>";
                    echo "<td>€ " . $_SESSION['ticket' . $i]['price'] . "</td>";
                    echo "<td>" . $_SESSION['ticket' . $i]['amount'] . "</td>";
                    echo '<td><form action="" method="post"><input type="submit" name="delete" value="Remove Item"><input type="hidden" name="ticket" value="' . $_SESSION["ticket" . $i]["ticketID"] . '"></form></td>';
                    echo "</tr>";
                }
                ?>
            </table>
            <div class="ticket-line-blue"></div>
                <div class="container">
                    <div class="left">
                        <span class="amount-ticket-box">Number of tickets: <?php echo calculateAmount(); ?></span>
                        <button class="button_grey" style="width: 13em;">Continue Shopping</button>
                    </div>  
                    <div class="right">
                    <span class="total-price-box">Total price: € <?php echo calculatePrice(); ?></span>
                        <form action="" method="post">
                            <input type="hidden" name="purchase" value="true">
                            <button class="button_green" style="width: 13em;">Purchase Tickets</button>
                        </form>
                </div>
            </div>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["purchase"]) && $_POST["purchase"] == "true") {
            include("/home/thomaur292/domains/haarlem-festival.nl/public_html/views/payment/indexView.php");
        }
        ?>
    </section>
    <?php
    //Load footer
    $controller->loadFooter();
    ?>
</body>
</html>