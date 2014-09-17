(function($) {
    $(document).ready(function() {
        $("#searchToggle").click(function() {
            $(this).toggleClass("close_image");
            $("#searchbar").toggleClass("appear");
            $(".searchInput").focus();
            $(".full-overlay").fadeToggle();
        });
        $(".full-overlay").click(function() { 
            $("#searchToggle").click();
        });
    });
})(jQuery);