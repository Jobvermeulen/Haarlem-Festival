<?php
    //!this file handles the ajax calls from JavaSript!

    //set the ticket in the session for dance+jazz
    //if the values are not empty + is the function is setTicketInSession_Dance_Jazz
    if(((isset($_POST['ticketID']) && !empty($_POST['ticketID'])) && (isset($_POST['amount']) && !empty($_POST['amount']))) && ($_POST['ajaxFunction'] == 'setTicketInSession_Dance_Jazz')){
        $ticketID = $_POST['ticketID'];
        $amount = $_POST['amount'];
        $request = 1;

        $sessionTicket = new sessionController();
        $result = $sessionTicket->setTicketInSession($ticketID, $amount, $request);
        
        //return the html string to the js file with a echo
        if($result == true){
            echo $result;
        }else{
            echo false;
        }
    }else   
    
    //set ticketID in the session food+historic event
    //if the values are not empty + is the function is setTicketInSession_Historic_Food
    if (((isset($_POST['amount_of_tickets']) && !empty($_POST['amount_of_tickets'])) && (isset($_POST['time_Selection']) && !empty($_POST['time_Selection'])) 
        && (isset($_POST['arrayToString']) && !empty($_POST['arrayToString'])) && (isset($_POST['page']) && !empty($_POST['page'])) 
        && (isset($_POST['request']) && !empty($_POST['request']))) && ($_POST['ajaxFunction'] == 'setTicketInSession_Historic_Food')){
        $amount_of_tickets = $_POST['amount_of_tickets'];
        $time_Selection = $_POST['time_Selection'];
        $arrayToString = $_POST['arrayToString'];
        $request = $_POST['request'];
        $page = $_POST['page'];

        $ticketID = 0;
        $sessionTicket = new sessionController();
        $ticketID = $sessionTicket->getTicketID_Historic_Food($time_Selection, $arrayToString, $page);
        if($ticketID != false){
            $result = $sessionTicket->setTicketInSession($ticketID[0]['ticketID'], $amount_of_tickets, $request);
        }else{
            echo 'false';
        }
        
        //return the html string to the js file with a echo
        if($result == true){
            echo $result;
        }else{
            echo false;
        }      
    }else 

    //ajax call to create a Popup for the selected event
    //if the values are not empty + is the function is createPopup
    if ((isset($_POST['page']) && !empty($_POST['page']) && isset($_POST['arrayToString']) && !empty($_POST['arrayToString'])) && ($_POST['ajaxFunction'] == 'createPopup')){
        $page = $_POST['page'];
        $arrayToString = $_POST['arrayToString'];
        
        $popupController = new popupController();
        $result = $popupController->createBox($page, $arrayToString);

        //return the html string to the js file with a echo
        echo $result;
    }

    //return that there is no ajax method for this call
    else{
        $result = 'error_There_Is_No_Ajax_Call_For_This_Method';
        echo $result;
    }

    
?>
