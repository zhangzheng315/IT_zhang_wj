// JavaScript Document
function dockEvent() {
    $(".dock").height($(".dock ul.icons li").length * 50 + $(".dock a.switch").height() + 20).css("top", ($(window).height() - $(".dock").height()) / 2 + 20);
    $(".dock ul.icons li i").bind("mouseover click touchstart",
    function() {
        $(".dock ul.icons li").removeClass("active");
        $(this).parent().addClass("active")
    });
    $(".dock ul.icons li").bind("mouseleave",
    function() {
        $(".dock ul.icons li").removeClass("active")
    });
    $(".dock a.switch").bind("click",
    function() {
        if ($(this).hasClass("off")) {
            $(".dock").removeClass("close");
            $(this).removeClass("off")
        } else {
            $(".dock ul.icons li").removeClass("active");
            $(".dock").addClass("close");
            $(this).addClass("off")
        }
    })
}
$(function (){
	$('.dock .up').click(function(){
        $('html,body').animate({scrollTop: '0px'}, 500);});
	$('.dock .down').click(function(){$('html,body').animate({scrollTop: $(document).height()+'px'}, 500);});
	dockEvent();
})