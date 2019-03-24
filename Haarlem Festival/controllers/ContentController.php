<?php
class ContentController
{
    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    function sql_validator($sql)
    {
        if (strpos($sql, '<script>') === false && strpos($sql, '</') === false && strpos($sql, '--') === false) {
            return $sql;
        } else {
            die($sql);
            die('You cannot hack me boii');
        }
    }

    public function getTextContent()
    {
        if (!empty($this->page)) {
            $getContentModel = new getPageContentModel($this->page);
            $textContent = $getContentModel->getTextContentFromDB();
            if ($textContent) {
                return $textContent;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getImageContent()
    {
        if (!empty($this->page)) {
            $getContentModel = new getPageContentModel($this->page);
            $imageContent = $getContentModel->getImageContentFromDB();
            if ($imageContent) {
                return $imageContent;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getFoodRestaurantCardContent()
    {
        $getContentModel = new getPageContentModel();
        $cardContent = $getContentModel->getFoodRestaurantCardContentFromDB();

        if ($cardContent) {
            return $cardContent;
        } else {
            return false;
        }
    }

    public function getTicketContent()
    {
        if (!empty($this->page)) {
            $getContentModel = new getPageContentModel($this->page);
            $ticketContent = $getContentModel->getTicketsFrom_DB();
            return $ticketContent;
        }else{
            return false;
        }
    }

    public function getHistoricLocations() 
    {
        if (!empty($this->page))
        {
            $contentModel = new getPageContentModel($this->page);
            $historicLocations = $contentModel->getHistoricLocations();

            return $historicLocations;
        }
    }

    public function getEventTimes($name,$date){
        $secureName = $this->sql_validator($name);
        $secureDate = $this->sql_validator($date);
        $securePage = $this->sql_validator($this->page);
        if($secureName && $secureDate && $securePage){
            $pageContentModel = new getPageContentModel($securePage);
            $eventTimes = $pageContentModel->getTimesFromDB($secureName, $secureDate);
            return $eventTimes;
        }else{
            return "False credentials";
        }
    }    

    public function getTicketIDforEvent($time_Selection, $name, $date){
        $secureName = $this->sql_validator($name);
        $secureDate = $this->sql_validator($date);
        $secureTime_Selection = $this->sql_validator($time_Selection);
        $securePage = $this->sql_validator($this->page);

        if($secureName && $secureDate && $securePage && $secureTime_Selection){
            $pageContentModel = new getPageContentModel($securePage);
            $ticketID = $pageContentModel->getEventID($secureName, $secureDate, $secureTime_Selection);
            return $ticketID;
        }else{
            return false;
        }

    }
}
?>