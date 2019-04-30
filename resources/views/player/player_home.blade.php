@extends('layouts.mainLayout.player_layout')

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
                </div>
            </div>
        </div>

        <div class="slider">
            <div class="callbacks_container">
                <ul class="rslides" id="slider">
                    <li>
                        <img src="images/main_images/bnr3.jpg" alt="">
                        <div class="banner-info">
                            <h3>Vitaj Hráč </h3>
                            <p>Si prihlasený v systéme ako hráč. Mozeš sa zača činiť v klube. Veľa štastia !</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr2.jpg" alt="">
                        <div class="banner-info">
                            <h3>Vitaj Hráč </h3>
                            <p>Si prihlasený v systéme ako hráč. Mozeš sa zača činiť v klube. Veľa štastia !</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr1.jpg" alt="">
                        <div class="banner-info">
                            <h3>Vitaj Hráč </h3>
                            <p>Si prihlasený v systéme ako hráč. Mozeš sa zača činiť v klube. Veľa štastia !</p>
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
                        <h3>System</h3>
                        <p>Informačný system pre klub, vďaka ktorému mate organizáciu klubu na jednom mieste.</p>
                    </div>
                </div>
                <div class="col-md-6 banner-text-info clr2">
                    <i class="icon2"></i>
                    <div class="bnr-text">
                        <h3>Ligove tabulky</h3>
                        <p>Prezrite si tabuľky a zistite ako stoji váš obľubený tím. Takteiž nazrite aj do štatistík a zistite kto je najlepší kanonier či nahrávač.</p>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 banner-text-info clr3 btm">
                    <i class="icon3"></i>
                    <div class="bnr-text">
                        <h3>Trening</h3>
                        <p>Vytvárajte tréning, prezerajte účasť a hodnote výkóny. Alebo sa na nich prihlasujte a trenujte ako veľky profesionál.</p>
                    </div>
                </div>
                <div class="col-md-6 banner-text-info clr4 btm">
                    <i class="icon4"></i>
                    <div class="bnr-text">
                        <h3>Galeria</h3>
                        <p>Prezrite si galériu fotiek z naších zápasov. Nasajte tu atfosméru. Pri troché štastia sa najdete aj na fotke.</p>
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
                    <h3>Možnosti systému</h3>
                    <ul>
                        <li>Trenúj ako správny tréner.</a></li>
                        <li>Staň sa hráčom klubu a strielaj góly.</a></li>
                        <li>Vytváraj tréningy.</a></li>
                        <li>Zučastnuj sa tréningov a zlepšuj sa.</a></li>
                        <li>Pokutuj nezodpovedných hráčov.</a></li>
                        <li>Sleduj štatistiky a porovnávaj vykonostne posuvy.</a></li>
                        <li>Sleduj svoj tím a jeho stúpanie vyššie..</a></li>
                    </ul>
                </div>
                <div class="col-md-4 welcome-pic">
                    <h3>O systéme</h3>
                    <h4>Informačný systém bol vytvorený ako bakalárska práca.</h4>
                    <img src="images/main_images/cnt.ab.jpg" alt=""/>
                    <p>Jedná sa o informačny systém pre futbalový klub. Bol vytvaraný ako Bakalárska práca na VUT FIT.</p>
                </div>
                <div class="col-md-4 coach">
                    <h3>Náš tréner</h3>
                    <div class="coch-grid chr">
                        <div class="coach-pic">
                            <img src="images/main_images/kochantrener.jpeg" alt=""/>
                        </div>
                        <div class="coach-pic-info">
                            <h4><a href="#">Peter Kochan</a></h4>
                            <h5>Hlavny trener </h5>
                            <p>Rodeny občan Hanisky. V klube posobí odmalička a teraz predáva svoje schopnosti ako tréner.</p>
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

@extends('layouts.mainLayout.player_layout')




@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Player Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Player!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

--}}