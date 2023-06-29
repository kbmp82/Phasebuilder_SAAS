var form_validation = function() {
    var e = function() {
            jQuery(".forgot_form").validate({
                ignore: [],
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(".p_error").append(e)
                },
                highlight: function(e) {
                    jQuery(".p_error").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(".p_error").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
"confirmpassword": {
                      equalTo: "#password",
                    }
                },
                messages: {
                   "confirmpassword": "Your password and confirm password doesn't match"
                }
            })
        }
    return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});