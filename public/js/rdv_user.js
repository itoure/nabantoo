/**
 * Manage JS for the User Controller
 */
var RdvUser = {

    run: function () {

        $(".manage-network").on( "click", function(e) {
            e.preventDefault();
            RdvUser.manageUserNetwork($(this));
        });

        // validate form
        RdvUser.validateFormEditUser();

    },

    manageUserNetwork: function(object) {

        $('#network-loading').show();
        var user_id = object.attr('data-user-id');
        var action = object.attr('data-action');
        var url = "/user/manage-network";
        //var elm = $('.event_id_'+event_id);

        $.ajax(url,{
            data: {
                user_id: user_id,
                action: action
            },
            success:function(data){
                $('#network-loading').hide();
                if(data.response){

                    if(action == 'add'){
                        object.removeClass('btn-primary');
                        object.addClass('btn-default');
                        object.attr('data-action', 'remove');

                        object.html('Remove network');
                    }
                    else{
                        object.removeClass('btn-default');
                        object.addClass('btn-primary');
                        object.attr('data-action', 'add');

                        object.html('Add network');
                    }


                } else {

                }
            },
            error:function(data){

            }
        });

    },

    validateFormEditUser: function () {

        $('#formEditUser').formValidation({
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
                usr_sexe: {
                    validators: {
                        notEmpty: {
                            message: 'The gender is required and cannot be empty'
                        }
                    }
                },
                usr_location: {
                    validators: {
                        notEmpty: {
                            message: 'The location is required and cannot be empty'
                        }
                    }
                },
                usr_firstname: {
                    validators: {
                        notEmpty: {
                            message: 'The firstname is required and cannot be empty'
                        }
                    }
                }
            }
        });
    }


}


$(document).ready(function() {
    RdvUser.run();
});