<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["audiolang"])) {
        die($_POST["audiolang"]);
    }
}

$page = 'historic';
$controller = new baseController();
$controller->upCounter('Historic');

$contentControler = new ContentController($page);
$textContent = $contentControler->getTextContent();
$imageContent = $contentControler->getImageContent();
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    //Load head
    $controller->loadHead('Haarlem Festival - Haarlem Historic', $page);
    ?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
    
</head>
<body>
    <?php
    //Load menu
    $controller->loadMenu('historic');
    ?>
    <section class="page_section">
        <h1><?php echo $textContent[0]['text'] ?></h1>
        <p class="heading-information">
        <?php echo $textContent[1]['text'] ?>
        </p>
        <p class="centered">
        <?php echo $textContent[2]['text'] ?>
        </p>
    </section>
    <section class="page_section">
    </section>
    <section class="page_section">    
        <h2 class="blue-line centered">
            <span class="space-between-line">Tickets</span>
        </h2>
        <p>
        <?php echo $textContent[3]['text'] ?>
        </p>

        <section class='select_ticket'>
            <?php
            $table_View = new ticketTableController($page);
            $table_View->loadTicketTable();
            ?>  
        </section>
        <section class='event_Popup'>
           
        </section>
    </section>
    <section class="page_section">
        <h2 class="blue-line centered">
            <span class="space-between-line">Highlights</span>
        </h2>
            <?php
                $carousel = new carousel($page, $textContent, $imageContent);
                $carousel->LoadCarousel();
            ?>
    </section>
    <section class="page_section">
        <h2 class="blue-line centered">
            <span class="space-between-line">Locations</span>
        </h2>
        <div class="location-container">
            <div class="locations-left">
                <div id="mapid">
                    <script>
                        var mymap = L.map('mapid').setView([52.3811, 4.63861], 15);
                        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                            maxZoom: 22,
                            id: 'mapbox.streets',
                            accessToken: 'pk.eyJ1IjoibWF0aHVpcyIsImEiOiJjanFtd3RlcHMwMWw0NDlzZDBnZzdxMzhtIn0.aP_qZbG4V1i_Jyi7sd1Jtw'
                        }).addTo(mymap);

                        var stbavo = L.marker([52.38107, 4.63727]).bindPopup("<b>St Bavo Church</b>").addTo(mymap).openPopup();
                        var grotemarkt = L.marker([52.3814, 4.63602]).bindPopup("<b>Grote Markt</b>").addTo(mymap);
                        var dehallen = L.marker([52.38112, 4.6361]).bindPopup("<b>De Hallen</b>").addTo(mymap);
                        var proveniershof = L.marker([52.37737, 4.63075]).bindPopup("<b>Proveniershof</b>").addTo(mymap);
                        var jopenkerk = L.marker([52.3812, 4.62982]).bindPopup("<b>Jopenkerk</b>").addTo(mymap);
                        var waalsekerkhaarlem = L.marker([52.38252, 4.63916]).bindPopup("<b>Waalse Kerk Haarlem</b>").addTo(mymap);
                        var molendeadriaan = L.marker([52.3838, 4.64266]).bindPopup("<b>Molen De Adriaan</b>").addTo(mymap);
                        var amsterdamsepoort = L.marker([52.3806, 4.64642]).bindPopup("<b>Amsterdamse poort</b>").addTo(mymap);
                        var hofvanbakenes = L.marker([52.38207, 4.63974]).bindPopup("<b>Hof van Bakenes</b>").addTo(mymap);
                    </script>
                </div>
            </div>
            <div class="locations-right">
                <ul>
                    <?php
                    foreach ($contentControler->getHistoricLocations() as $location) {
                        echo "<li>" . $location["name"] . "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <section class="page_section">
        <h2 class="blue-line centered">
            <span class="space-between-line">Audio Tours Free Download</span>
        </h2>
        <div class="audio">
            <form action="" method="post">
                <ul>
                    <li><input type="button" name="audiolang" value="english"></li>
                    <li><input type="button" name="audiolang" value="english"></li>
                    <li><input type="button" name="audiolang" value="english"></li>
                </ul>
            </form>
        </div>
    </section>
    <?php
    //Load menu
    $controller->loadFooter();
    ?>
</body>
</html>