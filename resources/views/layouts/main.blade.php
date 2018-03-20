<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
@yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $( document ).ready(function() {

            getJsonData();

            function getJsonData(){
                $.ajax({
                    url: "/get_json",
                    type: 'GET',
                    success: function (data){
                        makeTable(data);
                    }
                });
            }

            function makeTable(data){
                $('#dataTable').html("");
                for ( i = 0; i < data.products.length; i++){
                    var row = "<tr><td>" + data.products[i].product_name + "</td><td>" + data.products[i].quantity + "</td><td>" + data.products[i].price + "</td><td>" + data.products[i].dateTime + "</td><td>" + data.products[i].total + "</td></tr>";
                    $('#dataTable').append(row);
                }
                $('#dataTable').append("<tr><td colspan='4'></td><td>" + data.sum + "</td>");
            }

            $('#submit').on('click', function () {
                $('#errors').html('');
                var productName = $('#product_name').val();
                var quantity = $('#quantity').val();
                var price = $('#price').val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/store_product",
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, product_name: productName , quantity: quantity , price: price},
                    success: function (data) {
                        getJsonData();
                    },
                    error: function(data){
                        data = data.responseJSON;
                        for(var error in data.errors){
                            $('#errors').append(data.errors[error] + '<br>');
                        }
                        $('#errors').show();
                    }
                });
            });
        });
    </script>
</body>
</html>