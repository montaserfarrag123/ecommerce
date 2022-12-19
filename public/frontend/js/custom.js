$(document).ready(function () {

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    loadcart();
    loadwishliat();
    function loadcart() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "get",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
                // alert(response.count)
            }
        });
    }
    function loadwishliat() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "get",
            url: "/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
                // alert(response.count)
            }
        });
    }
    $('.addToCartBtn').click(function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();



        $.ajax({
            method: "post",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                swal(response.status);
                loadcart();
            }
        });
    });
    $('.addToWishlist').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "post",
            url: "/add-to-wishlist",
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                swal(response.status);
                loadwishliat();
            }
        });
    });

    $('.increment-btn').click(function (e) {
        e.preventDefault();

        //var inc_value =$('.qty-input').val();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++
            // $('.qty-input').val(value)
            var inc_value = $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $('.decrement-btn').click(function (e) {
        e.preventDefault();
        // var dec_value =$('.qty-input').val();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--
            // $('.qty-input').val(value)
            var dec_value = $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    $('.changeQuantity').click(function (e) {
        e.preventDefault();
        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'prod_id': prod_id,
            'prod_qty': qty,
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "post",
            url: "cart-update",
            data: data,

            success: function (response) {
                window.location.reload();
                swal(response.status);
            }
        });
    });

    $('.remove-wishlist-item').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "post",
            url: "/remove-wishlist-item",
            data: {
                'prod_id': product_id,

            },
            success: function (response) {
                swal(response.status);
                loadwishliat();
            }
        });
    });

    $('.razorpay_btn').click(function (e) {
        e.preventDefault();

        var firstName = $('.firstName').val();
        var lastName = $('.lastName').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address1 = $('.address1').val();
        var address2 = $('.address2').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var pincode = $('.pincode').val();

        if (!firstName) {
            fname_error = "First Name Is Required";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        } else {
            fname_error = '';
            $('#fname_error').html('');
        }
        if (!lastName) {
            lastName_error = "last Name Is Required";
            $('#lastName_error').html('');
            $('#lastName_error').html(lastName_error);
        } else {
            lastName_error = '';
            $('#lastName_error').html('');
        }
        if (!email) {
            email_error = "email Is Required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        } else {
            email_error = '';
            $('#email_error').html('');
        }
        if (!phone) {
            phone_error = "phone Is Required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        } else {
            phone_error = '';
            $('#phone_error').html('');
        }
        if (!address1) {
            address1_error = "address1 Is Required";
            $('#address1_error').html('');
            $('#address1_error').html(address1_error);
        } else {
            address1_error = '';
            $('#address1_error').html('');
        }
        if (!address2) {
            address2_error = "address2 Is Required";
            $('#address2_error').html('');
            $('#address2_error').html(address2_error);
        } else {
            address2_error = '';
            $('#address2_error').html('');
        }
        if (!city) {
            city_error = "city Is Required";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        } else {
            city_error = '';
            $('#city_error').html('');
        }
        if (!state) {
            state_error = "state Is Required";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        } else {
            state_error = '';
            $('#state_error').html('');
        }
        if (!country) {
            country_error = "country Is Required";
            $('#country_error').html('');
            $('#country_error').html(country_error);
        } else {
            country_error = '';
            $('#country_error').html('');
        }
        if (!pincode) {
            pincode_error = "pincode Is Required";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        } else {
            pincode_error = '';
            $('#pincode_error').html('');
        }
        if (fname_error != '' || lastName_error != '' || email_error != '' || phone_error != '' || address1_error != '' || address2_error != '' || city_error != '' || state_error != '' || country_error != '' || pincode_error != '') {
            return false;
        } else {

            var data =
            {
                'firstName': firstName,
                'lastName': lastName,
                'email': email,
                'phone': phone,
                'address1': address1,
                'address2': address2,
                'city': city,
                'state': state,
                'country': country,
                'pincode': pincode,
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/proceed-to-pay",
                data: data,
                success: function (response) {

                    var options = {
                        "key": "rzp_test_RwL9ZHUEev3zxq", // Enter the Key ID generated from the Dashboard
                        "amount": 1*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": response.firstName+' '+response.lastName,
                        "description": "Thank You For Choses Use",
                        "image": "https://example.com/your_logo",
                        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responsea){
                          //  alert(responsea.razorpay_payment_id);
                            $.ajax({
                                method: "POST",
                                url: "/place-order",
                                data: {
                                    'fname': response.firstName,
                                    'lname': response.lastName,
                                    'email': response.email,
                                    'phone': response.phone,
                                    'address1': response.address1,
                                    'address2': response.address2,
                                    'city': response.city,
                                    'state': response.state,
                                    'country': response.country,
                                    'pincode': response.pincode,
                                    'payment_mode': "Paid by Razorpay",
                                    'payment_id': responsea.razorpay_payment_id,
                                },
                                dataType: "dataType",
                                success: function (responseb) {
                                   // alert(responseb.status);
                                   swal(responseb.status);
                                   window.location.href='/my-order';
                                }
                            });

                        },
                        "prefill": {
                            "name": response.firstName+' '+response.lastName,
                            "email": response.email,
                            "contact": response.phone
                        },
                        // "notes": {
                        //     "address": "Razorpay Corporate Office"
                        // },

                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);


                        rzp1.open();


                }
            });
        }
    });
});
