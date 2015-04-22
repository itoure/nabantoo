/**
 * Manage JS for the application
 */
var RdvApp = {

    run: function () {

        // date rendezvous
        $("#start_date").datetimepicker({
            format: 'yyyy-mm-dd HH:ii',
            autoclose: true
        });

        // isotope


        // initialize Isotope
        var $container = $('#events-container').isotope({
            // options
            itemSelector: '.event-item'
        });

        // layout Isotope again after all images have loaded
        $container.imagesLoaded( function() {
            $container.isotope('packery');
        });


        $('#filters').on( 'click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({ filter: filterValue });
        });

        // manage tabs
        $(".home-tabs a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
            RdvApp.getTabContent($(this));
        });

        // join event
        $("a.join-event").click(function (e) {
            e.preventDefault();
            RdvApp.joinUserToEvent($(this));
        });

        // init select2
        $(".select-interests").select2();
        $(".multiselect-interests-user").select2();

        // tooltips
        $('[data-toggle="tooltip"]').tooltip();

    },


    joinUserToEvent: function (object) {

        var url = "/event/join-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('.event_id_'+event_id);
        var panel = elm.find('.panel');

        elm.find('#loading').show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                elm.find('#loading').hide();
                if(data.response){
                    elm.removeClass('interesting');
                    elm.addClass('upcoming');
                    panel.removeClass('panel-info');
                    panel.addClass('panel-primary');
                    elm.find('.actions-interesting').replaceWith("<i class='fa fa-check-square-o fa-2x text-success actions-upcoming'></i>");


                } else {

                }
            },
            error:function(data){

            }
        });
    },

    getTabContent: function (object) {

        var tab = object.attr('href');

        switch (tab) {
            case '#interesting':
                var url = "/event/fetch-tab-content-interesting";
                break;
            case '#upcomming':
                var url = "/event/fetch-tab-content-upcomming";
                break;
            case '#friends':
                var url = "/event/fetch-tab-content-friends";
                break;
            default:
                tab = '#interesting';
                var url = "/event/fetch-tab-content-interesting";
                break;
        }


        $.ajax(url,{
            data: {},
            context : object,
            success:function(data){
                if(data.response){
                    $(tab).html(data.data.html);
                    Holder.run();
                } else {

                }
            },
            error:function(data){

            }
        });

    }

}


$(document).ready(function() {
    RdvApp.run();
});