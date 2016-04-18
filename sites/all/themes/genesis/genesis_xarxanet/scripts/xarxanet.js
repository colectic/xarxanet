$(document).ready(function(){
    //MENU DESPLEGABLE
    $("ul.Menu li").mouseover(function() {
        $(this).find("a").addClass("Blanco");
        $("ul.Menu").addClass("Trans");
    });
    $("ul.Menu li").mouseout(function() {
        $(this).find("a").removeClass("Blanco");
        $("ul.Menu").removeClass("Trans");
    });
    $(".QueEs").hide();
    $("#QueEs").click(function () {$(".QueEs").fadeIn(800);});
    $(".close").click(function () {$(".QueEs").fadeOut(800);});

    $("#Footer ul li").fadeTo(1,0.70);
    $("#Footer ul li").hover(
        function() {$(this).fadeTo("fast",1);},
        function() {$(this).fadeTo("fast",0.70);}
    );

    $('#search-form').submit(function(){
        window.location = $(this).attr('action') + escape($('#search-text').val());
        return false;
    });
});