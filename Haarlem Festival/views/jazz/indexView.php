<?php
    //start session for ticket system
    session_start();
    //load basecontroller
    $controller = new baseController();
    $controller->upCounter('Jazz');
    //set page and controller
    $page = 'jazz';
    $contentController = new ContentController($page);

    //get Textcontent array from db and save to variable
    //$contentText[row in db]['text']
    $contentText = $contentController->getTextContent();
    $headerTexth1 = $contentText[0]['text'];
    $headerTextp = $contentText[1]['text'];
    $headerTextp2 = $contentText[2]['text'];
    $extendedHeaderp = $contentText[3]['text'];

    //get Imagecontent array from db and save to variable
    //$contentImages[row in db]['image'] or $contentImages[row in db]['altText']
    $contentImages= $contentController->getImageContent();
    $extendedHeader1 = $contentImages[0]['image'];
    $extendedHeader1alt = $contentImages[0]['altText'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    //Load head
    $controller->loadHead('Haarlem Festival - Jazz Page', 'jazz');
    ?>  
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu('jazz');
    ?>
    <!-- The alertbar to show the user that an ticket is added to the shoppingcart! -->
    <section id="alertbar">Ticket added to the shoppingcart!</section>

    <section class="page_section">
        <h1><?php echo "$headerTexth1"?></h1>
        <p class="heading-information"><?php echo "$headerTextp"?></p>
        <p class="centered"><?php echo "$headerTextp2"?></p>
    </section>

    <section class="page_section">
        <div class="information-block">
        <img src="<?php echo "$extendedHeader1"?>" alt="<?php echo "$extendedHeader1alt"?>" class="image-article">
            <p class="text-article"><?php echo "$extendedHeaderp"?></p>        
        </div>
    </section>

    <section class="page_section centered vertical_center_text">    
            <h2 class="blue-line centered">
                <span class="space-between-line">Tickets</span>
            </h2>            
    </section>

    <section class="page_section">
        <section class='select_ticket'>
                <?php
                    $table_View = new ticketTableController($page);
                    $table_View->loadTicketTable();
                ?>  
                <section class='event_Popup'>
                        
                </section>

            </section>

        </section>
    </section>

    <section class="page_section">    
            <h2 class="blue-line centered">
                <span class="space-between-line">Line-up</span>
            </h2>
                  
    </section>

    <section class="page_section">
        <?php
            $carousel = new carousel($page, $contentText, $contentImages);
            $carousel->LoadCarousel();
        ?> 
    </section>

    <?php
    //Load footer
    $controller->loadFooter();
    ?>
</body>
</html>