@extends('master_home')
@section('page-title','Change Home Preference')
@section('header')
    @parent
    <link href="{{ url('css/home/popup.css') }}" rel="stylesheet">

@endsection

@section('title', 'Change Home Preference')

@section('content')
    <div class="loader-bg">
    <span class="image-loader screen-center">
                        <img src="{{ url('images/loading-detail.gif') }}">
                    </span>
    </div>

    <div class="container">
        <div class="center-content" style="margin-top: 110px;">
            <p style="text-align: justify; position: absolute; top:-50px">Please select your desired Home Page for next login. To Alter this preference later
                on use the cog in the top corner and edit. To move back to the main menu just click
                the ibox Dashboards logo in the top corner to navigate between menus.</p>
            <a href="" class="hexagon home @if($current=='Home Page') active @endif" title="Home Page">
                <span><img src="{{ url('images/home-slider-icon.png') }}"></span></a>
            <a href="" class="hexagon iboards @if($current=='iBoards') active @endif" title="iBoards">
                <span><img src="{{ url('images/home-iboards.png') }}"></span></a>
            <a href="" class="hexagon data-challenge @if($current=='Data Challenges') active @endif" title="Data Challenges">
                <span><img src="{{ url('images/home-data-challeges.png') }}"></span></a>
            <a href="" class="hexagon data-magnified @if($current=='Data Magnified') active @endif" title="Data Magnified">
                <span><img src="{{ url('images/home-data-magnified.png') }}"></span></a>
            <a href="" class="hexagon pharmacy @if($current=='Pharmacy') active @endif" title="Pharmacy">
                <span><img src="{{ url('images/home-pharmacy-icon.png') }}"></span></a>
            <a href="" class="hexagon ccg @if($current=='CCG') active @endif" title="CCG">
                <span><img src="{{ url('images/home-nhs.png') }}"></span></a>
            <a href="" class="hexagon theatre @if($current=='Theatres') active @endif" title="Theatres">
                <span><img src="{{ url('images/home-theatres-icon.png') }}"></span></a>
        </div>
    </div>



    <svg class="clip-svg">
        <defs>
            <clipPath id="hexagon-clip" clipPathUnits="objectBoundingBox">
                <polygon points="0.25 0.05, 0.75 0.05, 1 0.5, 0.75 0.95, 0.25 0.95, 0 0.5"/>
            </clipPath>
        </defs>
    </svg>


@endsection
@section('footer')
    @parent
    <script>
        jQuery(document).ready(function (e) {
            jQuery('.hexagon').on('click', function (e) {
                e.preventDefault();
                var page = $(this).attr('title');
                if(page!='Theatres') {
                    $('.hexagon').removeClass('active');
                    $(this).addClass('active');
                    $.ajax({
                        url: '{{ url('dashboard/user/set-home-page-preference') }}',
                        data: {'page': page},
                        type: 'GET',
                        success: function (data) {
                            alert(data);
                             window.location.href = '{{url('/home')}}';


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
