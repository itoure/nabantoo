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
        var $container = $('#pastMomentsBlock').isotope({
            // options
            itemSelector: '.past-moment'
        });

        // layout Isotope again after all images have loaded
        $container.imagesLoaded( function() {
            $container.isotope('masonry');
        });

        /*
        $('#filters').on( 'click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({ filter: filterValue });
        });*/


        // join event
        $("#eventListHome").on( "click", 'a.join-event', function(e) {
            e.preventDefault();
            RdvApp.joinUserToEvent($(this));
        });
        $("#action-event-detail").on( "click", 'a.join-event-detail', function(e) {
            e.preventDefault();
            RdvApp.joinUserToEventDetail($(this));
        });

        // join decline
        $("#eventListHome").on( "click", 'a.decline-event', function(e) {
            e.preventDefault();
            RdvApp.declineUserToEvent($(this));
        });
        $("#action-event-detail").on( "click", 'a.decline-event-detail', function(e) {
            e.preventDefault();
            RdvApp.declineUserToEventDetail($(this));
        });


        $(".moments-filter").on( "click", function(e) {
            e.preventDefault();

            $(".moments-filter").removeClass('btn-info');
            $(".moments-filter").addClass('btn-default');

            $(this).addClass('btn-info');

            RdvApp.fetchEventListHome($(this));
        });

        // cancel moment
        $("#eventListHome").on( "click", 'a.cancel-join-event', function(e) {
            e.preventDefault();
            RdvApp.cancelJoinUserToEvent($(this));
        });
        $("#action-event-detail").on( "click", 'a.cancel-join-event-detail', function(e) {
            e.preventDefault();
            RdvApp.cancelJoinUserToEventDetail($(this));
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

        if ( $('#eventParticipants').length ){
            RdvApp.fetchEventParticipantsList();
        }

        // load block myNextEvents
        if ( $('#myUpcomingMoments').length ){
            RdvApp.fetchMyNextEvents();
        }

        if ( $('#mySuggestedMoments').length ){
            RdvApp.fetchMySuggestedMoments();
        }


        // validate form
        RdvApp.validateFormEvent();

        if ( $('#eventListHome').length ){
            RdvApp.fetchEventListHome();
        }

    },


    fetchEventListHome: function(object) {

        $('#eventListHome-loading').show();
        $('#eventListHome').html('');

        var block = $("#eventListHome");
        var url = "/event/fetch-event-list-home";

        if(object){
            var filter = object.attr('data-filter');
        }
        else{
            var filter = 'all';
        }


        $.ajax(url,{
            data: {
                filter: filter
            },
            success:function(data){
                if(data.response){

                    $('#eventListHome-loading').hide();
                    block.html(data.data.html);
                    Holder.run();

                } else {

                }
            },
            error:function(data){

            }
        });

    },


    fetchMyNextEvents: function() {

        $('#myUpcomingMoments-loading').show();
        $('#myUpcomingMoments').html('');

        var block = $("#myUpcomingMoments");
        var url = "/event/fetch-my-next-events";

        $.ajax(url,{
            data: {},
            success:function(data){
                if(data.response){

                $('#myUpcomingMoments-loading').hide();
                    block.html(data.data.html);
                    Holder.run();

                } else {

                }
            },
            error:function(data){

            }
        });

    },


    fetchMySuggestedMoments: function() {

        $('#mySuggestedMoments-loading').show();
        $('#mySuggestedMoments').html('');

        var block = $("#mySuggestedMoments");
        var url = "/event/fetch-my-suggested-moments";

        $.ajax(url,{
            data: {},
            success:function(data){
                if(data.response){

                    $('#mySuggestedMoments-loading').hide();
                    block.html(data.data.html);
                    Holder.run();

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
                },
                people_limit_max: {
                    validators: {
                        numeric: {
                            message: 'The people limit must be a number'
                        }

                    }
                },
                budget: {
                    validators: {
                        numeric: {
                            message: 'The budget must be a number'
                        }

                    }
                },
                duration: {
                    validators: {
                        numeric: {
                            message: 'The duration must be a number'
                        }

                    }
                }
            }
        });
    },


    declineUserToEvent: function (object) {

        var url = "/event/decline-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('.event_id_'+event_id);
        var panel = elm.find('.panel');
        var loading = elm.find('.loading');

        loading.show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                loading.hide();
                if(data.response){

                    elm.slideUp('slow');

                } else {

                }
            },
            error:function(data){

            }
        });
    },


    declineUserToEventDetail: function (object) {

        var url = "/event/decline-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('#action-event-detail');
        var loading = elm.find('.loading');

        loading.show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                loading.hide();
                if(data.response){

                    elm.html('<i class="fa fa-thumbs-o-down text-danger"></i> declined - <a href="">cancel?</a>');

                } else {

                }
            },
            error:function(data){

            }
        });
    },


    joinUserToEvent: function (object) {

        var url = "/event/join-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('.event_id_'+event_id);
        var panel = elm.find('.panel');
        var loading = elm.find('.loading');

        loading.show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                loading.hide();
                if(data.response){

                    //elm.slideUp('slow');

                    /*var htmlAlert = '<div id="join-alert-'+event_id+'" class="alert alert-success" role="alert">Votre participation pour a bien été prise en compte.</div>';
                    $('#alerts').append(htmlAlert);

                    $("#join-alert-"+event_id).delay(4000).slideUp('slow', function(){
                        $("#join-alert-"+event_id).alert('close');
                    });*/

                    RdvApp.fetchEventListHome();
                    RdvApp.fetchMyNextEvents();


                } else {

                }
            },
            error:function(data){

            }
        });
    },

    joinUserToEventDetail: function (object) {

        var url = "/event/join-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('#action-event-detail');
        var loading = elm.find('.loading');

        loading.show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                loading.hide();
                if(data.response){

                    elm.html('<i class="fa fa-thumbs-o-up text-success"></i> going - <a class="cancel-join-event-detail" href="#" data-event-id="'+event_id+'">cancel?</a>');

                    RdvApp.fetchEventParticipantsList();
                    RdvApp.fetchCountParticipants(event_id);

                } else {

                }
            },
            error:function(data){

            }
        });
    },


    cancelJoinUserToEvent: function(object) {

        var url = "/event/cancel-join-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('.event_id_'+event_id);
        var panel = elm.find('.panel');

        var loading = elm.find('.loading');

        loading.show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                loading.hide();
                if(data.response){

                    RdvApp.fetchEventListHome();
                    RdvApp.fetchMyNextEvents();

                } else {

                }
            },
            error:function(data){

            }
        });

    },


    cancelJoinUserToEventDetail: function(object) {

        var url = "/event/cancel-join-user-to-event";
        var event_id = object.attr('data-event-id');
        var elm = $('#action-event-detail');
        var loading = elm.find('.loading');

        loading.show();

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            context : object,
            success:function(data){
                loading.hide();
                if(data.response){

                    var btnJoin = '<a role="button" href="#" class="btn btn-default btn-xs join-event-detail" data-event-id="'+event_id+'"><i class="fa fa-user-plus"></i> Join</a>';
                    var btnDecline = '<a role="button" href="#" class="btn btn-default btn-xs decline-event-detail" data-event-id="'+event_id+'"><i class="fa fa-user-times"></i> Decline</a>';
                    elm.html(btnJoin+' '+btnDecline);


                    RdvApp.fetchEventParticipantsList();
                    RdvApp.fetchCountParticipants();

                } else {

                }
            },
            error:function(data){

            }
        });

    },


    fetchEventParticipantsList: function () {

        $('#eventParticipants-loading').show();
        $('#eventParticipants').html('');

        var block = $("#eventParticipants");
        var event_id = block.attr('data-event-id');
        var url = "/event/fetch-event-participants";

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            success:function(data){
                if(data.response){

                    $('#eventParticipants-loading').hide();
                    block.html(data.data.html);
                    Holder.run();

                } else {

                }
            },
            error:function(data){

            }
        });

    },

    fetchCountParticipants: function () {

        var block = $("#event-count-participant");
        var event_id = block.attr('data-event-id');
        var url = "/event/fetch-event-count-participants";

        $.ajax(url,{
            data: {
                event_id: event_id
            },
            success:function(data){
                if(data.response){

                    block.html(data.data);

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