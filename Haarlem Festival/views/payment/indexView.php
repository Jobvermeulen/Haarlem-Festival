<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["payment"]) && $_POST["payment"] == "true") {
    if (!empty($_POST["fullname"]) && !empty($_POST["email"]) && !empty($_POST["email2"]) || !empty($_POST["paypal"]) || !empty($_POST["ideal"]) || !empty($_POST["mastercard"])) {

        //Check if the information is the right format
        if (strpos($_POST["email"], "@") == false || strpos($_POST["email2"], "@") === false) {
            echo "These are not email addresses";
        }

        require_once("controllers/paymentController.php");

        //TODO:
        //get payment provider api's
        //send email with tickets

        $paymentProvider = "ideal";

        try {
            $paymentController = new PaymentController($_POST["fullname"], $_POST["email"], $paymentProvider, calculatePrice());
            $paymentController->pay();
            $_SESSION["pdf"] = $paymentController;

            //die(print_r($_SESSION["pdf"]));
            //Move to thank you page
            header("Location: https://haarlem-festival.nl/thankyou");

        } catch (Exception $ex) {
            die($ex);
        }
    }
}

$page = "payment";
$controller = new BaseController();
?>

<section class="page_section">
    <h1>PAYMENT</h1>
</section>
<section class="page_section">
    <img class="tickets-arrows"src="../../images/ticket_arrows.png">
</section>
<section class="page_section">
    <form id="form" action="" method="post">
        <p id="err"></p>
        <p>Full Name</p>
        <input type="text" name="fullname">
        <br>
        <p>E-mail</p>
        <input type="text" name="email">
        <br>
        <p>Confirm E-mail</p>
        <input type="text" name="email2">
        <br>
        <br>
        iDeal: <input type="radio" name="payment" value="ideal">
        Pay Pal: <input type="radio" name="payment" value="paypal">
        Master Card: <input type="radio" name="payment" value="mastercard">
        <br>
        <br>
        <input type="hidden" name="payment" value="true">
        <input type="hidden" name="purchase" value="true">
        <input type="submit" name="submit" value="Purchase">
    </form>
</section>
<script>
    document.querySelector("#form").addEventListener("change", validateForm);

    function validateForm() {
        var fullname = document.getElementsByName("fullname");
        var email = document.getElementsByName("email");
        var email2 = document.getElementsByName("email2");
        var payment = document.getElementsByName("payment");

        var button =  document.getElementsByName("submit");

        if (fullname[0].value == "" || email[0].value == "" || email2[0].value == "" || payment[0].value == "") {
            document.getElementById("err").innerHTML = "Please fill in all items in form";
            document.getElementById("err").style.color = "#ff0000";
            button[0].disabled = true;
        } else {
            document.getElementById("err").innerHTML = "";
            button[0].disabled = false;

            if (email[0].value != email2[0].value) {
                document.getElementById("err").innerHTML = "Both email addresses must be the same";
                document.getElementById("err").style.color = "#ff0000";
                button[0].disabled = true;
            } else {
                document.getElementById("err").innerHTML = "";
                button[0].disabled = false;

                if (!email[0].value.includes("@") || !email2[0].value.includes("@")) {
                    document.getElementById("err").innerHTML = "This is not a valid email address";
                    document.getElementById("err").style.color = "#ff0000";
                    button[0].disabled = true;
                } else {
                    document.getElementById("err").innerHTML = "";
                    button[0].disabled = false;
                }
            }
        }
    }


    scrollBy(0, 800);
</script>
