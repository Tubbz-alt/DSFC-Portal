@extends('home-master')

@section('title', 'iBox')

@section('header')
    @parent
    <link href="{{ url('css/home/all.css') }}" rel="stylesheet">
    <link href="{{ url('css/home/popup.css') }}" rel="stylesheet">

@endsection

@section('content')
    <style>

        .inner-description {
            text-align: center;
            position: absolute;
            top: 196px;
            left: 177px;
            height: 72px;
            width: 300px;
            vertical-align: middle;
            padding-top: 23px;
            background-color: white;
            color: black;
            font-size: 11px;
            font-weight: bold;
            line-height: 1.5em;
        }



        .iboards .inner-description {
            font-weight: bold;

        }
        .ibox_slider_cover .main-menu-strip {
            background: transparent none repeat scroll 0 0 !important;
        }
    </style>
    <div class="container">
        <div class="index-slider-header">
            <div class="logo-cover"><img src="{{ url('images/ibox_logo_home.png') }}" alt=""></div>

            <div id="dashboard-main-menu-strip" class="main-menu-strip" >
                <div>
                    <div class="top-menu-cover ">
                        <ul class="nav navbar-nav  nav navbar-nav pull-right  setting-icon-home">
                            <li class="top-drop-down">
                                <nav class="setting-icon ">
                                    <ul class="drop-down-menu">
                                        <?php
                                        $user = Sentinel::getUser();
                                        if($user->inRole('admin')) {
                                        ?>
                                        <li><a href="{{ url('admin') }}">Admin </a></li>
                                        <?php }
                                        ?>
                                        @if($user->inRole('admin') || $user->inRole('known_admin'))
                                                <li>
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#set-home-page">Home Page Preference
                                                    </a>
                                                </li>
                                        @endif
                                        <li><a href="{{ url('user/logout') }}">Logout</a></li>
                                    </ul>
                                </nav>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="slider-strip">
            <div id="carousel" style="margin-top: -30px;">
                <ul class="flip-items">
                    <li data-flip-title="Data Magnified">
                        <a href="{{ url('dashboard/data-magnified') }}" title="Data Magnified">
                            <img src="{{ url('images/sample.jpg') }}">
                            <div class="innercontentdiv">
                                <!--<span class="boldheadings">Data</span>
                                <span class="lightheadings">Magnified</span>-->
                                <img src="{{ url('images/Data Magnified Logo.png') }}">
                            </div>
                            <div class="inner-description">
                                Benchmark and performance dashboards
                            </div>


                        </a>
                    </li>
                    <li data-flip-title="Data Quality" class="dataquality">
                        <a href="{{ url('dashboard/data-challenges') }}" title="Data Quality">
                            <img src="{{ url('images/sample.jpg') }}">
                            <div class="innercontentdiv datachallenges">
                                <!-- <span class="boldheadings">Data</span>
                                 <span class="lightheadings">Quality</span>-->
                             <img  id="my-img" src="{{ url('images/data-challenges-logo.png') }}">
                            </div>
                            <div class="inner-description">
                                Commissioner Related Data Challenges
                            </div>
                        </a>
                    </li>
                    <li data-flip-title="Pharmacy" class="pharmacy">
                        <a href="{{ url('dashboard/pharmacy') }}" title="Pharmacy">
                            <img src="{{ url('images/sample.jpg') }}">
                            <div class="innercontentdiv">
                                <span class="lightheadings">Pharmacy</span>
                            </div>

                        </a>
                    </li>
                    <li data-flip-title="iboards" class="iboards">
                        <a href="{{ url('dashboard/main') }}" title="iboards">

                            <img src="{{ url('images/bed_metrix.jpg') }}">
                            <div class="inner-description">
                                Electronic Whiteboards and Bed Management
                            </div>
                        </a>
                    </li>
                    <li data-flip-title="Theaters" class="theatres">
                        <a href="javascript:void(0)">
                            <img src="{{ url('images/sample.jpg') }}">
                            <div class="innercontentdiv">
                                <span class="lightheadings">Theatres</span>
                            </div>
                        </a>
                    </li>

                    <li data-flip-title="Finance" class="audit">
                         <a href="javascript:void(0){{--{{ url('dashboard/audit') }}--}}" title="Finance">
                            <img src="{{ url('images/sample.jpg') }}">
                            <div class="innercontentdiv">

                                <img src="{{ url('images/SCCG-Header-Logo.jpg') }}" style="width:80%">
                            </div>
                            <div class="inner-description">
                                CCG Dashboards
                            </div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>


    </div>



    @if (session('home_screen_popup'))

        <svg class="clip-svg">
            <defs>
                <clipPath id="hexagon-clip" clipPathUnits="objectBoundingBox">
                    <polygon points="0.25 0.05, 0.75 0.05, 1 0.5, 0.75 0.95, 0.25 0.95, 0 0.5"/>
                </clipPath>
            </defs>
        </svg>

        <!-- Modal for set login page  view -->
        <div class="modal fade " id="set-home-page" tabindex="-1" role="dialog"
             aria-labelledby="windows-login" aria-hidden="true">



            <div class="col-md-12" style="margin-top:60px;">
                <div class="col-md-4">
                    <p style="color: #ffffff; text-align: left;">To move back to the main menu just click
                        the ibox Dashboards logo in the top corner to navigate between menus.
                     </p>
                </div>
                <div class="col-md-4">
                    <p style="color: #ffffff; text-align: right;">
                        Please select your desired Home Page at next login.</p>

                </div>
                <div class="col-md-4">
                    <p style="color: #ffffff; text-align: right;">
                        To Alter this preference later
                        on use the cog in the top corner and edit.</p>

                </div>
            </div>






            <div class="modal-dialog" style="width: 700px;">

                <div class="modal-content">
                    <div>
                        <!-- Modal Header -->

                        <!-- Modal Body -->
                        <div class="modal-body" style="height: 650px;">
                            <div class="center-content" style="margin-top:0;">




                                <a href="" class="hexagon home" title="Home Page">
                                    <span><img src="{{ url('images/home-slider-icon.png') }}"></span></a>
                                <a href="" class="hexagon iboards" title="iBoards">
                                    <span><img src="{{ url('images/home-iboards.png') }}"></span></a>
                                <a href="" class="hexagon data-challenge" title="Data Challenges">
                                    <span><img src="{{ url('images/home-data-challeges.png') }}"></span></a>
                                <a href="" class="hexagon data-magnified" title="Data Magnified">
                                    <span><img src="{{ url('images/home-data-magnified.png') }}"></span></a>
                                <a href="" class="hexagon pharmacy" title="Pharmacy">
                                    <span><img src="{{ url('images/home-pharmacy-icon.png') }}"></span></a>
                                <a href="" class="hexagon ccg" title="CCG">
                                    <span><img src="{{ url('images/home-nhs.png') }}"></span></a>
                                <a href="" class="hexagon theatre" title="Theatres">
                                    <span><img src="{{ url('images/home-theatres-icon.png') }}"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

       <svg class="clip-svg">
            <defs>
                <clipPath id="hexagon-clip" clipPathUnits="objectBoundingBox">
                    <polygon points="0.25 0.05, 0.75 0.05, 1 0.5, 0.75 0.95, 0.25 0.95, 0 0.5"/>
                </clipPath>
            </defs>
        </svg>

        <!-- Modal for set login page  view -->
        <div class="modal fade " id="set-home-page" tabindex="-1" role="dialog"
             aria-labelledby="windows-login" aria-hidden="true">



            <div class="col-md-12" style="margin-top:60px;">
                <div class="col-md-4">
                    <p style="color: #ffffff; text-align: left;">To move back to the main menu just click
                        the ibox Dashboards logo in the top corner to navigate between menus.
                     </p>
                </div>
                <div class="col-md-4">
                    <p style="color: #ffffff; text-align: right;">
                        Please select your desired Home Page at next login.</p>

                </div>
                <div class="col-md-4">
                    <p style="color: #ffffff; text-align: right;">
                        To Alter this preference later
                        on use the cog in the top corner and edit.</p>

                </div>
            </div>






            <div class="modal-dialog" style="width: 700px;">

                <div class="modal-content">
                    <div>
                        <!-- Modal Header -->

                        <!-- Modal Body -->
                        <div class="modal-body" style="height: 650px;">
                            <div class="center-content" style="margin-top:0;">




                                <a href="" class="hexagon home" title="Home Page">
                                    <span><img src="{{ url('images/home-slider-icon.png') }}"></span></a>
                                <a href="" class="hexagon iboards" title="iBoards">
                                    <span><img src="{{ url('images/home-iboards.png') }}"></span></a>
                                <a href="" class="hexagon data-challenge" title="Data Challenges">
                                    <span><img src="{{ url('images/home-data-challeges.png') }}"></span></a>
                                <a href="" class="hexagon data-magnified" title="Data Magnified">
                                    <span><img src="{{ url('images/home-data-magnified.png') }}"></span></a>
                                <a href="" class="hexagon pharmacy" title="Pharmacy">
                                    <span><img src="{{ url('images/home-pharmacy-icon.png') }}"></span></a>
                                <a href="" class="hexagon ccg" title="CCG">
                                    <span><img src="{{ url('images/home-nhs.png') }}"></span></a>
                                <a href="" class="hexagon theatre" title="Theatres">
                                    <span><img src="{{ url('images/home-theatres-icon.png') }}"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('footer')
    @parent
    <script src="{{url('js/jquery.flipster.js')}}"></script>
    <script>
        var carousel = $("#carousel").flipster({
            style: 'carousel',
            spacing: -0.5,
            nav: true,
            buttons: true
        });
    </script>


        <script>
            jQuery(document).ready(function (e) {
                 @if (session('home_screen_popup'))
                    jQuery('#set-home-page').modal('show');
                @endif
                 jQuery('.hexagon').on('click', function (e) {
            e.preventDefault();
            var page = $(this).attr('title');
            if (page != 'Theatres') {
                $('.hexagon').removeClass('active');
                $(this).addClass('active');
                $.ajax({
                    url: '{{ url('dashboard/user/set-home-page-preference') }}',
                    data: {'page': page},
                    type: 'GET',
                    success: function (data) {
                        jQuery('#set-home-page').modal('hide');
                        alert('Your Home Page Preference has been updated to :' + data);

                            switch (data)
                            {
                                case 'iBoards':
                                window.location.href = '{{url('/dashboard/main')}}';
                                break;
                                case 'Data Magnified':
                                window.location.href = '{{url('/dashboard/data-magnified')}}';
                                break;
                                case 'Pharmacy':
                                window.location.href = '{{url('/dashboard/pharmacy')}}';
                                break;
                                case 'CCG':
                                window.location.href = '{{url('/dashboard/audit')}}';
                                break;
                                case 'Data Challenges':
                                window.location.href = '{{url('/dashboard/data-challenges')}}';
                                break;
                                case 'Home Page' :
                                window.location.href = '{{url('/home')}}';
                                break;

                            }
                    }
                });
            }
            else {
                alert('Theatres currently not available..!');
            }
        });
            });




        </script>

@endsection