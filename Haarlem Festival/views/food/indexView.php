<?php
    //load basecontroller
    $controller = new baseController();
    $controller->upCounter('Food');
    //set page and controller
    $page = 'food';
    $contentController = new ContentController($page);

    //get Textcontent array from db and save to variable
    //$contentText[row in db]['text']
    $contentText = $contentController->getTextContent();
    $headerTexth1 = $contentText[0]['text'];
    $headerTextp = $contentText[1]['text'];
    $extendedHeaderp = $contentText[2]['text'];
    $contentRestaurantsh1 = $contentText[3]['text'];
    $contentTicketTitle = $contentText[4]['text'];

    //get Imagecontent array from db and save to variable
    //$contentImages[row in db]['image'] or $contentImages[row in db]['altText']
    $contentImages= $contentController->getImageContent();
    $extendedHeaderimg = $contentImages[0]['image'];
    $extendedHeaderimgalt = $contentImages[0]['altText'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    //Load head
    $controller->loadHead('Haarlem Festival - Food Page', $page);
    ?>  
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu($page);
    ?>

    <section class="page_section">
        <section id="alertbar">Ticket added to the shoppingcart!</section>
        <section id="headerText">
            <?php echo "<h1>$headerTexth1</h1>"?>
            <?php echo "<p>$headerTextp</p>"?>
        </section>

        <section id=extendedHeader>
            <?php echo "<p>$extendedHeaderp</p>"?>
            <img src="<?php echo "$extendedHeaderimg"?>" alt="<?php echo "$extendedHeaderimgalt"?>">
        </section>

        <section id='select_ticket'>
            <!-- Ticket Title text + stripes -->
            <div id="TicketTitle">
                <ol class="extra_title">
                    <li><div class='stripe floatright'></div></li>
                    <li><?php echo "<h1 class='vertical_center_text' >$contentTicketTitle</h1>"?></li>
                    <li><div class='stripe'></div></li>
                </ol>
            </div>
            <?php
                $table_View = new ticketTableController($page);
                $table_View->loadTicketTable();
            ?>  
        </section>

        <!-- hier komt pop-up voor tickets in te staan -->
        <section class='event_Popup'>
                        
        </section>

        <section id=contentRestaurants>
            <!-- Restaurant Title text + stripes -->
            <div id="RestaurantsTitle">
                <ol class="extra_title">
                    <li><div class='stripe floatright'></div></li>
                    <li><?php echo "<h1 class='vertical_center_text' >$contentRestaurantsh1</h1>"?></li>
                    <li><div class='stripe'></div></li>
                </ol>
            </div>
            <div id="RestaurantCardContainer">
            <?php
                $restaurantCard = new restaurantCard($page);
                $restaurantCard->LoadCards();
            ?>
            </div>
        </section>

    </section>
    <?php
    //Load menu
    $controller->loadFooter();
    ?>
</body>
</html>