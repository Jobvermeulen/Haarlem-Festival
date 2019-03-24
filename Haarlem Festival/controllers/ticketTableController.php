<?php
    //this controller handles the four different tables from every event
    class ticketTableController{
        public $page;
        private $controller;
        public $tickets;

        //when this class is called from the html page -- make an controller + get the page + get the tickets for this event
        public function __construct($page){
            $this->controller = new ContentController($page);
            $this->page = $page;
            $this->tickets = $this->controller->getTicketContent();
        }
        
        //load the ticketTable
        public function loadTicketTable(){ 
            if(is_array($this->tickets)){
                //first get the ticket buttons, is needed to select a day
                $this->ticketHeader();
                //second prepare and print the table 
                $this->prepare_and_Print_dayTable();                
            }else{
                if(strpos($this->tickets, 'ERROR') == false){
                    echo "<p class='error'>Something is wrong, we're working on it!</p>";
                }else{
                    echo "<p class='error'>".$this->tickets."</p>";
                }
            }            
        }

        //make the buttons
        protected function ticketHeader(){
            //set a day to null to show that there is not a button made already
            $day_26 = 0; $day_27 = 0; $day_28 = 0; $day_29 = 0;

            //make an section where the buttons are being placed
            echo "<section class='ticket_day_tab'>";
            //walk through the complete array of tickets and check every ticket if the have an specific day
            for($int=0; $int<count($this->tickets); $int++){
                $date = $this->tickets[$int]['date'];
                switch ($date){
                    //for date 26-07-2019
                    case '2019-07-26':
                    //if there is not made an button for -- made if day == 1
                    if($day_26 != 1){
                        $day_26 = 1;
                        echo "<button class='tablinks' onclick=openDay('".$this->page."','".$date."') id='".$this->page."_tab_day_".$date."'>Show tickets for Friday July 26</button>";
                    }else{ }
                    break;

                    //for date 27-07-2019
                    case '2019-07-27':
                    //if there is not made an button for -- made if day == 1
                    if($day_27 != 1){
                        $day_27 = 1;
                        echo "<button class='tablinks' onclick=openDay('".$this->page."','".$date."') id='".$this->page."_tab_day_".$date."'>Show tickets for Saturday July 27</button>";
                    }else{ }
                    break;
                    
                    //for date 28-07-2019
                    case '2019-07-28':
                    //if there is not made an button for -- made if day == 1
                    if($day_28 != 1){
                        $day_28 = 1;
                        echo "<button class='tablinks' onclick=openDay('".$this->page."','".$date."') id='".$this->page."_tab_day_".$date."'>Show tickets for Sunday July 28</button>";
                    }else{ }
                    break;

                    //for date 29-07-2019
                    case '2019-07-29':
                    //if there is not made an button for -- made if day == 1
                    if($day_29 != 1){
                        $day_29 = 1;
                        echo "<button class='tablinks' onclick=openDay('".$this->page."','".$date."') id='".$this->page."_tab_day_".$date."'>Show tickets for Monday July 29</button>";
                    }else{ }
                    break;

                    //there is no default button
                    default:

                    break;
                }
            }
            echo "</section>";                           
        }

        //prepare each day and eventually print the tables
        protected function prepare_and_Print_dayTable(){
            //make 4 day tables
            $day_Ticket_section_26= ''; $day_Ticket_section_27= ''; $day_Ticket_section_28= ''; $day_Ticket_section_29= '';
            $all_access = '';
            
            //walk through the whole array and check for every day the table header and a ticketrow
            for($int=0; $int<count($this->tickets); $int++){
                $date = $this->tickets[$int]['date'];
                switch ($date){
                    //for date 26-07-2019
                    case '2019-07-26':
                    if($day_Ticket_section_26 == ''){
                        //step 1. Set an tablehead for the table                        
                        $day_Ticket_section_26 .= $this->setTableHead($int,$date);                        
                    }else{ }
                    //step 2. Set an ticketrow for the table
                    $day_Ticket_section_26 .= $this->setTicketRow($int,$date);     
                    break;

                    //for date 27-07-2019
                    case '2019-07-27':
                    if($day_Ticket_section_27 == ''){
                        //step 1. Set an tablehead for the table 
                        $day_Ticket_section_27 .= $this->setTableHead($int,$date);                        
                    }else{ }
                    //step 2. Set an ticketrow for the table
                    $day_Ticket_section_27 .= $this->setTicketRow($int,$date);     
                    break;
                    
                    //for date 28-07-2019
                    case '2019-07-28':
                    if($day_Ticket_section_28 == ''){
                        //step 1. Set an tablehead for the table 
                        $day_Ticket_section_28 .= $this->setTableHead($int,$date);                        
                    }else{ }                   
                    //step 2. Set an ticketrow for the table
                    $day_Ticket_section_28 .= $this->setTicketRow($int,$date);     

                    break;

                    //for date 29-07-2019
                    case '2019-07-29':
                    if($day_Ticket_section_29 == ''){
                        //step 1. Set an tablehead for the table 
                        $day_Ticket_section_29 .= $this->setTableHead($int,$date);                        
                    }else{ }                    
                    //step 2. Set an ticketrow for the table                    
                    $day_Ticket_section_29 .= $this->setTicketRow($int,$date);     
                    break;

                    //the default is only for the all access tickets -- they don't have any date
                    default:
                        $value = $this->tickets[$int]['name'];
                        if($value == 'All-access pass multiday for 26/27/28-07-2019'){
                            $all_access = $this->setTicketRow($int,$date);
                        }
                    break;
                }                
            }
            //eventually you can print the table
            $this->printDayTable($day_Ticket_section_26, $day_Ticket_section_27, $day_Ticket_section_28, $day_Ticket_section_29, $all_access);           
        }

        //print the table
        protected function printDayTable($day_Ticket_section_26, $day_Ticket_section_27, $day_Ticket_section_28, $day_Ticket_section_29, $all_access){
            //for day 26-07-2019
            if(!empty($day_Ticket_section_26)){
                //add the all access ticket
                $day_Ticket_section_26 .= $all_access;
                $day_Ticket_section_26 .= "</table>";
                $day_Ticket_section_26 .= "</section>";
                echo $day_Ticket_section_26;
            }

            //for day 27-07-2019
            if(!empty($day_Ticket_section_27)){ 
                //add the all access ticket
                $day_Ticket_section_27 .= $all_access;               
                $day_Ticket_section_27 .= "</table>";
                $day_Ticket_section_27 .= "</section>";
                echo $day_Ticket_section_27;
            }

            //for day 28-07-2019
            if(!empty($day_Ticket_section_28)){
                //add the all access ticket
                $day_Ticket_section_28 .= $all_access;
                $day_Ticket_section_28 .= "</table>";
                $day_Ticket_section_28 .= "</section>";
                echo $day_Ticket_section_28;
            } 

            //for day 29-07-2019
            if(!empty($day_Ticket_section_29)){
                //add the all access ticket
                $day_Ticket_section_29 .= $all_access;
                $day_Ticket_section_29 .= "</table>";
                $day_Ticket_section_29 .= "</section>";
                echo $day_Ticket_section_29;
            }                
        }

        //set the table head for a specific day
        protected function setTableHead($int,$date){
            //add some basic information
            $string_header  = "<section id='".$this->page."_day_table_".$date."_section' class='tickets_section'>";
            $string_header .= "<table id='".$this->page."_day_table_".$date."' class='tickets'>";
            $string_header .= "<tr class='table_head'>";

            //pick the row where the prepare_and_Print_dayTable function was stopped at
            $row = $this->tickets[$int];   
            foreach ($row as $key => $value) {
                switch($key){           
                    //if there is a time value        
                    case 'time':
                    if(($this->page != 'food') && ($this->page != 'historic')){
                        $string_header .= "<th>Time</th>";
                    }
                    break;                    

                    //if there is a location value
                    case 'locationName':
                        $string_header .= "<th>Location</th>";
                    break; 

                    //if there is a artists value
                    case 'artists':
                        $string_header .= "<th>Artists</th>";
                    break;

                    //if there is a name value
                    case 'name':                       
                        $string_header .= "<th>".$key."</th>";                        
                    break;

                    //if there is a halljazz value
                    case 'hallJazz':
                        $string_header .= "<th>Hall</th>";
                    break;                   

                    //if there is a price value
                    case 'price':
                        $string_header .= "<th>Price</th>";
                    break;

                    //if there is a childprice value
                    case 'ChildPrice':
                        $string_header .= "<th>Price Children</th>";
                    break;

                    //if there is a type food value
                    case 'typeFood':
                        $string_header .= "<th>type food</th>";
                    break;              

                    //there is no default value
                    default:

                    break;                    
                }            
            }
            //add some basic info at the end
            $string_header .= "<th>Add to cart</th>";            
            $string_header .= "</tr>";
            return $string_header;
        }

        //set the ticket row for the specific day 
        protected function setTicketRow($int,$date){
            $ticket_row = "<tr>";

            //pick the row where the prepare_and_Print_dayTable function was stopped at
            $row = $this->tickets[$int];            
            foreach ($row as $key => $value) {
                switch($key){        
                    //if there is a time value 
                    case 'time':
                        if(($this->page!='food') && ($this->page != 'historic')){
                            $ticket_row .= "<td>".$value."</td>";
                        }
                    break;
                    
                    //if there is a location value
                    case 'locationName':
                        $ticket_row .= "<td>".$value."</td>";
                    break; 

                    //if there is a artists value
                    case 'artists':
                        $ticket_row .= "<td>".$value."</td>";
                    break;

                    //if there is a name value
                    case 'name':                        
                        $ticket_row .= "<td>".$value."</td>";
                    break;

                    //if there is a hallJazz value
                    case 'hallJazz':
                        $ticket_row .= "<td>".$value."</td>";
                    break;                   

                    //if there is a price value
                    case 'price':
                        $ticket_row .= "<td>€ ".$value."</td>";
                    break;

                    //if there is a childprice value
                    case 'ChildPrice':
                        $ticket_row .= "<td>€ ".$value."</td>";
                    break;

                    //if there is a typeFood value
                    case 'typeFood':
                        $ticket_row .= "<td>".$value."</td>";
                    break;                     

                    //there is no defeault value
                    default:

                    break;                    
                }            
            }
            //add the shoppingcart
            if($row['price']!=0){
                //add an http query -- is an array to parse through html
                $arrayToString = (http_build_query($row));                
                $ticket_row .= "<td><button class='add_to_cart' onclick=addToCart('".$arrayToString."','".$this->page."')><img src='images/add_to_cart.png'></button></td>";
            }else{ 
                $ticket_row .= "<td><button class='add_to_cart'><img src='images/no_cart.png'></button></td>";
            }
            $ticket_row .= "</tr>";

            //return the html string
            return $ticket_row;
        }
       
    }

?>