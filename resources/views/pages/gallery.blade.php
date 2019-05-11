
@extends('layouts.mainLayout.main_layout')

@section('content')
<div class="gallery-head">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">{{ __('message.Home') }}</a></li>
            <li class="active">{{ __('message.galeria') }}</li>
        </ol>
    </div>
    <div class="gallery-text">
        <div class="container">
            <h2>{{ __('message.galeria') }}</h2>
            <p>{{ __('message.galeriaphoto') }}</p>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="gallery">
                <section>
                    <ul class="lb-album">
                        <li>
                            <a href="#image-1">
                                <img src="images/main_images/g1.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-1">
                                <img src="images/main_images/g1.jpg" class="img-responsive" alt="image03">
                                <a  href="gallery" class="lb-close "><img src="images/main_images/close.png" ></a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-abt2">
                                <img src="images/main_images/haniska_club.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-abt2">
                                <img src="images/main_images/haniska_club.jpg" class="img-responsive" alt="image03">
                                <a href="gallery" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-2">
                                <img src="images/main_images/g3.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-2">
                                <img src="images/main_images/g3.jpg" class="img-responsive" alt="image03">
                                <a href="gallery" class="lb-close"> <img src="images/main_images/close.png" ></a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-4">
                                <img src="images/main_images/g4.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-4">
                                <img src="images/main_images/g4.jpg" class="img-responsive" alt="image03">
                                <a href="gallery" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="lb-album">
                        <li>
                            <a href="#image-5">
                                <img src="images/main_images/g5.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-5">
                                <img src="images/main_images/g5.jpg" class="img-responsive" alt="image03">
                                <a href="#gallery" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-6">
                                <img src="images/main_images/g6.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-6">
                                <img src="images/main_images/g6.jpg" class="img-responsive" alt="image03">
                                <a href="gallery" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-abt1">
                                <img src="images/main_images/g7.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-abt1">
                                <img src="images/main_images/g7.jpg" class="img-responsive" alt="image03">
                                <a href="gallery" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-g8">
                                <img src="images/main_images/g8.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-g8">
                                <img src="images/main_images/g8.jpg" class="img-responsive" alt="image03">
                                <a href="gallery" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="lb-album">
                        <li>
                            <a href="#image-g9">
                                <img src="images/main_images/g9.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-g9">
                                <img src="images/main_images/g9.jpg" class="img-responsive" alt="image03">
                                <a href="#page" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-abt3">
                                <img src="images/main_images/g10.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-abt3">
                                <img src="images/main_images/g10.jpg" class="img-responsive" alt="image03">
                                <a href="#page" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-3">
                                <img src="images/main_images/g11.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-3">
                                <img src="images/main_images/g11.jpg" class="img-responsive" alt="image03">
                                <a href="#page" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                        <li>
                            <a href="#image-12">
                                <img src="images/main_images/g12.jpg" class="img-responsive" alt="">
                                <span> </span>
                            </a>
                            <div class="lb-overlay" id="image-12">
                                <img src="images/main_images/g12.jpg" class="img-responsive" alt="image03">
                                <a href="#page" class="lb-close"><img src="images/main_images/close.png" > </a>
                            </div>
                        </li>
                    </ul>
                </section>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>

@endsection