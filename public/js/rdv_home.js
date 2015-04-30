/**
 * Manage JS for the application
 */
var RdvHome = {

    run: function () {

        // init select2
        $(".multiselect-interests-home").select2();

        // validate form signup
        RdvHome.validateFormSignup();
    },

    validateFormSignup: function () {


        $('#formSignupUser').formValidation({
            // I am validating Bootstrap form
            framework: 'bootstrap',
            // Feedback icons
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },

            // List of fields and their validation rules
            fields: {
                firstname: {
                    validators: {
                        notEmpty: {
                            message: 'The firstname is required and cannot be empty'
                        },
                        stringLength: {
                            min: 3,
                            message: 'The username must be more than 3 characters long'
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
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and cannot be empty'
                        },
                        emailAddress: {
                            message: 'This is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be more than 6 characters long'
                        }
                    }
                }
            }
        });

    }


}


$(document).ready(function() {
    RdvHome.run();
});