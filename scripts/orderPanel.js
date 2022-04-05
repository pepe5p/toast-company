function show(){
    $('#orderPanel').toggleClass('active');
    $('.icon-angle-circled-up').toggleClass('active');
    $('main').click(hide);
}

function hide(){
    $('#orderPanel').toggleClass('active');
    $('.icon-angle-circled-up').toggleClass('active');
    $('main').off();
}

document.addEventListener("DOMContentLoaded", function() {
    $('#orderPanelButton').click(show);
});