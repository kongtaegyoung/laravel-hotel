$(document).ready(function () {
    //메뉴 슬라이드 
    $('.gnb>li').mouseenter(function () { 
        $(this).find('.depth2').stop().slideDown();
    });
    $('.gnb>li').mouseleave(function () { 
        $(this).find('.depth2').stop().slideUp();
    });


    //햄버거메뉴 효과
    const mMenuIco = document.querySelector(".m_menu_ico");
  

    mMenuIco.addEventListener("click", () => {
      mMenuIco.classList.toggle("active");
      $("#gnbWrap").toggleClass("on");

      //모바일메뉴 활성화 때 스크롤 방지
      $('body').toggleClass('no-scroll');

      //모바일메뉴 활성화
      $('.mgnb_wrap').toggleClass('on');
      $('.mgnb').toggleClass('on');

    });




    
    
    


});