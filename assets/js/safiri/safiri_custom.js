/**
 * Created by freddie on 9/26/17.
 */

// process the form
$('#addSupplierForm').submit(function(event) {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var supplier_password_one = $('input[name=supplier_password_one]').val();
    var supplier_password_two = $('input[name=supplier_password_two]').val();

    if (supplier_password_one == supplier_password_two) {
        var formData = {
            'username': $('input[name=supplier_username]').val(),
            'password': supplier_password_one,
            'f_name': $('input[name=f_name]').val(),
            'l_name': $('input[name=l_name]').val(),
            'phone_number': $('input[name=phone_number]').val(),
            'email_address': $('input[name=email_address]').val()
        };

        var api_url = "https://api.safirirental.com/";
        var callback = "addSupplier";
        var source = "/web";


        $.ajax({
            type: 'POST',
            url: api_url + callback + source,
            data: formData,
            dataType: 'json',
            encode: true
        })
            .done(function (data) {

                $('#addSupplierForm')[0].reset();
                $(data).each(function (key, value) {

                    if (value.response = true) {

                        $.notify('Registration successful', {
                            type: 'success'
                        });
                    } else {

                        $.notify('Registration Failed', {
                            type: 'danger'
                        });
                    }

                });
            })

            .fail(function () {

                $.notify('You are offline', {
                    type: 'warning'
                });

            });
    } else {
        a$.notify('Passwords do not match', {
            type: 'warning'
        });
    }
    // stop the form from submitting the normal way and refreshing the page
    event.preventDefault();
});


$('#loginForm').submit(function(event) {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)
    var formData = {
        'username': $('input[name=lg_username]').val(),
        'password': $('input[name=lg_password]').val()
    };

    var api_url = "https://api.safirirental.com/";
    var callback = "safiriOauth";
    var source = "/web";


    $.ajax({
        type        :   'POST',
        url         :   api_url+callback+source,
        data        :   formData,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $('#loginForm')[0].reset();
            $(data).each(function(key,value){

                if(value.response === true){

                    $.notify('Login Successful, redirecting...', {
                        type: 'success'
                    });
                    if(data.data.user_type === 'supplier'){
                        $(location).attr('href', 'https://safirirental.com/customer/dashboard/')
                    }else if(data.data.user_type === 'admin'){
                        $(location).attr('href', 'https://safirirental.com/admin/dashboard/')
                    }else{
                        $.notify('You can login ', {
                            type: 'info'
                        });
                    }

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Registration Failed, incorrect username/password combination', {
                        type: 'warning'
                    });

                }

            });
        })

        .fail(function() {

            $.notify('You are offline', {
                type: 'warning'
            });

        });
    // stop the form from submitting the normal way and refreshing the page
});

function load_car_make() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    var callback = "getCarMake";
    var source = "/web/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $.each(data.data, function(key, value) {
                        $('#car_make_list').append("<option value='sdsd'>Some</option>");
                        // console.log(make);
                        console.log(value.make)
                    });

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Registration Failed, incorrect username/password combination', {
                        type: 'warning'
                    });

                }

            });
        })

        .fail(function() {

            $.notify('You are offline', {
                type: 'warning'
            });

        });
}


function load_body_types() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    var callback = "getBodyTypes";
    var source = "/web/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $.each(data.data, function(key, value) {
                        $('#car_body_type_list')
                            .append($("<option></option>")
                                .attr("value",data.type_code)
                                .text(data.type));
                    });

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Registration Failed, incorrect username/password combination', {
                        type: 'warning'
                    });

                }

            });
        })

        .fail(function() {

            $.notify('You are offline', {
                type: 'warning'
            });

        });
}




