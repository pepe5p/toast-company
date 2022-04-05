function changeName(){
    var name = $('.input_name').val();
    if(name.length >= 3){
        if(name.length <= 20){
            $('.order_submit').prop("disabled", false);
            $('.error').text("pamiętaj, że jeśli nie rozpoznamy twojej nazwy to nie otrzymasz tosta");
        } else {
            $('.error').text("nazwa powinna mieć conajwyżej 20 liter");
            $('.order_submit').prop("disabled", true);
        }
    } else {
        $('.error').text("nazwa powinna mieć conajmniej 3 litery");
        $('.order_submit').prop("disabled", true);
    }
}

function submitForm(){
    $('.input_name').prop("disabled", true);
    slide();
    $.ajax({
        type: 'post',
        url: 'php/create_cookie.php',
        data: {name: $('.input_name').val()},
        success: function(data){
            console.log(data);
        },
        error: function(data){
            console.log(data);
        }
    });
    setTimeout(function(){ 
        window.location = 'main.php';
    }, 1000);
}

document.addEventListener("DOMContentLoaded", function() {
    $('.input_name').keyup(changeName);
    $('.order_submit').click(submitForm);
});