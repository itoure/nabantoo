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
        /*var $container = $('#events-container').isotope({
            // options
            itemSelector: '.event-item'
        });

        // layout Isotope again after all images have loaded
        $container.imagesLoaded( function() {
            $container.isotope('vetical');
        });*/


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
        //$('[data-toggle="tooltip"]').tooltip();


        // alerts
        $("#welcome-alert").delay(4000).slideUp('slow', function(){
            $("#welcome-alert").alert('close');
        });
        $("#welcomeback-alert").delay(4000).slideUp('slow', function(){
            $("#welcomeback-alert").alert('close');
        });

        // validate form
        RdvApp.validateFormEvent();

        // load block myNextEvents
        RdvApp.fetchMyNextEvents();

    },


    fetchMyNextEvents: function() {

        $('#myNextEvents-loading').show();
        $('#myNextEvents').html('');

        var block = $("#myNextEvents");
        var url = "/event/fetch-my-next-events";

        $.ajax(url,{
            data: {},
            success:function(data){
                if(data.response){

                $('#myNextEvents-loading').hide();
                    block.html(data.data.html);

                } else {

                }
            },
            error:function(data){

            }
        });

    },


    validateFormEvent: function () {

        $('#formCreateEvent').formValidation({
            // I am validating Bootstrap form
            framework: 'bootstrap',
            // Feedback icons
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            trigger: 'change',

            // List of fields and their validation rules
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The title is required and cannot be empty'
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: 'The location is required and cannot be empty'
                        }
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: 'The start date is required and cannot be empty'
                        }
                    }
                },
                interest: {
                    validators: {
                        notEmpty: {
                            message: 'The interest is required and cannot be empty'
                        }
                    }
                },
                details: {
                    validators: {
                        notEmpty: {
                            message: 'The details is required and cannot be empty'
                        }
                    }
                }
            }
        });
    },


    joinUserToEvent: function (object) {

        var url = "/event/join-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('.event_id_'+event_id);
        var panel = elm.find('.panel');

        elm.find('#join-loading').show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                elm.find('#join-loading').hide();
                if(data.response){

                    elm.slideUp('slow');

                    var htmlAlert = '<div id="join-alert-'+event_id+'" class="alert alert-success" role="alert">Votre participation pour a bien été prise en compte.</div>';
                    $('#alerts').append(htmlAlert);

                    $("#join-alert-"+event_id).delay(4000).slideUp('slow', function(){
                        $("#welcomeback-alert").alert('close');
                    });

                    RdvApp.fetchMyNextEvents();


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