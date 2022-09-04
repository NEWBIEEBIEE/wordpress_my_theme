$(function() {

    const nav = $('.sp-nav');
    const closeButton = nav.find('.menu').children('ul');
    closeButton.append('<li class="close"><span>閉じる</span></li>');
    const hum = $('#hamburger, .close');
    hum.on('click', function(){
       nav.toggleClass('toggle');
    });
 });