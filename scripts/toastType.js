var blocked = false;

document.addEventListener("DOMContentLoaded", function() {

    $('.type_tile').click(function(){

        var actualNumber = parseInt($('.actual_number').text());
        var totalNumber = parseInt($('.total_number').text());
        var everythingOK = true;

        if(myToasts >= 4){
            $('.order_panel > .order_box > .error').text("osiągnąłeś limit 4 tostów");
            everythingOK = false;
        }
        if(actualNumber >= totalNumber){
            $('.order_panel > .order_box > .error').text("tosty się skończyły");
            everythingOK = false;
        }
        if(blocked == true){
            $('.order_panel > .order_box > .error').text("poczekaj chwilę");
            everythingOK = false;
        }
        if(everythingOK == true){
            $('.order_panel > .order_box > .error').text("");
            
            $('.order_submit').prop("disabled", false);

            $('.type_tile').addClass('inactive');
            $('.toast_type').prop("checked", false);
            $(this).removeClass('inactive');
            $(this).find(".toast_type").prop("checked", true);
        }
    });
});