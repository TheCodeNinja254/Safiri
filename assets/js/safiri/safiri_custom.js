/**
 * Created by freddie on 9/26/17.
 */

// process the form
$('#addSupplierForm').submit(function(event) {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)
    var formData = {
        'username': $('input[name=supplier_username]').val(),
        'supplier_password_one': $('input[name=supplier_password_one]').val(),
        'supplier_password_two': $('input[name=supplier_password_two]').val(),
        'f_name': $('input[name=f_name]').val(),
        'l_name': $('input[name=l_name]').val(),
        'phone_number': $('input[name=phone_number]').val(),
        'email_address': $('input[name=email_address]').val()
    };

    var api_url = "https://api.safirirental.com/";
    var callback = "addSupplier";


    $.ajax({
        type        :   'POST',
        url         :   api_url+callback,
        data        :   formData,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $('#addSupplierForm')[0].reset();
            $(data).each(function(key,value){

                if(value.response === true){

                    window.newToast("success", "Login to continue", "Registration Successful!");

                }else{

                    window.newToast("error", "Registration Failed, try again in a litle while!", "Oops!");
                }

            });
        })

        .fail(function() {

            window.newToast("info", "How dare they lock you out of the WiFi?", "Oops!");


        });
    // stop the form from submitting the normal way and refreshing the page
    event.preventDefault();
});




