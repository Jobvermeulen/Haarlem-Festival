<?php
include_once('database.php');
class getPageContentModel
{
    public $page;
    public $con;

    public function __construct($page = "")
    {
        $db = database::getInstance();
        $this->con = $db->con;
        $this->page = $page;
    }

    //convert query result to array
    private function ConvertResultToArray($result)
    {
        //if there are more than 0 rows, put result in array and return array. Else return false
        if ($result->num_rows > 0) {
                // output data of each row
            $rows;
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $rows[$i] = $row;
                $i++;
            }
            return $rows;
        } else {
            return false;
        }
    }

    public function getTextContentFromDB()
    {
        $sql = "SELECT text FROM `Content_Text` WHERE eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "')";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    public function getImageContentFromDB()
    {
        $sql = "SELECT * FROM `Content_Images` WHERE eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "')";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    public function getFoodRestaurantCardContentFromDB()
    {
        $sql = "SELECT Tickets.name, Tickets.starsFood, Tickets.typeFood, Location.street, Location.zipcode, Location.city, Location.url, Content_Images.image, Content_Images.altText        
        FROM Tickets 
        INNER JOIN Location ON Location.locationID=Tickets.locationID 
        INNER JOIN Web_Placement ON Web_Placement.placementID=Tickets.webPlacementID 
        INNER JOIN Content_Images ON Content_Images.placementID=Web_Placement.placementID 
        WHERE Tickets.eventID = 4 GROUP BY `name`;"; //eventID = 4 -> Food
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    //Get the tickets from the DB -- contains 5 functions!.
    public function getTicketsFrom_DB()
    {   
        //if the page is an dance page
        switch ($this->page) {
            case 'dance':
                $result = $this->getTicketsFromDB_Dance();
                break;

            //if the page is an food page
            case 'food':
                $result = $this->getTicketsFromDB_Food();
                break;       
                
            //if the page is an jazz page
            case 'jazz':
                $result = $this->getTicketsFromDB_Jazz();
                break;

            //if the page is an historic page
            case 'historic':
                $result = $this->getTicketsFromDB_Historic();
                break;

            //if there is no page
            default:
                $result = 'ERROR_no_valid_event!';
                break;
        }
        return $result;
    }

    //Get the tickets from the DB for Dance.
    public function getTicketsFromDB_Dance()
    {
        $sql = "SELECT Tickets.ticketID, Tickets.eventID, Location.name as locationName, Tickets.name, Tickets.description, Tickets.notice,
                Tickets.time, Tickets.date, Tickets.duration, Tickets.quantity, Tickets.price, Tickets.reducedPrice, Tickets.artists 
                FROM Tickets LEFT JOIN Location ON Tickets.locationID=Location.LocationID  WHERE Tickets.eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "');";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    //Get the tickets from the DB for Food.
    public function getTicketsFromDB_Food()
    {
        $sql = "SELECT Tickets.ticketID, Tickets.name, Tickets.time,
                Tickets.date, Tickets.price, Tickets.reducedPrice, Tickets.typeFood
                FROM Tickets WHERE Tickets.eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "')
                GROUP BY Tickets.date, Tickets.name;";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    //Get the tickets from the DB for Jazz.
    public function getTicketsFromDB_Jazz()
    {
        $sql = "SELECT Tickets.ticketID, Tickets.eventID, Tickets.time, Tickets.date, Tickets.name, Location.name as locationName, Tickets.hallJazz,  Tickets.description, Tickets.notice,
                Tickets.duration, Tickets.quantity, Tickets.price, Tickets.reducedPrice 
                FROM Tickets LEFT JOIN Location ON Tickets.locationID=Location.LocationID WHERE Tickets.eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "') ORDER BY Tickets.date;";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    //Get the tickets from the DB for Historic.
    public function getTicketsFromDB_Historic()
    {
        $sql = "SELECT Tickets.ticketID, Tickets.eventID, Tickets.time, Tickets.date, Tickets.name, Tickets.price, Tickets.tourLanguageHistoric
                FROM Tickets WHERE Tickets.eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "') GROUP BY Tickets.name, Tickets.date 
                ORDER BY Tickets.date ;";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    public function getHistoricLocations()
    {
        $sql = "SELECT name FROM Location WHERE eventID = 1";
        $result = $this->con->query($sql);

        if (!empty($result)) {
            return $this->ConvertResultToArray($result);
        } else {
            echo "No locations found";
        }
    }

    //get the event times for an ticket 
    public function getTimesFromDB($name, $date)
    {
        $sql = "SELECT Tickets.time FROM Tickets 
                WHERE Tickets.eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "') 
                AND Tickets.name LIKE '" . $name . "' AND Tickets.date = '" . $date . "'
                GROUP BY Tickets.time ORDER BY Tickets.time;";
        $result = $this->con->query($sql);

        return $this->ConvertResultToArray($result);
    }

    //get the TIcketID
    public function getEventID($name, $date, $time_Selection)
    {
        $sql = "SELECT Tickets.ticketID FROM Tickets WHERE Tickets.eventID = (SELECT eventID FROM Events WHERE eventname LIKE '" . $this->page . "') 
                AND Tickets.name LIKE '" . $name . "' AND Tickets.date = '" . $date . "' AND Tickets.time = '" . $time_Selection . "' ";
        $result = $this->con->query($sql);
        return $this->ConvertResultToArray($result);
    }

    public function getNameByTicket($ticketID)
    {
        $sql = "select name from Tickets where ticketID = " . $ticketID;
        $result = $this->con->query($sql);

        if ($result) {
            return $result->fetch_object()->name;
        } else {
            echo "No name found for ticket " . $ticketID;
        }
    }

    public function getTicketPrice($ticketID)
    {
        $sql = "select price from Tickets where ticketID = " . $ticketID;
        $result = $this->con->query($sql);

        if ($result) {
            return $result->fetch_object()->price;
        } else {
            return "No price found for ticket " . $ticketID;
        }
    }

    public function getTicketTime($ticketID)
    {
        $sql = "select date, time from Tickets where ticketID = " . $ticketID;
        $result = $this->con->query($sql);

        if ($result) {
            $row = $result->fetch_row();
            return  "{$row[0]} {$row[1]}";
        } else {
            return "No date/time found for ticket " . $ticketID;
        }
    }
}
?>