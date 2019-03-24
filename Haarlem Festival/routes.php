<?php
//This php file contains all routes that are working for this website

//Index routes
router::set('index', function () {
    router::$found = 1;
    baseController::createView('index');
});

router::set('index.php', function () {
    router::$found = 1;
    baseController::createView('index');
});

//Food
router::set('food', function () {
    router::$found = 1;
    baseController::createView('food/index');
});

//Dance
router::set('dance', function () {
    router::$found = 1;
    baseController::createView('dance/index');
});

//Jazz
router::set('jazz', function () {
    router::$found = 1;
    baseController::createView('jazz/index');
});

//Historic
router::set('historic', function () {
    router::$found = 1;
    baseController::createView('historic/index');
});

//Tickets
router::set('tickets', function () {
    router::$found = 1;
    baseController::createView('tickets/index');
});

//SQL
router::set('thankyou', function () {
    router::$found = 1;
    baseController::createView('thankyou/index');
});

//CSS-VIEW
router::set('css', function () {
    router::$found = 1;
    baseController::createView('CSS-view/index');
});

//ajax-VIEW
router::set('ajax', function () {
    router::$found = 1;
    baseController::createView('modules/ajax');
});

//ticket dialog box - View
router::set('ticketBox', function () {
    router::$found = 1;
    baseController::createView('modules/ticketBox');
});

//payment page
router::set("payment", function () {
    router::$found = 1;
    baseController::createView('payment/index');
});

//download page
router::set("download", function () {
    router::$found = 1;
    baseController::createView('download/index');
});

//Error 404 route
if (router::$found == 0) {
    router::set($_GET['url'], function () {
        baseController::createView('errorPages/error404');
    });
}