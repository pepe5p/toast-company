var lastId = 0;
var myToasts = 0;
var errorExists = false;

String.prototype.replaceAt = function(index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}

function newOrderCheck(){
    $.ajax({
        type: 'post',
        url: 'php/get_new_orders.php',
        data: {last_id: lastId},
        success: function(data){

            data = JSON.parse(data);
            console.log(data);
            lastId = data.lastId;

            //MY TOASTS LIMIT
            myToasts += data.myNewToasts;

            //SUBSTRACING DELETED TOASTS
            var actualNumber = parseInt($('.actual_number').text());
            $(".actual_number").text(actualNumber - data.deletedToasts);

            //ERRORS
            if(data.error != "" && errorExists != data.error){
                errorExists = data.error;
                $("main").prepend(data.error);
            }
            else if(data.error == ""){
                errorExists = false;
                $("main > .error").remove();
            }

            //NEW ORDERS
            if(typeof data.queuesArray !== 'undefined'){
                for(i = 0; i < data.queuesArray.length; i++){
                    var queue = data.queuesArray[i];
                    var order = data.ordersArray[i];
                    if(($("#q" + queue).length == 0)){

                        $section = $("<section>",{
                            id: "q" + queue,
                            class: "box"
                        });
                        $("main").append($section);

                        $header = $("<header>",{
                            class: "header",
                            text: "KOLEJKA " + queue
                        });
                        $("#q" + queue).append($header);
                    }
                    var actualNumber = parseInt($('.actual_number').text());
                    $(".actual_number").text(actualNumber + 1);
                    $("#q" + queue).append(order);
                }
            }

            //CHANING STATES
            if(typeof data.statesArray !== 'undefined'){
                for(i = 0; i < data.orderIdsArray.length; i++){
                    var orderId = data.orderIdsArray[i];
                    var state = data.statesArray[i];
                    var toastType = data.toastsTypesArray[i];
                    var tile = $('#t' + orderId);

                    var number = (tile.attr('class')).charAt(12);
                    if(number != state){
                        tile.removeClass("s" + number);
                        tile.addClass("s" + state);
                        if(toastType != 3){
                            if(number == 4 && state != 4){
                                var actualNumber = parseInt($('.actual_number').text());
                                $(".actual_number").text(actualNumber + 1);
                            }
                            else if(state == 4){
                                var actualNumber = parseInt($('.actual_number').text());
                                $(".actual_number").text(actualNumber - 1);
                            }
                        }
                    }
                }
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    setInterval(newOrderCheck, 5000);
});