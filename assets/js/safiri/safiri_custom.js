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
        // var api_url = "http://localhost/safiri/rest/";
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
        $.notify('Passwords do not match', {
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
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "safiriOauth";
    var source = "/web";


    $.ajax({
        type        :   'POST',
        url         :   api_url + callback + source,
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
                        $.notify('You can only login via the Android App', {
                            type: 'info'
                        });
                    }

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Login Failed, incorrect username/password combination', {
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
    event.preventDefault();
});

function load_car_make() {
    var selectList = $('#car_make_list');
    selectList.append("<option value=''>Select Car Make</option>");
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
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

                        selectList.append("<option value='"+value.make_id+"'>"+value.make+"</option>");
                       

                        // console.log(make);
                        console.log(value.make)
                    });

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Could not retrieve a list of available Car Makes', {
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
    // var api_url = "http://localhost/safiri/rest/";
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
                        var selectList = $('#car_body_type_list');
                        selectList.append("<option value='"+value.type_code+"'>"+value.type+"</option>");

                    });

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Could not retrieve a list of available body types', {
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

function load_car_location_list() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getLocations";
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
                        var selectList = $('#car_location_list');
                        selectList.append("<option value='"+value.location_code+"'>"+value.location_name+"</option>");

                    });

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Could not retrieve a list of available locations', {
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

$('#car_location_list').change(function()
{
    // alert('Value change to ' + $(this).val());
    load_car_pickup_point_list($(this).val())
});

function load_car_pickup_point_list(location_code) {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getPickUpPoints";
    var source = "/web/";

    var formData = {
        'location_code': location_code
    };

    $.ajax({
        type        :   'POST',
        url         :   api_url+callback+source,
        data         :  formData,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            var selectList = $('#car_pickup_point_list');
            selectList.empty().append("<option value=''>Select Pick Up Point</option>");

            $(data).each(function(key,value){

                if(value.response === true){

                    $.each(data.data, function(key, value) {

                        var selectList = $('#car_pickup_point_list');
                        selectList.append("<option value='"+value.pick_up_point_id+"'>"+value.pick_up_point+"</option>");

                    });

                }else{

                    // $.notify("Registration Failed, incorrect username/password combination", "danger");
                    $.notify('Could not retrieve a list of available pick up points', {
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

$('#addCarWebForm').submit(function(event) {

    // get the form data
   
    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "addCar";
    var source = "/web/";


    var formData = new FormData($(this)[0]);

    
          formData.append = {
        'make': $('select[name=make]').val(),
        'model': $('input[name=model]').val(),
        'body_type': $('select[name=body_type]').val(),
        'pick_up_point': $('select[name=pick_up_point]').val(),
        'hire_price_per_day': $('input[name=hire_price_per_day]').val()
    };

    console.log(formData);
    // formData.append('#log_book_file', $('#')[0].files[0]);


    // process the form
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : api_url+callback+source, // the url where we want to POST
        data        : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        contentType : false,
        enctype     : 'multipart/form-data',
        processData : false

    })
        .done(function(data) {

            $('#addCarWebForm')[0].reset();
            $(data.data).each(function(key,value){

                if(value.response === true){

                    $.notify('Your car has been added successfully', {
                        type: 'success'
                    });

                }else{

                    $.notify('The upload failed. Kindly try again, otherwise check your internet connection', {
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
    event.preventDefault();
});


$('#uploadCarPhotosWebForm').submit(function(event) {

    // get the form data

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "uploadCarPhotos";
    var source = "/web/";


    var formData = new FormData($(this)[0]);

    formData.append = {
        'car_id_from_list': $('input[name=car_id_from_list]').val()
    };

    // process the form
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : api_url+callback+source, // the url where we want to POST
        data        : formData, // our data object
        dataType    : 'json', // what type of data do we expect back from the server
        contentType : false,
        enctype     : 'multipart/form-data',
        processData : false

    })
        .done(function(data) {

            $('#uploadCarPhotosWebForm')[0].reset();
            $(data.data).each(function(key,value){

                if(value.response === true){

                    $.notify('Photos uploaded successfully', {
                        type: 'success'
                    });

                }else{

                    $.notify('The upload failed. Kindly try again, otherwise check your internet connection', {
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
    event.preventDefault();
});

function load_owner_cars_list() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getMyCars";
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
                        
                        var selectList = $('#owner_cars_list_select');
                        selectList.append("<option value='"+value.car_id+"'>"+value.car_number_plate+" - "+value.make+"</option>");

                    });

                }else{

                    $.notify("You have not uploaded any cars yet", {
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

function populate_owners_car_datatable() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getMyCars";
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

                    $('#ownersCarsDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "car_number_plate"
                        }, {
                            data : "make"
                        }, {
                            data : "model"
                        }, {
                            data : "body_type"
                        }, {
                            data : "pick_up_point"
                        }, {
                            data : "hire_price_per_day"
                        }, {
                            data : "hire_status"
                        }]
                    });

                }else{

                    $.notify("You have not uploaded any cars yet", {
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



