<?php
require_once("/home/thomaur292/domains/haarlem-festival.nl/public_html/controllers/paymentController.php");
session_start();

$paymentController = $_SESSION["pdf"];
$paymentController->createPdf();

session_destroy();
?>