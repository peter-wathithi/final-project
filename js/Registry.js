// Wait for the DOM to be ready
$(function() {
    $("form[name='registration']").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
function submitFunction() {
    var first = document.getElementById("first").value;
    var last = document.getElementById("last").value;
    var email = document.getElementById("email").value;
    var driver = document.getElementById("uid").value;
    var password = document.getElementById("password").value;

// Returns successful data submission message when the entered information is stored in database.
    var dataString = 'first='+ first +'last=' + last + '&email1=' + email + '$id='+ uid  +'&password1=' + password ;
    if (first == '' || last == '' || email == '' || driver == '' || password == '' ) {
        alert("Please Fill All Fields");
    } else {
// AJAX code to submit form.
        $.ajax({
            type: "POST",
            url: "server.php",
             data: dataString,
            async: false,
            success: function(html) {
                alert(html);
            }
        });
    }
    // return false;
