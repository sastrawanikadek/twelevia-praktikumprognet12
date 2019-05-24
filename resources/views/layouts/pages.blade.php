<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Title  -->
        <title>@yield('title')</title>

        <!-- Core Style CSS -->
        <link rel="stylesheet" href="{{ asset("css/template/core-style.css") }}">
        <!-- Font Awesome Icons -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- Custom CSS -->
        @yield('css')
    </head>

    <body>
        @if (isset($quantity) && isset($carts))
            @include('components.header', ['quantity' => $quantity])
            @include('components.cart', ['quantity' => $quantity, 'carts' => $carts])
        @else
            @include('components.header')
            @include('components.cart')
        @endif
        
        <main>
            @yield('content')
        </main>

        @include('components.footer')
        <!-- jQuery (Necessary for All JavaScript Plugins) -->
        <script src="{{ asset("bower_components/jquery/dist/jquery.min.js") }}"></script>
        <!-- Popper js -->
        <script src="{{ asset("js/template/popper.min.js") }}"></script>
        <!-- Bootstrap js -->
        <script src="{{ asset("bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
        <!-- Plugins js -->
        <script src="{{ asset("js/template/plugins.js") }}"></script>
        <!-- Classy Nav js -->
        <script src="{{ asset("js/template/classy-nav.min.js") }}"></script>
        <!-- Active js -->
        <script src="{{ asset("js/template/active.js") }}"></script>
        <!-- Custom Script -->
        <script>
            $('.cart-item-desc .price').each(function(index, element){
                const price = parseInt(element.innerText);

                element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
            });

            $('.summary-table .subtotal').each(function(index, element){
                const price = parseInt(element.innerText);

                element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
            });

            $('.summary-table .total').each(function(index, element){
                const price = parseInt(element.innerText);

                element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
            });
        </script>
        @yield('script')
    </body>
</html>