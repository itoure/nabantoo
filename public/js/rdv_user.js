/**
 * Manage JS for the User Controller
 */
var RdvUser = {

    run: function () {

        // validate form
        RdvUser.validateFormEditUser();

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