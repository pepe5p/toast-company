var delayCheck = false;
var siteLoaded = false;

function slide(){
    if(delayCheck == true) $('.loading_screen').toggleClass('loaded');
    siteLoaded = true;
}

setTimeout(function(){
    delayCheck = true;
    if(siteLoaded == true) slide();
}, 500);

document.addEventListener("DOMContentLoaded", function() {
    slide();
});