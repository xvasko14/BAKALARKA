@extends('layouts.mainLayout.manager_layout')

@section('content')
    <!-- banner -->
    <div class="banner">
            <script type="text/javascript" src="{{ URL::asset('js/main_js/responsiveslides.min.js')}}"></script>
            <script>
                jQuery.noConflict();
                jQuery(function ($) {
                    $("#slider").responsiveSlides({
                        auto: true,
                        speed: 300,
                        manualControls: '#slider3-pager',
                    });
                });
            </script>
        <div class="container-fluid">
            <div class="row">


        <div class="col-md-10 col-md-offset-1">
        @if(session()->has('training'))
            <div class="alert alert-success center-block">
                {{ session()->get('training') }}
            </div>
        @endif
        @if(session()->has('zranenie'))
            <div class="alert alert-success center-block">
                {{ session()->get('zranenie') }}
            </div>
        @endif
        @if(session()->has('pokuta'))
            <div class="alert alert-success center-block">
                {{ session()->get('pokuta') }}
            </div>
        @endif
            @if(session()->has('Financie'))
                <div class="alert alert-success center-block">
                    {{ session()->get('Financie') }}
                </div>
            @endif
        </div>
            </div>
        </div>

        <div class="slider">
            <div class="callbacks_container">
                <ul class="rslides" id="slider">
                    <li>
                        <img src="images/main_images/bnr3.jpg" alt="">
                        <div class="banner-info">
                            <h3>{{ __('message.welcomemanager') }}</h3>
                            <p>{{ __('message.welcomemanageruvod') }}</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr2.jpg" alt="">
                        <div class="banner-info">
                            <h3>{{ __('message.welcomemanager') }}</h3>
                            <p>{{ __('message.welcomemanageruvod') }}</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr1.jpg" alt="">
                        <div class="banner-info">
                            <h3>{{ __('message.welcomemanager') }}</h3>
                            <p>{{ __('message.welcomemanageruvod') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!---->
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
@endsection

{{--
<div class="container">
    @if(session()->has('training'))
        <div class="alert alert-success">
            {{ session()->get('training') }}
        </div>
    @endif
        @if(session()->has('zranenie'))
            <div class="alert alert-success">
                {{ session()->get('zranenie') }}
            </div>
        @endif
        @if(session()->has('pokuta'))
            <div class="alert alert-success">
                {{ session()->get('pokuta') }}
            </div>
        @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manager Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Manager!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

--}}
