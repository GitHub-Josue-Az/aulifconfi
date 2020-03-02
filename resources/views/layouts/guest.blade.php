<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Head --> 
    @include('partials.head')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        
        <!-- Header --> 
        @include('partials.header')
        
        <div class="app-main">
        
            <!-- Start Content -->

            <div class="app-main__inner">

                @yield('content')

            </div>

            <!-- End Content -->
    

        </div>

    </div>

</body>
</html>





