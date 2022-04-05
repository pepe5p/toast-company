function addOrder(){

    blocked = true;
    $('.order_panel > .order_box > .error').text("poczekaj chwilę");
    var type = $("input[name='type']:checked").val();
    $('.type_tile').addClass('inactive');
    $('.order_submit').prop("disabled", true);
    
    $.ajax({
        type: 'post',
        url: 'php/add_order.php',
        data: {type: type},
        success: function(data){
            console.log(data);
            newOrderCheck();
            $('.accepted_box').removeClass("inactive");
            setTimeout(function(){
                $('.accepted_box').addClass("inactive");
                blocked = false;
                $('.order_panel > .order_box > .error').text("");
            }, 2500);
        },
        error: function(data){
            console.log(data);
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    $('.order_submit').click(addOrder);
});