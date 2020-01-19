$(document).ready(function() {

    $('#toggle').click(function(e) {
        e.preventDefault();
        $("#toggle").css("transform", "rotate(180deg)");
        $(".box-inner, .info-box-footer").slideToggle(800);
    });
});