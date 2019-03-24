$(document).ready(function(){
    //sets one day open for the ticket table 
    if(document.getElementById("dance_tab_day_2019-07-27")){
        openDay('dance', '2019-07-27');
    }
    if(document.getElementById("jazz_tab_day_2019-07-26")){
        openDay('jazz', '2019-07-26');
    }
    if(document.getElementById("food_tab_day_2019-07-26")){
        openDay('food', '2019-07-26');
    }
    if(document.getElementById("historic_tab_day_2019-07-26")){
        openDay('historic', '2019-07-26');
    }
});

//set a day open in the ticket table
function openDay(evt, Day) {
    var i, tickets_section, tablinks;
    tickets_section = document.getElementsByClassName("tickets_section");
    for (i = 0; i < tickets_section.length; i++) {
        tickets_section[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("activetablink");
    }
    
    document.getElementById(evt+'_day_table_'+Day+'_section').style.display = "block";
    document.getElementById(evt+'_tab_day_'+Day).classList.add("activetablink");
}

//if the addToCart button calls this function
//Then a popup will be made with some php 
//this popup contains of a html string, that will be appended to the excisting html code
function addToCart(arrayToString, page){
    if(arrayToString && page){
        var ajaxFunction = 'createPopup';
        $.ajax({
            url: '/ajax',
            data: {page: page, arrayToString: arrayToString, ajaxFunction: ajaxFunction},
            type: "POST",
            success: function(output) {
                if(output){
                    //append the popup to the HTML
                    $( ".event_Popup" ).append(output);
                    //Set the popup open and add event listeners
                    openPopUp(page);
                }else{
                    alert("Some data didn't made it through. RIP data. Please reload the page to get new data!");
                    $('.event_Popup_context .error').css('display', 'none');
                    $('.event_Popup_context').css('display', 'none');
                    showAlert();  
                }        
            }
        });
    }else{
        alert("Some data didn't made it through. RIP data. Please reload the page to get new data!");

     }      
}

function openPopUp(page){
    //step 1: Open the popup
    $('.event_Popup').css('display', 'block');
    $('.event_Popup_context').css('display', 'block');

    //step 3: set 2 event listeners for the buttons in the popup
    //for the addButton
    var addButton = document.getElementById('add_popup');
    addButton.addEventListener('click', function(e){
        $(this).off('click');            
        checkadd(page);
        ticketID = undefined;
    });
    //for the closeButton
    var closeButton = document.getElementById('close_popup');
    closeButton.addEventListener('click', function(e){
        $(this).off('click');
        Close_popup();
        ticketID = undefined;
    });
}

function checkadd(page){
    switch(page){
        case 'dance':
            var amount_of_tickets = document.getElementById("amount_of_tickets").value;
            //if the amount of tickets that has been filled in is less than zero/is zero
            if(amount_of_tickets <= 0 || amount_of_tickets == ''){
                ticketValueNull();
            }else{
                var ticketID = document.getElementById("add_popup").value;
                DanceORJazzTicketSession(ticketID, amount_of_tickets);
            }
        break;

        case 'jazz':
            var amount_of_tickets = document.getElementById("amount_of_tickets").value;
            //if the amount of tickets that has been filled in is less than zero/is zero
            if(amount_of_tickets <= 0 || amount_of_tickets == ''){
                ticketValueNull();
            }else{
                var ticketID = document.getElementById("add_popup").value;
                DanceORJazzTicketSession(ticketID, amount_of_tickets);
            }
        break;

        case 'food':
            var Adult_amount_of_tickets = document.getElementById("Adult_amount_of_tickets").value;
            var Child_amount_of_tickets = document.getElementById("Child_amount_of_tickets").value;
            var time_Selection = document.getElementById("times").value;
            var arrayToString = document.getElementById("add_popup").value;
            var request = document.getElementById("special_request").value;
            if(request == ''){
                request = 1;
            }

            var nullCounter = 0;
            //for the adult tickets
            //if the amount of tickets that has been filled in is less than zero/is zero
            if(Adult_amount_of_tickets <= 0 || Adult_amount_of_tickets == ''){
                nullCounter ++;
            }else{                
                document.getElementById("loader").style.display = "block";
                FoodORHistoricTicketSession(Adult_amount_of_tickets, time_Selection, arrayToString, page, request);
            }
            //For the child tickets
            //if the amount of tickets that has been filled in is less than zero/is zero
            if(Child_amount_of_tickets <= 0 || Child_amount_of_tickets == ''){
                nullCounter ++;
            }else{
                document.getElementById("loader").style.display = "block";
                arrayToString += '&type=childTicket';
                FoodORHistoricTicketSession(Child_amount_of_tickets, time_Selection, arrayToString, page, request);
            }

            if(nullCounter == 2){
                ticketValueNull();
            }
        break;

        case 'historic':
            var amount_of_tickets = document.getElementById("amount_of_tickets").value;
            var time_Selection = document.getElementById("times").value;
            var arrayToString = document.getElementById("add_popup").value;
            var request = 1;
            //if the amount of tickets that has been filled in is less than zero/is zero
            if(amount_of_tickets <= 0 || amount_of_tickets == ''){
                ticketValueNull();
            }else{
                document.getElementById("loader").style.display = "block";
                FoodORHistoricTicketSession(amount_of_tickets, time_Selection, arrayToString, page, request);
            }
        break;

        default:

        break;
    }    
}

//call with ajax to set the selected ticket in the session
function DanceORJazzTicketSession(ticketID, amount_of_tickets){
    var ajaxFunction = 'setTicketInSession_Dance_Jazz';
    $.ajax({
        url: '/ajax',
        data: {ticketID: ticketID, amount: amount_of_tickets, ajaxFunction:ajaxFunction},
        type: "POST",
        success: function(output){
            if(output == true){
                $('.event_Popup_context .error').css('display', 'none');
                $('.event_Popup_context').css('display', 'none');
                showAlert();                    
            }else{
                alert('Something went wrong!');
                $('.event_Popup_context .error').css('display', 'none');
                $('.event_Popup_context').css('display', 'none');
                Close_popup();
           }            
        }
    });    
}

//call with ajax to set the selected ticket in the session
function FoodORHistoricTicketSession(amount_of_tickets, time_Selection, arrayToString, page, request){
    var ajaxFunction = 'setTicketInSession_Historic_Food';

    $.ajax({
        url: '/ajax',
        data: {amount_of_tickets: amount_of_tickets, time_Selection: time_Selection, arrayToString: arrayToString, page:page, request:request, ajaxFunction:ajaxFunction},
        type: "POST",
        success: function(output){
            if(output == true){
                $('.event_Popup_context .error').css('display', 'none');
                $('.event_Popup_context').css('display', 'none');
                showAlert();                    
            }else{
                alert('Something went wrong!');
                $('.event_Popup_context .error').css('display', 'none');
                $('.event_Popup_context').css('display', 'none');
                Close_popup();
            }            
        }
    }); 
}

//if the ticket amount is null, the popup changes to a red background colour
function ticketValueNull(){
    $('.event_Popup_context .error').css('display', 'block');
    $('.event_Popup_context .error').text("You can't buy zero or less than zero tickets!");1
    $('#fill_in p').css({'text-decoration': 'underline'});

    //background change
    $('.event_Popup_context').css({'background-color': 'red'})
    setTimeout(function(){ $('.event_Popup_context').css({'background-color': '#b9b9b9'}); }, 1000);
}

//close the popup is being called when the close button is pressed + when there is an error
function Close_popup(){
    $('.event_Popup').css('display', 'none');
    $( ".event_Popup_context" ).remove();
    $( "#loader" ).remove();

}

//show an alert if the ticket was succesfully added to the session (shoppingcart)
function showAlert(){
    document.getElementById("loader").style.display = "none";
    Close_popup();
    
    var x = document.getElementById("alertbar");  
    x.className = "show";  
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}