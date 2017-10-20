/**
 * Created by freddie on 9/26/17.
 */
$( document ).ready(function() {
    var name = $.cookie("x-user");
    $("#x-user").html(name).toUpperCase()
});
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
        var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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

                    $.cookie("username", data.data.username, {
                        expires : 10,//days
                        path    : '/',
                        secure  : true
                    });

                    var USER_CSRF;

                    if(data.data.user_type === "admin"){
                         USER_CSRF = "21232f297a57a5a743894a0e4a801fc3";
                    }else{
                         USER_CSRF = "99b0e8da24e29e4ccb5d7d76e677c2ac";
                    }

                    $.cookie("USER_CSRF", USER_CSRF, {
                        expires : 10,//days
                        path    : '/',
                        secure  : true
                    });

                    $.cookie("current_session_key", data.data.current_session_key, {
                        expires : 10,//days
                        path    : '/',
                        secure  : true
                    });

                    $.cookie("x-user", data.data.f_name+" "+data.data.l_name, {
                        expires : 10,//days
                        path    : '/',
                        secure  : true
                    });

                    $.cookie("email_address", data.data.email_adddress, {
                        expires : 10,//days
                        path    : '/',
                        secure  : true
                    });

                    $.cookie("phone_num", data.data.phone_num, {
                        expires : 10,//days
                        path    : '/',
                        secure  : true
                    });

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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";

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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";
    var csk = $.cookie("current_session_key");
    var tail = "?username="+$.cookie("username");



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
        url         : api_url+callback+source+csk+tail, // the url where we want to POST
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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";
    var csk =  $.cookie("current_session_key");

    var formData = {
        'username' : $.cookie("username")
    };

    $.ajax({
        type        :   'POST',
        url         :   api_url+callback+source+csk,
        data        :   formData,
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
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";
    var csk =  $.cookie("current_session_key");

    var formData = {
        'username' : $.cookie("username")
    };


    $.ajax({
        type        :   'POST',
        url         :   api_url+callback+source+csk,
        dataType    :   'json',
        data        :   formData,
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
                            data : "type"
                        }, {
                            data : "pick_up_point"
                        }, {
                            data : "hire_price_per_day"
                        }, {
                            data : "status"
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

function populate_all_cars_datatable() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getAllCars";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $('#allCarsDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "f_name"
                        }, {
                            data : "car_number_plate"
                        }, {
                            data : "make"
                        }, {
                            data : "model"
                        }, {
                            data : "type"
                        }, {
                            data : "pick_up_point"
                        }, {
                            data : "hire_price_per_day"
                        }, {
                            data : "status"
                        }]
                    });

                }else{

                    $.notify("There are now cars uploaded yet", {
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

function populate_all_locations_datatable() {
    if ( $.fn.dataTable.isDataTable( '#allLocationsDataTable' ) ) {
        table = $('#allLocationsDataTable').DataTable();

        table.destroy();
    }
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getLocations";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $('#allLocationsDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "id"
                        }, {
                            data : "location_code"
                        }, {
                            data : "location_name"
                        }]
                    });

                }else{

                    $.notify("There are now locations added yet", {
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

$('#addLocationFormAdmin').submit(function(event) {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)
    var formData = {
        'location_name': $('input[name=location_name]').val()
    };

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "addLocation";
    var source = "/2567a5ec9705eb7ac2c984033e06189d";


    $.ajax({
        type        :   'POST',
        url         :   api_url + callback + source,
        data        :   formData,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $('#addLocatioFormAdmin')[0].reset();
            $(data.data).each(function(key,value){

                if(value.response === true){

                    $.notify('Location added successfully', {
                        type: 'success'
                    });
                    populate_all_locations_datatable();

                }else{

                    $.notify('There was an error adding the location, please try again later', {
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

function populate_all_pickup_datatable() {
    if ( $.fn.dataTable.isDataTable( '#allPickUpPointsDataTable' ) ) {
        table = $('#allPickUpPointsDataTable').DataTable();

        table.destroy();
    }


    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getAllPickUpPoints";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";



    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $('#allPickUpPointsDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "id"
                        }, {
                            data : "location_name"
                        }, {
                            data : "pick_up_point"
                        }, {
                            data : "pick_up_point_id"
                        }]
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

function load_admin_locations_list() {
    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getLocations";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


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
                        var selectList = $('#car_location_list_admin');
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

$('#addPickupPointsFormAdmin').submit(function(event) {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)
    var formData = {
        'location_code': $('select[name=location_code]').val(),
        'pick_up_point': $('input[name=pick_up_point]').val()
    };

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "addPickupPoint";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


    $.ajax({
        type        :   'POST',
        url         :   api_url + callback + source,
        data        :   formData,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $('#addPickupPointsFormAdmin')[0].reset();
            $(data.data).each(function(key,value){

                if(value.response === true){

                    $.notify('Location added successfully', {
                        type: 'success'
                    });
                    populate_all_pickup_datatable();

                }else{

                    $.notify('There was an error adding the location, please try again later', {
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

function load_car_make_datatable() {
    if ( $.fn.dataTable.isDataTable( '#makeDataTable' ) ) {
        table = $('#makeDataTable').DataTable();

        table.destroy();
    }

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getCarMake";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $('#makeDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "make_id"
                        }, {
                            data : "make"
                        }]
                    })

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

$('#addCarMakeForAdmin').submit(function(event) {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)
    var formData = {
        'make': $('input[name=make]').val()
    };

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "addCarMake";
    var source = "/2567a5ec9705eb7ac2c984033e06189d";


    $.ajax({
        type        :   'POST',
        url         :   api_url + callback + source,
        data        :   formData,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $('#addCarMakeForAdmin')[0].reset();
            $(data.data).each(function(key,value){

                if(value.response === true){

                    $.notify('Location added successfully', {
                        type: 'success'
                    });
                    load_car_make_datatable();

                }else{

                    $.notify('There was an error adding the location, please try again later', {
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



function populate_customers_datatable() {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getCustomers";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $('#usersDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "f_name"
                        }, {
                            data : "l_name"
                        }, {
                            data : "postal_address"
                        }, {
                            data : "email_adddress"
                        }, {
                            data : "username"
                        }, {
                            data : "national_id_num"
                        }, {
                            data : "phone_num"
                        }, {
                            data : "date_of_registration"
                        }]
                    });

                }else{

                    $.notify("There are no registered customers yet!", {
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

function populate_suppliers_datatable() {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "getSuppliers";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source,
        dataType    :   'json',
        encode      :   true
    })
        .done(function(data) {

            $(data).each(function(key,value){

                if(value.response === true){

                    $('#usersDataTable').DataTable({
                        "data" :data.data,
                        "processing" : true,
                        dom: 'ftipB',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ],columns : [ {
                            data : "f_name"
                        }, {
                            data : "l_name"
                        }, {
                            data : "postal_address"
                        }, {
                            data : "email_adddress"
                        }, {
                            data : "username"
                        }, {
                            data : "national_id_num"
                        }, {
                            data : "phone_num"
                        }, {
                            data : "date_of_registration"
                        }]
                    });

                }else{

                    $.notify("There are no registered suppliers yet!", {
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

function logout() {

    // get the form data
    // there are many ways to get this data using jQuery (you can use the class or id also)

    var api_url = "https://api.safirirental.com/";
    // var api_url = "http://localhost/safiri/rest/";
    var callback = "sfOAuthLogout";
    var source = "/2567a5ec9705eb7ac2c984033e06189d/";
    var csk = $.cookie("current_session_key");

    var formData = {
        username : $.cookie("username")
    };


    $.ajax({
        type        :   'GET',
        url         :   api_url+callback+source+csk,
        dataType    :   'json',
        data        :   formData,
        encode      :   true
    })
        .done(function(data) {

            $(data.data).each(function(key,value){

                if(value.response === true){

                    $.removeCookie('username', { path: '/' });
                    $.removeCookie('current_session_key', { path: '/' });
                    $.removeCookie('phone_num', { path: '/' });
                    $.removeCookie('email_address', { path: '/' });

                    $.notify("Session terminated successfully", {
                        type: 'success'
                    });
                    $(location).attr('href', 'https://safirirental.com/#session-terminated/')

                }else{

                    $.notify("Logout failed", {
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






