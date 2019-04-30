<!DOCTYPE html>
<html lang="en">
    <head>

    @include('layouts.mainLayout.partials.main_head')
    </head>
<body>


@include('layouts.mainLayout.partials.main_navbar')

<div class="strip">
    <div class="container">
        <div class="search">
            <form>
                <input type="text" value="" placeholder="Search...">
                <input type="submit" value="">
            </form>
        </div>

        <div class="social">
            <a href="https://www.facebook.com/groups/189044132827/" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-instagram"></a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@yield('content')


<!--end-main-container-part-->

@include('layouts.mainLayout.partials.main_footer')

<script type="text/javascript"  src="{{ URL::asset('js/main_js/jquery.min.js') }}"></script>

<script type="text/javascript"  src="{{URL::asset('js/main_js/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/main_js/responsiveslides.min.js')}}"></script>





</body>
</html>