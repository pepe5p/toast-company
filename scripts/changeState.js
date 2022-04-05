document.addEventListener("DOMContentLoaded", function() {
    $(document).on('click', ".order_tile", (function(){

        var box = $(this);
        box.addClass('clicked');
        setTimeout(function(){
            box.removeClass('clicked');
        }, 100);

        var id = parseInt($(this).attr('id').replace('t', ''));
        $.ajax({
            type: 'post',
            url: 'php/change_order.php',
            data: {id: id},
            success: function(data){
                newOrderCheck();
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    }));
});