<?php

class restaurantCard
{
    var $page;
    var $controller;
    var $contentController;
    var $contentRestaurantCards;
    var $imageRestaurantCards;

    public function __construct($page)
    {   
        //set page
        $this->page = $page;
        //load basecontroller
        $controller = new baseController();
        //load contentcontroller
        $contentController = new ContentController($page);

        //Get content of cards from db in array
        //$contentRestaurantCards[row in db or number of card]['text']
        $this->contentRestaurantCards = $contentController->getFoodRestaurantCardContent();
    }

    function LoadCards()
    {   
        //Total amount of restaurant cards
        $total = count($this->contentRestaurantCards, 0);
        //Cards per row
        $itemsPerRow = 3;
        //Calulate amount of rows
        $rows = $total / $itemsPerRow;
        //Make rows a whole number
        settype($rows, "integer");
        //Calculate amount of items in the last row (always less than three)
        $rest = $total - ($rows * $itemsPerRow);
        $i = 0;
        $totalI = 0; // index needed to select individual restaurant card content (LoadCardContent())

            //for each full row, load 3 items
            while ($i < $rows) {
                echo ('<div class="RestaurantCardRow">');
                $items = 3;
                $x = 0;
                while ($x < $items) {
                    //Load food restaurant cards
                    $this->LoadCardContent($totalI);
                    $x++;
                    $totalI++;
                }
                $i++;
                echo ('</div>');
            }
            //for last not full row, load amount of items needed
            $i = 0;
            echo ('<div class="RestaurantCardRow">');
            while ($i < $rest) {
                //Load food restaurant cards
                $this->LoadCardContent($totalI);
                $i++;
                $totalI++;
            }
            echo ('</div>');
    }

    //Load the content of the restaurant cards
    function LoadCardContent($index)
    {
        echo ('<div class="restaurantCard">');
            //restaurant name
            echo ('<div class="restaurantCardh3"><h3>'.$this->contentRestaurantCards[$index]["name"].'</h3></div>');
            //stars
            echo ('<div id="star">');
                $i=0;
                while($i<$this->contentRestaurantCards[$index]["starsFood"]){
                    echo ('<span class="fas fa-star"></span>');
                    $i++;
                }
            echo ('</div>');
            //image
            echo('<img src="'.$this->contentRestaurantCards[$index]["image"].'" alt="'.$this->contentRestaurantCards[$index]["altText"].'" height="140px" width="248px">');
            //address
            echo('<p>'.$this->contentRestaurantCards[$index]["street"].'</p>');    
            echo('<p>'.$this->contentRestaurantCards[$index]["city"].'</p>');
            //website + maps icon
            echo ('<div class="icons">');
                echo ('<a href="'.$this->contentRestaurantCards[$index]["url"].'"><div id="globe"><span class="fas fa-globe"></span></div></a>');
            echo ('</div>');
        echo ('</div>');

    }

}