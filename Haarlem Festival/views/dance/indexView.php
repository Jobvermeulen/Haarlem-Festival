<?php
//start session for ticket system
session_start();
//load basecontroller
$controller = new baseController();
$controller->upCounter('Dance');
//set page and controller
$page = 'dance';
$contentController = new ContentController($page);

//get Textcontent array from db and save to variable
//$contentText[row in db]['text']
$contentText = $contentController->getTextContent();
$headerTexth1 = $contentText[0]['text'];
$headerTextp = $contentText[1]['text'];
$extendedHeaderp1 = $contentText[2]['text'];
$extendedHeaderp2 = $contentText[3]['text'];
$titleTickets = $contentText[4]['text'];
$specialNotice1 = $contentText[17]['text'];
$specialNotice2 = $contentText[18]['text'];

Debugger::LogArrayToFile($contentText);

//get Imagecontent array from db and save to variable
//$contentImages[row in db]['image'] or $contentImages[row in db]['altText']
$contentImages= $contentController->getImageContent();
$extendedHeader1 = $contentImages[0]['image'];
$extendedHeader1alt = $contentImages[0]['altText'];
$extendedHeader2 = $contentImages[1]['image'];
$extendedHeader2alt = $contentImages[1]['altText'];

?>
<!DOCTYPE html>
<html>
<head>
    <?php
    //Load head
    $controller->loadHead('Haarlem Festival - Dance Page', 'dance');
    ?>  
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu('dance');
    ?>
    <section class="page_section">
        <section id="alertbar">Ticket added to the shoppingcart!</section>

        <section class='intro'>
            <h1><?php echo "$headerTexth1"?></h1>
            <p><?php echo "$headerTextp"?></p>
        </section>

        <section class='select_ticket'>
            <ol class="extra_title">
                <li><div class='stripe floatright'></div></li>
                <li><h2 class='vertical_center_text'><?php echo "$titleTickets"?></h2></li>
                <li><div class='stripe'></div></li>
            </ol>

            <?php
                $table_View = new ticketTableController($page);
                $table_View->loadTicketTable();
                echo $specialNotice1;
                echo $specialNotice2;
            ?>  
            
        </section>

        <section class='event_Popup'>
                
        </section>


        <section class='extra_info'>
            <section id="first_info">
                <p class='floatleft'><?php echo "$extendedHeaderp1"?></p>
                <img class = "floatright" src="<?php echo "$extendedHeader1"?>" alt="<?php echo "$extendedHeader1alt"?>">
            </section>

            <section id="second_info">
            <img class = "floatleft" src="<?php echo "$extendedHeader2"?>" alt="<?php echo "$extendedHeader2alt"?>">
            <p class='floatright'><?php echo "$extendedHeaderp2"?></p>
            </section>
        </section>


        <section class='Line_up_section'>
            <ol class="extra_title">
                <li><div class='stripe floatright'></div></li>
                <li><h2 class='vertical_center_text'>Line up</h2></li>
                <li><div class='stripe'></div></li>
            </ol>
            <?php
                $carousel = new carousel($page, $contentText, $contentImages);
                $carousel->LoadCarousel();
            ?>
    </section>
    <?php
    //Load menu
    $controller->loadFooter();
    ?>
</body>
</html>