<?php
class sessionController
{
    public function setTicketInSession($ticketID, $amount, $request)
    {
        //include DAL object
        require_once("/home/thomaur292/domains/haarlem-festival.nl/public_html/models/getPageContentModel.php");
        $contentModel = new getPageContentModel();

        //inable access to session
        session_start();

        //if the same ticket is already in session just add to the amount
        for ($i = 0; $i < count($_SESSION); $i++) {
            if ($_SESSION["ticket" . $i]["ticketID"] == $ticketID) {
                $_SESSION["ticket" . $i]["amount"] += $amount;

                return true;
            }
        }

        //else create new ticket object and add to session
        $int = count($_SESSION);
        if ($request == null || $request == 1) {
            $tickets = array(
                'ticketID' => $ticketID,
                'name' => $contentModel->getNameByTicket($ticketID),
                'time' => $contentModel->getTicketTime($ticketID),
                'price' => $contentModel->getTicketPrice($ticketID),
                'amount' => $amount);
        } else {
            $tickets = array(
                'ticketID' => $ticketID,
                'name' => $contentModel->getNameByTicket($ticketID),
                'time' => $contentModel->getTicketTime($ticketID),
                'price' => $contentModel->getTicketPrice($ticketID),
                'amount' => $amount,
                'request' => $request);
        }

        //add to session
        $_SESSION['ticket' . $int] = $tickets;

        //extra check if the ticket was added to session
        if ($_SESSION['ticket' . $int] == $tickets) {
            return true;
        } else {
            return false;
        }
    }

    //get an ticketID for the events:  Historic and Food
    public function getTicketID_Historic_Food($time_Selection, $arrayToString, $page)
    {
        //strip the array wich contains information about the ticket
        $outputArray;
        parse_str($arrayToString, $outputArray);
        $name = $outputArray['name'];
        $date = $outputArray['date'];

        //get the ticketID for this specified for this ticket
        $contentController = new ContentController($page);
        $ticketID = $contentController->getTicketIDforEvent($time_Selection, $name, $date);

        //if the ticket is not false
        if ($ticketID != false){
            //if the page is an food page and there is an type defined
            //then the type must be added to the ticketID (for example when you have an child ticket for an restaurant)
            if(($page == 'food') && (!empty($outputArray['type']))){
                $type = $outputArray['type'];
                $ticketID[0]['ticketID'] .= '_'.$type;
            }
            return $ticketID;
        } else {
            return false;
        }
    }
}
?>