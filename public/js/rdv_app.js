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
        var $container = $('#isotope');
        $container.isotope({
            // options
            itemSelector: '.thumbnail',
            layoutMode: 'fitRows'
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
            //$('div#loading').modal('toggle');
            //$(this).prev('img#spinner').show();
            //console.log($(this).first());
            RdvApp.joinUserToEvent($(this));
        });

        $(".select-interests").select2();
        $(".multiselect-interests-user").select2();

    },


    joinUserToEvent: function (object) {

        var url = "/rendezvous/join-user-to-event";
        var event_id = object.attr('data-event-id');

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                //$('div#loading').modal('toggle');
                if(data.response){

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
                var url = "/rendezvous/fetch-tab-content-interesting";
                break;
            case '#upcomming':
                var url = "/rendezvous/fetch-tab-content-upcomming";
                break;
            case '#friends':
                var url = "/rendezvous/fetch-tab-content-friends";
                break;
            default:
                tab = '#interesting';
                var url = "/rendezvous/fetch-tab-content-interesting";
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