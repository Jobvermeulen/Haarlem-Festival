$(document).ready(function(){
    document.getElementById("dance_tab_day_27").click();

    $('.close_popup').click(function(){
        $('.event_Popup').css('display', 'none');
        //if there is shown any error, remove them
        $('.event_Popup_context .error').css('display', 'none');
        $('#fill_in p').css({'text-decoration': 'none'});
    });
    
    //add button (popup)
    $('.add_popup').click(function(){
        var amount_of_tickets = document.getElementById("amount_of_tickets").value;
        if(amount_of_tickets < 0 || amount_of_tickets == ''){
            //show error
            $('.event_Popup_context .error').css('display', 'block');
            $('.event_Popup_context .error').text("You can't buy zero or less than zero tickets!");
            $('#fill_in p').css({'text-decoration': 'underline'});

            //background change
            $('.event_Popup_context').css({'background-color': 'red'})
            setTimeout(function(){ $('.event_Popup_context').css({'background-color': '#FE982F'}); }, 1000);           
        }else{
            $('.event_Popup_context .error').css('display', 'none');
            $('.event_Popup_context').css('display', 'none');
            document.getElementById("loader").style.display = "block";
            var newvar = setTimeout(showAlert, 1500);
        }        
    });
    
});

function openDay(evt, Day) {
    var i, dance_tickets_section, tablinks;
    dance_tickets_section = document.getElementsByClassName("dance_tickets_section");
    for (i = 0; i < dance_tickets_section.length; i++) {
        dance_tickets_section[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("activetablink");
    }
    
    document.getElementById('Dance_day_table_'+Day+'_section').style.display = "block";
    document.getElementById('dance_tab_day_'+Day).classList.add("activetablink");

}

function addToCart(event, day){
    var ticketID = this.value;
    $('.event_Popup').css('display', 'block');
    $('.event_Popup_context').css('display', 'block');
    //clear the input fields
    var amount_of_tickets = document.getElementById('amount_of_tickets');
    amount_of_tickets.value = '';
}

function showAlert(){
    document.getElementById("loader").style.display = "none";
    $('.event_Popup').css('display', 'none');

    var x = document.getElementById("alertbar");  
    x.className = "show";  
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
