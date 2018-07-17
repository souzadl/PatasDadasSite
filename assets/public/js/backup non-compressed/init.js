
$(document).ready(function() {






// ------ ELEVATE ZOOM ------ //

  $("#zoom").elevateZoom({
    gallery:'gal1',
    cursor: 'default',
    lenszoom: false,
    galleryActiveClass: 'active'
  }); 
  
  $("#zoom").bind("click", function(e) { 
    var ez = $('#zoom').data('elevateZoom');  
    $.fancybox(ez.getGalleryList()); 
    return false;
   }); 






    document.querySelector( "#nav-toggle" ).addEventListener( "click", function() {
      this.classList.toggle( "active" );
    });    




    //  -------- MENU CLICKs -------- //

        $(".setor1-click").click(function() {
            $('html, body').animate({
                scrollTop: $("#adotaveis").offset().top
            }, 1000);
        });


        
        $(".setor2-click").click(function() {
            $('html, body').animate({
                scrollTop: $("#setor2").offset().top
            }, 1000);
        });
        $(".setor3-click").click(function() {
            $('html, body').animate({
                scrollTop: $("#setor3").offset().top
            }, 1000);
        });
        $(".setor4-click").click(function() {
            $('html, body').animate({
                scrollTop: $("#setor4").offset().top
            }, 1000);
        });
        $(".setor5-click").click(function() {
            $('html, body').animate({
                scrollTop: $("#setor5").offset().top
            }, 1000);
        });





    //  -------- HEADER MENU MOBILE -------- //

        $(".abrir").click(function(){
          var displayMenu = $("#menu").css('display');
          if(displayMenu == "none"){
            $("#menu").animate({
               opacity: "toggle"
            }, { duration: "fast" });
          }else{
            if($(".menu_phone").css("display") == "block"){
              $("#menu").animate({
                 opacity: "toggle"
              }, { duration: "fast" });
            }
          }
        });

        $('.abrir').click(function(){
            if($('.menu_phone').hasClass("on-swift")){
              $('.menu_phone').removeClass('on-swift');
              $('.menu_phone').addClass('off-swift');
           }else if($('.menu_phone').hasClass("off-swift")){
              $('.menu_phone').removeClass('off-swift');
              $('.menu_phone').addClass('on-swift');
            }
          });

        $('.abrir').click(function(){
            if($('.facebook').hasClass("roxo-facebook")){
              $('.facebook').removeClass('roxo-facebook');
              $('.facebook').addClass('white-facebook');
           }else if($('.facebook').hasClass("white-facebook")){
              $('.facebook').removeClass('white-facebook');
              $('.facebook').addClass('roxo-facebook');
            }
          });



        $('.fechar-animation').click(function(){
            if($('#nav-toggle').hasClass("active")){
              $('#nav-toggle').removeClass('active');
              $('#nav-toggle').addClass('test2');
           }else if($('#nav-toggle').hasClass("test2")){
              $('#nav-toggle').removeClass('test2');
              $('#nav-toggle').addClass('active');
            }
          });







    //  -------- MODAL -------- //




        $(".click_contato").click(function() {

            var displayMenu = $("#area_contato").css('display');

            if (displayMenu == "none")
            {
                $("#area_contato").animate({
                    height: "show", opacity: "toggle"
                }, {duration: "fast"});
            }
            else
            {
                $("#area_contato").animate({
                    height: "hide", opacity: "toggle"
                }, {duration: "fast"});
            }
        });

		
		
		

});

function MostraResposta (id)
{
	if($('#faq-'+id).hasClass('on'))
	{
		$('#faq-'+id).removeClass('on').addClass('off');
	}
	else
	{
		$('div#faqs').find('ul').removeClass('on').addClass('off').promise().done(function() {
			$('#faq-'+id).addClass('on');
		});
	}
}