<?php
    class popupController{
        public function createBox($page, $arrayToString){
            //build a html string 
            //begin with basics that every event needs
            $html_string = $this->addBasicInfo($page, $arrayToString);     
            
            //for the jazz and dance event 
            if($page == 'jazz' || $page == 'dance'){
                $html_string .= $this->jazzAndDanceBox($arrayToString);
                $html_string .= $this->addBasicInfoEnd($arrayToString, $page);

            //for the food event
            }else if($page == 'food'){
                $html_string.= $this->foodBox($arrayToString, $page);
                $html_string .= $this->addBasicInfoEnd($arrayToString, $page);

            //for the historic event
            }else if($page == 'historic'){
                $html_string.= $this->historicBox($arrayToString, $page);
                $html_string .= $this->addBasicInfoEnd($arrayToString, $page);
            }

            //for the unkown event ;)
            else{
                $html_string .= "<p class='error'>there is no ticketbox for this event avialable</p> <button id='close_popup'>Close</button>  </section>";
                return $html_string;                
            }

            //add the circle loader
            $html_string .= "</section> <section id='loader'></section>";
            //return the string to the ajax header
            return $html_string;
        }

        //add basic info for the popup
        private function addBasicInfo($page, $arrayToString){
            //strip the arrayToString -- this contains information about the chosen ticket
            $outputArray;
            parse_str($arrayToString, $outputArray);
            $name = $outputArray['name'];

            //make the popup
            $html_string = "<section class='event_Popup_context'>";
            $html_string .= "<h3>You choose: ".$name;

            //if the array value date not empty is
            if(!empty($outputArray['date'])){
                $date = $outputArray['date'];
                $html_string .= " on this day: ".$date."</h3>";
            }else{
                //if the value date empty is -- close the h3
                $html_string .= "</h3>";
            }

            //add an error class
            $html_string .= "<p class='error'></p>";
            //return the html string
            return $html_string;
        }

        //add the basic info 
        private function addBasicInfoEnd($arrayToString, $page){
            $outputArray;
            parse_str($arrayToString, $outputArray);
            if(($page == 'dance') || ($page == 'jazz')){
                $ticketID = $outputArray['ticketID'];

                $html_string = "<button id='close_popup'>Close</button>
                                <button id='add_popup' class='floatright' value='".$ticketID."'>Add</button>";
                return $html_string;
            }else{
                $name = $outputArray['name'];
                $date = $outputArray['date'];
                //set array with ticketinfo to add button
                $array = array("name"=>$name, "date"=>$date);
                $newArrayToString = (http_build_query($array));                

                //Add the buttons for the popup
                $html_string = "<button id='close_popup'>Close</button>
                                <button id='add_popup' value='".$newArrayToString."' class='floatright'>Add</button>";
                return $html_string;
            }
        }

        //build the popoup for the Jazz and Dance event
        private function jazzAndDanceBox($arrayToString){
            $outputArray;
            parse_str($arrayToString, $outputArray);
            $ticketID = $outputArray['ticketID'];

            //the input boxes
            $html_string= " <section id='fill_in' >
                                <p>Amount of tickets:</p>
                                <input id='amount_of_tickets' type='number'>
                            </section>";

            return $html_string;
        }

        //create a Food PopUp ticket message -- contains 2 functions!
        private function foodBox($arrayToString, $page){
            $outputArray;
            parse_str($arrayToString, $outputArray);
            $name = $outputArray['name'];
            $date = $outputArray['date'];
            $adultPrice = $outputArray['price'];
            $childPrice = $outputArray['reducedPrice'];

            //Get the avaible times for the chosen restaurant
            $html_string = "<section class='TimeSelection'>".$this->getTimesForEvent($page,$name,$date)."</section>";

            //display the prices + create input boxes
            $html_string .= "<section id='fill_in'>
                                <section class='adults floatleft'>
                                    <section class='Price'>
                                        <p class='Name'>Adult price</p>
                                        <p>€".$adultPrice."</p>
                                    </section>
                                    <section class='inputFields'>
                                        <p>Amount of adult tickets:</p>
                                        <input id='Adult_amount_of_tickets' type='number'>
                                    </section>
                                </section>                             
                                <section class='Childs'>
                                    <section class='Price'>
                                        <p class='Name'>Child price</p>
                                        <p>€".$childPrice."</p>
                                    </section>
                                    <section class='inputFields'>
                                        <p>Amount of child tickets:</p>
                                        <input id='Child_amount_of_tickets' type='number'> 
                                    </section>
                                </section>";

            //User can fill in any request for the restaurant (example allergies)
            $html_string .= "   <section class='request'>
                                    <h4>Special request</h4>
                                    <textarea id='special_request' type='message'></textarea>
                                </section>
                            </section>";

            
            return $html_string;
        }
       
        private function historicBox($arrayToString, $page){
            $outputArray;
            parse_str($arrayToString, $outputArray);
            $name = $outputArray['name'];
            $date = $outputArray['date'];                            
            $price = $outputArray['price'];

            //add the timeselection input for the selected ticket
            $html_string = "<section class='TimeSelection'>".$this->getTimesForEvent($page,$name,$date)."</section>";

            //display the prices + create input boxes
            $html_string .= "   <section id='fill_in'>            
                                    <section class='AmountOfTickets'>
                                        <h4>Choose your amount of tickets:</h4>
                                        <section class='Price'>
                                            <p class='Name'>Price</p>
                                            <p>€".$price."</p>
                                        </section>
                                        <section class='inputFields'>
                                            <p>Amount of tickets:</p>
                                            <input id='amount_of_tickets' type='number'>
                                        </section>
                                    </section>
                                </section>";  
            
            return $html_string;
        }

        private function getTimesForEvent($page,$name,$date){
            //get an array off times that are relevent for this event
            $ContentController = new ContentController($page);
            $eventTimes = $ContentController->getEventTimes($name,$date);

            //if the output is an array
            if(is_array($eventTimes)){
                $html_string = "<p>Available times for this event: </p> <select name='times' id='times'>";
                for($i = 0; $i<count($eventTimes);$i++){
                    $value = $eventTimes[$i]['time'];
                    $html_string .= "<option value='".$value."'>".$value."</option>";
                }
                $html_string .= "</select>";
            }else{
                //if the output is an error
                $html_string .= "<p>".$eventTimes."</p>";
            }

            //return the html 
            return $html_string;
        }
    }
?>