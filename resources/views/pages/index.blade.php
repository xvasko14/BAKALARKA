@extends('layouts.mainLayout.main_layout')

@section('content')
    <!-- banner -->
    <div class="banner">
        <script type="text/javascript"  src="{{ asset('public/js/main_js/responsiveslides.min.js') }}"></script>
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    speed: 300,
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
                            <h3>VITAJTE</h3>
                            <p>Vitajte na informačnom portáli futbalového klubu FC Haniska. Prosím prihlaste sa ako tréner alebo hráč aby ste mohli daľej pokračovať.</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr2.jpg" alt="obrazok2">
                        <div class="banner-info">
                            <h3>Curabitur turpis posuere rutrum.</h3>
                            <p>Lorem Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a odio quam. Aenean ipsum arcu,
                                luctus vel ultricies ut, commodo sed turpis. Phasellus tristique lorem sit amet tellus dignissim hendrerit.
                                In hac habitasse platea dictumst. Sed vehicula volutpat varius elit. consectetur adipiscing elit.</p>
                        </div>
                    </li>
                    <li>
                        <img src="images/main_images/bnr1.jpg" alt="obrazok3">
                        <div class="banner-info">
                            <h3>Sed ultricies elementum.</h3>
                            <p>Lorem Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a odio quam. Aenean ipsum arcu,
                                luctus vel ultricies ut, commodo sed turpis. Phasellus tristique lorem sit amet tellus dignissim hendrerit.
                                In hac habitasse platea dictumst. Sed vehicula volutpat varius elit. consectetur adipiscing elit.</p>
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
                        <p>Inforamcny system pre klub, vdaka ktoremu mate organizaciu klubu na jednom mieste.</p>
                    </div>
                </div>
                <div class="col-md-6 banner-text-info clr2">
                    <i class="icon2"></i>
                    <div class="bnr-text">
                        <h3>Ligove tabulky</h3>
                        <p>Prezrite si tabulky a zistite ako stoji vas oblubeny tim. Takteiz nazrite aj do statistik a zhodnotene svojho hraca.</p>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 banner-text-info clr3 btm">
                    <i class="icon3"></i>
                    <div class="bnr-text">
                        <h3>Trening</h3>
                        <p>Vytvarajte trening a zistike kto tam pride. Alebo sa nanho prihlaste alebo zruste ucast z nejako dovodu.</p>
                    </div>
                </div>
                <div class="col-md-6 banner-text-info clr4 btm">
                    <i class="icon4"></i>
                    <div class="bnr-text">
                        <h3>Galeria</h3>
                        <p>Prezrite si galeriu fotiek z nasich zapasov. Nasajte tu atfosmeru a zazitok. Ak ste vernym fanusikom, mozno sa najdete na fotke.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //banner -->

    <!-- content -->
    <div class="content">
        <div class="container">
            <div class="content-grids">
                <div class="col-md-4 content-grid1">
                    <img src="images/main_images/c1.jpg" alt=""/>
                    <h3>Champion's League</h3>
                    <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.</p>
                    <a href="#">Read More..</a>
                </div>
                <div class="col-md-4 content-grid1">
                    <img src="images/main_images/c2.jpg" alt=""/>
                    <h3>Women's Cup</h3>
                    <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.</p>
                    <a href="#">Read More..</a>
                </div>
                <div class="col-md-4 content-grid1">
                    <img src="images/main_images/c3.jpg" alt=""/>
                    <h3>Final Tournment</h3>
                    <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.</p>
                    <a href="#">Read More..</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--- //content--->
    <!-- content-bottom -->
    <div class="content-info">
        <div class="container">
            <div class="content-bottom-grids">
                <div class="col-md-4 popular">
                    <h3>POPULAR TAGS</h3>
                    <ul>
                        <li><a href="#">Ut vehicula nisl ut purus tempus aliquet.</a></li>
                        <li><a href="#">Nullam a risus pharetra nisi commodo auctor.</a></li>
                        <li><a href="#">Proin venenatis velit a fringilla rutrum.</a></li>
                        <li><a href="#">Nunc facilisis dolor ac suscipit volutpat.</a></li>
                        <li><a href="#">Cras tempor justo ac mauris laoreet lacus efficitur.</a></li>
                        <li><a href="#">Sed tincidunt enim ac elit tempor erat consequat.</a></li>
                        <li><a href="#">Proin venenatis velit a fringilla rutrum.</a></li>
                        <li><a href="#"> Aliquam vulputate mi vestibulum mauris ultrices.</a></li>
                    </ul>
                </div>
                <div class="col-md-4 welcome-pic">
                    <h3>ABOUT</h3>
                    <h4>Morbi sed arcu mollis, elementum erat venenatis, tincidunt tellus.</h4>
                    <img src="images/main_images/cnt.ab.jpg" alt=""/>
                    <p>Aenean ut condimentum magna, mattis pretium massa. Sed sollicitudin ullamcorper auctor. Duis vestibulum velit id augue pulvinar egestas.
                        Morbi sed orci auctor, feugiat felis at, fermentum magna. In ac egestas lectus.</p>
                </div>
                <div class="col-md-4 coach">
                    <h3>Nasi treneri</h3>
                    <div class="coch-grid chr">
                        <div class="coach-pic">
                            <img src="images/main_images/kochantrener.jpeg" alt=""/>
                        </div>
                        <div class="coach-pic-info">
                            <h4><a href="#">Peter Kochan</a></h4>
                            <h5>Hlavny trener </h5>
                            <p>Rodeny obcan Hanisky. V klube posobi odmalicka a teraz predava svoje schopnosti ako trener.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="coch-grid">
                        <div class="coach-pic">
                            <img src="images/main_images/kochantrener.jpeg" alt=""/>
                        </div>
                        <div class="coach-pic-info">
                            <h4><a href="#">Phasellus at Tellus</a></h4>
                            <h5>Aenean vestibulum </h5>
                            <p>Donec ornare massa at velit fringilla, condimentum magna ornare tincidunt nulla dignissim.</p>
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
