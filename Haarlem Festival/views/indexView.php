<?php
    $controller = new baseController();
    //set page and controller
    $page = 'homepage';
    $contentController = new ContentController($page);

    //get Textcontent array from db and save to variable
    //$contentText[row in db]['text']
    $contentText = $contentController->getTextContent();
    $headerTexth1 = $contentText[0]['text'];
    $extendedHeaderp = $contentText[1]['text'];
    $eventTitle = $contentText[2]['text'];
    $eventBoxTitleDance = $contentText[3]['text'];
    $eventBoxTitleFood = $contentText[4]['text'];
    $eventBoxTitleHistoric = $contentText[5]['text'];
    $eventBoxTitleJazz = $contentText[6]['text'];
    $eventBoxDateDance = $contentText[7]['text'];
    $eventBoxDateFood = $contentText[8]['text'];
    $eventBoxDateHistoric = $contentText[9]['text'];
    $eventBoxDateJazz = $contentText[10]['text'];
    $eventBoxDescriptionDance = $contentText[11]['text'];
    $eventBoxDescriptionFood = $contentText[12]['text'];
    $eventBoxDescriptionHistoric = $contentText[13]['text'];
    $eventBoxDescriptionJazz = $contentText[14]['text'];

    //get Imagecontent array from db and save to variable
    //$contentImages[row in db]['image'] or $contentImages[row in db]['altText']
    $contentImages= $contentController->getImageContent();
    $extendedHeaderimg = $contentImages[0]['image'];
    $extendedHeaderimgalt = $contentImages[0]['altText'];
    $eventBoxImageDance = $contentImages[1]['image'];
    $eventBoxImageDanceAlt = $contentImages[1]['altText'];
    $eventBoxImageFood = $contentImages[2]['image'];
    $eventBoxImageFoodAlt = $contentImages[2]['altText'];
    $eventBoxImageHistoric = $contentImages[3]['image'];
    $eventBoxImageHistoricAlt = $contentImages[3]['altText'];
    $eventBoxImageJazz = $contentImages[4]['image'];
    $eventBoxImageJazzAlt = $contentImages[4]['altText'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        //Load head
        $controller->loadHead('Haarlem Festival Home Page', 'home');
        $controller->upCounter('');
    ?>  
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu('home');
    ?>
    <!-- page -->
    <section class="page_section">
        <section id="Title">            
            <?php echo "<h1>$headerTexth1</h1>"?>

            <ol class="look_down">
                <li><div class='stripe floatright green_stripe'></div></li>
                <li class='centerimg'><img class='look_down_image' src='resources/look_down_light_blue.png'></li>
                <li><div class='stripe green_stripe'></div></li>
            </ol>
        </section>

        <section id="first_info_section">
            <?php echo "<p>$extendedHeaderp</p>"?>   
            <img class="banner" src="<?php echo "$extendedHeaderimg"?>" alt="<?php echo "$extendedHeaderimgalt"?>">
        </section>

        <section class='Event_section'>            
            <ol class="extra_title">
                <li><div class='stripe floatright'></div></li>
                <li><h2 class='vertical_center_text'><?php echo "$eventTitle"?></h2></li>
                <li><div class='stripe'></div></li>
            </ol>

            <section id="event_boxes_container">
                <section id="Dance_box" class="event_box">
                    <h3><?php echo "$eventBoxTitleDance"?></h3>
                    <img class='event_box_image' src='<?php echo "$eventBoxImageDance"?>' alt='<?php echo "$eventBoxImageDanceAlt"?>'>
                    <p class='date'><?php echo "$eventBoxDateDance"?></p>
                    <p><?php echo "$eventBoxDescriptionDance"?></p>
                </section>

                <section id="Food_box" class="event_box">
                    <h3><?php echo "$eventBoxTitleFood"?></h3>
                    <img class='event_box_image' src='<?php echo "$eventBoxImageFood"?>' alt='<?php echo "$eventBoxImageFoodAlt"?>'>
                    <p class='date'><?php echo "$eventBoxDateFood"?></p>
                    <p><?php echo "$eventBoxDescriptionFood"?></p>
                </section>

                <section id="Historic_box" class="event_box">
                    <h3><?php echo "$eventBoxTitleHistoric"?></h3>
                    <img class='event_box_image' src='<?php echo "$eventBoxImageHistoric"?>' alt='<?php echo "$eventBoxImageHistoricAlt"?>'>
                    <p class='date'><?php echo "$eventBoxDateHistoric"?></p>
                    <p><?php echo "$eventBoxDescriptionHistoric"?></p>
                </section>

                <section id="Jazz_box" class="event_box">
                    <h3><?php echo "$eventBoxTitleJazz"?></h3>
                    <img class='event_box_image' src='<?php echo "$eventBoxImageJazz"?>' alt='<?php echo "$eventBoxImageJazzAlt"?>'>
                    <p class='date'><?php echo "$eventBoxDateJazz"?></p>
                    <p><?php echo "$eventBoxDescriptionJazz"?></p>
                </section>
            </section>
        </section>
    </section>

    <?php
    //Load footer
    $controller->loadFooter();
    ?>
</body>
</html>