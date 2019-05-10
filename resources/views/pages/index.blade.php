@extends('layouts.mainLayout.main_layout')

@section('content')
    <!-- banner -->
    <div class="banner">
        <script type="text/javascript" src="{{ URL::asset('js/main_js/responsiveslides.min.js')}}"></script>
        <script>
            jQuery.noConflict();
            jQuery(function ($) {
                $("#slider").responsiveSlides({
                    auto: true,
                    speed: 400,
                    manualControls: '#slider3-pager',
                });
            });
        </script>

        <div class="slider">
            <div class="callbacks_container">
                <ul class="rslides" id="slider">
                    <li>
                        <img src="images/main_images/bnr3.jpg" alt="obrazok1">
                        <div class="banner-info">
                            <h3>{{ __('message.welcome') }}</h3>
                            <p>{{ __('message.welcome_uvod') }}</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr2.jpg" alt="obrazok2">
                        <div class="banner-info">
                            <h3>{{ __('message.welcome') }}</h3>
                            <p>{{ __('message.welcome_uvod') }}</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr1.jpg" alt="obrazok3">
                        <div class="banner-info">
                            <h3>{{ __('message.welcome') }}</h3>
                            <p>{{ __('message.welcome_uvod') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <!---->

        <!---start-content----->
        <div class="banner-bottom-grids">
            <div class="container">
                <div class="col-md-6 banner-text-info clr1">
                    <i class="icon1"></i>
                    <div class="bnr-text">
                        <h3>{{ __('message.system') }}</h3>
                        <p>{{ __('message.system_p') }}.</p>
                    </div>
                </div>
                <div class="col-md-6 banner-text-info clr2">
                    <i class="icon2"></i>
                    <div class="bnr-text">
                        <h3>{{ __('message.league_table') }}</h3>
                        <p>{{ __('message.league_table_p') }}.</p>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 banner-text-info clr3 btm">
                    <i class="icon3"></i>
                    <div class="bnr-text">
                        <h3>{{ __('message.training') }}</h3>
                        <p>{{ __('message.training_p') }}</p>
                    </div>
                </div>
                <div class="col-md-6 banner-text-info clr4 btm">
                    <i class="icon4"></i>
                    <div class="bnr-text">
                        <h3>{{ __('message.galeria') }}</h3>
                        <p>{{ __('message.galeria_p') }}.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //banner -->

    <!-- content -->

    <!--- //content--->
    <!-- content-bottom -->
    <div class="content-info">
        <div class="container">
            <div class="content-bottom-grids">
                <div class="col-md-4 popular">
                    <h3>{{ __('message.systempossibility') }}</h3>
                    <ul>
                        <li>{{ __('message.systempossibility1') }}</li>
                        <li>{{ __('message.systempossibility2') }}</li>
                        <li>{{ __('message.systempossibility3') }}</li>
                        <li>{{ __('message.systempossibility4') }}</li>
                        <li>{{ __('message.systempossibility5') }}</li>
                        <li>{{ __('message.systempossibility6') }}</li>
                    </ul>
                </div>
                <div class="col-md-4 welcome-pic">
                    <h3>{{ __('message.systempossibility7') }}</h3>
                    <h4>{{ __('message.systempossibility8') }}</h4>
                    <img src="images/main_images/cnt.ab.jpg" alt=""/>
                    <p>{{ __('message.systempossibility9') }}</p>
                </div>
                <div class="col-md-4 coach">
                    <h3>{{ __('message.systempossibility10') }}</h3>
                    <div class="coch-grid chr">
                        <div class="coach-pic">
                            <img src="images/main_images/kochantrener.jpeg" alt=""/>
                        </div>
                        <div class="coach-pic-info">
                            <h4><a href="#">Peter Kochan</a></h4>
                            <h5>{{ __('message.systempossibility11') }} </h5>
                            <p>{{ __('message.systempossibility12') }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- script-for-menu <div class="jumbotron text-center">
    <h1> Welcome to FutbalNet</h2>
    <p> Informacny system FutbalNetu </p>
    <p><a class="btn btn-primary btn-lg"  href="/login" role="button">Login</a> <a class="btn btn-success btn-lg"  href="/register" role="button">Register</a> </p>-->
@endsection
