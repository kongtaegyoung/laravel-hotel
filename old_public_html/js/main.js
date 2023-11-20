$(document).ready(function () {
    var mbsw = new Swiper(".mbsw", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
          el: ".mbpagi",
          clickable: true,
        },
        autoplay:true,
        speed:1000,
    });
    var couponsw = new Swiper(".couponsw", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
          el: ".coupagi",
          clickable: true,
        },
        autoplay:true,
        speed:1000,
    });


    $('.prod-btn li').click(function(){
        $('.prod-btn li').removeClass('on');
        $(this).addClass('on');
    })

});