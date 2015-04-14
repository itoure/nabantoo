/**
 * Manage JS for the application
 */
var RdvHome = {

    run: function () {

        // manage background slideshow
        RdvHome.backgroundSlideshow();

        // init select2
        $(".multiselect-interests-home").select2();

    },

    backgroundSlideshow: function () {

        var images = ["/img/climb.jpg", "/img/runners.jpg", "/img/girls_shopping.jpg"];
        var index = -1;
        window.setInterval(function () {
            index = (index + 1 < images.length) ? index + 1 : 0;
            $('body').css("background-image", "url('" + images[index] + "')");
        }, 10000);

    }


}


$(document).ready(function() {
    RdvHome.run();
});