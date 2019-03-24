<?php

class carousel
{
    var $page;
    var $contentText;
    var $contentImages;

    public function __construct($page, $contentText, $contentImages)
    {   
        //set page
        $this->page = $page;

        $this->contentText = $contentText;
        $this->contentImages = $contentImages;

        Debugger::LogArrayToFile($this->contentImages);
    }

    public function LoadCarousel()
    {
        //load start of wrapper, and left arrow
        echo ('<div class="wrapper">
                <div id="left-arrow" class="arrow"></div>
                <div id="slider">');
        
        //load slides with dynamic content        
        $this->LoadSlides();
        
        //load end of wrapper, and right arrow
        echo ('</div>
                <div id="right-arrow" class="arrow"></div>
            </div>');
    }

    private function LoadSlides()
    {
        //init variables. extraNum vars because content is certain row in 2D array, need to point to correct row.
        //row is different for each page. 
        $slides;
        $extraNumTextTitle;
        $extraNumTextDescription;
        $extraNumImages;

        //set extraNum vars for each page
        if($this->page=='dance'){
            $slides=6;
            $extraNumTextTitle = 5;
            $extraNumTextDescription = 11;
            $extraNumImages = 2;
        }
        if($this->page=='jazz'){
            $slides=18;
            $extraNumTextTitle = 4;
            $extraNumTextDescription = 22;
            $extraNumImages = 1;
        }
        if($this->page=='historic'){
            $slides=4;
            $extraNumImages = 1;
        }

        //load slides
        $i=0;
        while($i<$slides){

            echo ('<div id="slide">');

            //load title and description for jazz and dance. Historic doesn't have title and description
            if ($this->page == 'dance' || $this->page == 'jazz'){
                echo ('
                        <div id="slideText">
                            <h3>'.$this->contentText[$i+$extraNumTextTitle]['text'].'</h3>
                            <p>'.$this->contentText[$i+$extraNumTextDescription]['text'].'</p>
                        </div>
                ');
            }

            //load image for all three events
            echo ('
                    <div>
                        <img src="'.$this->contentImages[$i+$extraNumImages]['image'].'">
                        </div>
                    </div>
            ');      
            $i++;
        }
    }
}