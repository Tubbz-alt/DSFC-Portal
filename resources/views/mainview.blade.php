@extends('master_main')

@section('title', 'Dashboards')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/mainstyle.css') }}">
@endsection

@section('title', 'Bedmatrix Dashboards')
@section('flash_message')
    @if(!empty($flash_message))
        {{-- */  $flash_message=$flash_message;/* --}}
    @else
    @endif
@stop

@section('content')
    <div class="loader-bg">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading-detail.gif') }}">
        </span>
    </div>
    <div class="col-sm-offset-1">

        <div class="wrap" style="height: 750px;">
            <div style="font-size: 57px;
                 width: 450px;
                 position: absolute;
                 font-family: times new roman;
                 top: 44%;
                 margin: 0 auto;
                 text-align: center;
                 left: 29%;">
                <img src="{{ url('images/ibox_logo.png') }}">
            </div>
            <?php $user = Sentinel::getUser();     ?>

            <div class="clip-block">

                <!-- sau -->

                <a href="{{ url('dashboard/patient-list/sau') }}" class="clip-each clip-gradient skyblue">
                    <div class="clip-caption">SAU</div>
                </a>

                <!--  Meldon -->

                <a href="{{ url('/dashboard/patient-list/meldon') }}" class="clip-each clip-gradient darkblue">
                    <div class="clip-caption">Meldon</div>
                </a>
                <!-- Trauma -->

                <a href="{{ url('/dashboard/patient-list/trauma') }}" class="clip-each clip-gradient bluesh">
                    <div class="clip-caption">Trauma</div>
                </a>


                <a href="#" class="clip-each clip-gradient bluesh">
                    <!-- <div class="clip-caption"></div> -->
                </a>
                <a href="#" class="clip-each clip-gradient darkblue">
                    <!-- <div class="clip-caption"></div> -->
                </a>
                <a href="#" class="clip-each clip-gradient skyblue">
                    <!-- <div class="clip-caption"></div> -->
                </a>
            </div>


            <div class="clip-block">
                <div class="clip-each ">
                    <!--  Ampney    -->

                    <a href="{{ url('dashboard/patient-list/ampney') }}" class="clip-each clip-gradient lightblue">
                        <div class="clip-caption">Ampney</div>
                    </a>


                </div>
                <div class="clip-each ">
                    <!--   ASU   -->

                    <a href="{{ url('dashboard/patient-list/asu') }}" class="clip-each clip-gradient grey">
                        <div class="clip-caption">Day Surgery <br> Unit (ASU)</div>
                    </a>


                </div>
                <div class="clip-each ">
                    <a href="{{ url('dashboard/patient-list/shalbourne') }}" class="clip-each clip-gradient darkblue">
                        <div class="clip-caption">Shalbourne</div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient grey">
                        <div class="clip-caption"></div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient lightblue">
                        <div class="clip-caption"></div>
                    </a>
                </div>
            </div>

            <div class="clip-block">
                <!-- Aldboume  -->

                <a href="{{ url('/dashboard/patient-list/aldbourne') }}" class="clip-each clip-gradient grey">
                    <div class="clip-caption">Aldboume</div>
                </a>
                <!-- ITU/HDU -->

                <a href="{{ url('dashboard/patient-list/itu-hdu') }}" class="clip-each clip-gradient bluesh">
                    <div class="clip-caption">ITU/HDU</div>
                </a>

                <!-- Beech -->

                <a href="{{ url('dashboard/patient-list/beech') }}" class="clip-each clip-gradient skyblue">
                    <div class="clip-caption">Beech</div>
                </a>


                <a href="{{ url('dashboard/benchmark/rtt-benchmark') }}" class="clip-each clip-gradient skyblue">
                    <!--                              <div class="clip-caption">RTT National Data </div>-->
                </a>

                <a href="#" class="clip-each clip-gradient bluesh">
                    <div class="clip-caption"></div>
                </a>
                <a href="#" class="clip-each clip-gradient grey">
                    <div class="clip-caption"></div>
                </a>
            </div>


            <div class="clip-block">
                <div class="clip-each ">
                    <!-- Hazel -->

                    <a href="{{ url('dashboard/patient-list/hazel') }}" class="clip-each clip-gradient bluesh">
                        <div class="clip-caption">Hazel</div>
                    </a>

                </div>

                <div class="clip-each ">
                    <!-- Dove -->

                    <a href="{{ url('/dashboard/patient-list/dove') }}" class="clip-each clip-gradient grey">
                        <div class="clip-caption">Dove</div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- <div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{url('dashboard/query-definite') }}" class="clip-each clip-gradient grey">
                        <div class="clip-caption">
                            <span class="span_icon qd_dashboard"></span>
                            <h6>Query <br> Definite</h6>
                        </div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{url('dashboard/boardround/history') }}" class="clip-each clip-gradient bluesh">

                        <div class="clip-caption">
                            <span class="span_icon bordround"></span>
                            <h6>Board <br> Round</h6>
                        </div>
                    </a>
                </div>


            </div> <!-- /clip-block -->

            <div class="clip-block">
                <a href="#" class="clip-each clip-gradient skyblue">
                    <!--                    <div class="clip-caption">LAMU</div>-->
                </a>
                <a href="#" class="clip-each clip-gradient darkblue_click">
                    <!-- 	<div class="clip-caption">text</div> -->
                </a>
                <a href="#" class="clip-each clip-gradient white">
                    <!-- 	<div class="clip-caption">text</div> -->
                </a>

                <a href="#" class="clip-each clip-gradient white">
                    <!-- 	<div class="clip-caption">text</div> -->
                </a>
                <a href="{{ url('dashboard/discharge-lounge') }}" class="clip-each clip-gradient  darkblue tabclass">
                    <div class="clip-caption summary_tabs">
                        <span class="span_icon lounge "></span>
                        <h6>Discharge Lounge</h6>
                    </div>
                </a>

                <a href="{{ url('dashboard/discharge-summary') }}" class="clip-each clip-gradient skyblue tabclass">

                    <div class="clip-caption summary_tabs">
                        <span class="span_icon summary "></span>
                        Discharge Summary
                    </div>
                </a>
            </div> <!-- /clip-block -->


            <div class="clip-block">
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient differ">
                        <!-- <div class="clip-caption">text</div>  -->
                    </a>
                </div>

                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- <div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- <div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <div class="clip-caption"></div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{ url('dashboard/outliers') }}" class="clip-each clip-gradient lightblue">
                        <div class="clip-caption">
                            <span class="span_icon outlayer"></span>
                            <!--                            <h6>Outliers</h6>-->
                            <h6>RPRB</h6>

                        </div>
                    </a>

                </div>

            </div>

            <div class="clip-block">

                <a href="{{url('/dashboard/ane/last15-hour-flow') }}" class="clip-each clip-gradient grey">
                    <div class="clip-caption"><span class="span_icon ane"></span>
                        Last 15-Hour<br>Flow
                    </div>
                </a>
            <!--                  <a href="{{url('/dashboard/ane/bubble') }}" class="clip-each clip-gradient bluesh">
                        <div class="clip-caption"><span class="span_icon ane"></span> Bubble</div>
                    </a>-->
                <a href="{{url('/dashboard/ane/ane-dashboard') }}" class="clip-each clip-gradient bluesh">
                    <div class="clip-caption"><span class="span_icon ane"></span>
                        Status
                    </div>
                </a>

                <a href="#" class="clip-each clip-gradient white">
                    <!-- <div class="clip-caption">text</div> -->
                </a>

                <a href="#" class="clip-each clip-gradient white">
                    <!-- 	<div class="clip-caption">text</div> -->
                </a>

                <a href="{{ url('dashboard/abc') }}" class="clip-each clip-gradient bluesh">
                    <div class="clip-caption">
                        <span class="span_icon abc"></span>
                        <h6>ABC</h6>
                    </div>

                </a>
                <a href="{{ url('dashboard/transport') }}"
                   class="clip-each clip-gradient grey">
                    <div class="clip-caption">
                    <!-- <img  src="{{ url('images/transport.png') }}" alt="Transport Dashboard "> -->
                        <span class="span_icon transport"></span>
                        <h6>Transport</h6>

                    </div>


                </a>
            </div> <!-- /clip-block -->


            <div class="clip-block">
                <div class="clip-each ">


                    <a href="#" class="clip-each clip-gradient bluesh">
                        <div class="clip-caption">
                        </div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- 	<div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- 	<div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- 	<div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{ url('dashboard/delayeddischarge') }}" class="clip-each clip-gradient bluesh">
                        <div class="clip-caption">
                            <span class="span_icon dtoc"></span>
                            <h6>Delayed Discharge</h6>

                        </div>
                    </a>
                </div>
            </div> <!-- /clip-block -->

            <div class="clip-block">
                <a href="#" class="clip-each clip-gradient lightblue">
                    <!--  <div class="clip-caption"></div> -->
                </a>
                <a href="#" class="clip-each clip-gradient grey_click">
                    <!-- <div class="clip-caption"></div> -->
                </a>

                <a href="#" class="clip-each clip-gradient white">
                    <!-- 	<div class="clip-caption">text</div> -->
                </a>

                <a href="#" class="clip-each clip-gradient  white">
                    <!-- 	<div class="clip-caption">text</div> -->
                </a>
                <a href="{{ url('dashboard/bedmatrix') }}" class="clip-each clip-gradient  grey">
                    <div class="clip-caption">
                        <span class="span_icon bed"></span>
                        <h6>BedMatrix</h6>
                    </div>
                </a>


                <a href="{{ url('dashboard/consultant') }}" class="clip-each clip-gradient lightblue">
                    <div class="clip-caption">
                        <span class="span_icon consultant"></span>
                        <h6>Consultant</h6>
                    </div>

                </a>
            </div> <!-- /clip-block -->


            <div class="clip-block">
                <div class="clip-each ">
                    <a href="{{ url('dashboard/patient-list/neptune') }}" class="clip-each clip-gradient darkblue">
                        <div class="clip-caption">Neptune</div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{ url('dashboard/patient-list/woodpecker') }}" class="clip-each clip-gradient bluesh">
                        <div class="clip-caption">Woodpecker</div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient white">
                        <!-- <div class="clip-caption">text</div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient bluesh">
                        <!-- <div class="clip-caption"></div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{ url('dashboard/mdtdashboard') }}" class="clip-each clip-gradient darkblue">

                        <div class="clip-caption">
                            <span class="span_icon mdt"></span>
                            <h6>MDT</h6>
                        </div>

                    </a>
                </div>
            </div> <!-- /clip-block -->

            <div class="clip-block">
                <a href="{{ url('dashboard/patient-list/jupiter') }}" class="clip-each clip-gradient bluesh">
                    <div class="clip-caption">Jupiter</div>
                </a>
                <a href="{{ url('dashboard/patient-list/saturn') }}" class="clip-each clip-gradient grey">
                    <div class="clip-caption">Saturn</div>
                </a>

                <a href="{{ url('/dashboard/patient-list/kingfisher') }}"
                   class="clip-each clip-gradient bluesh tabclass" data-ward="kingfisher"
                   data-tab="medical_triage_unit">

                    <div class="clip-caption">Kingfisher Medical<br>Triage</div>
                </a>

                <a href="{{ url('/dashboard/patient-list/kingfisher') }}"
                   class="clip-each clip-gradient bluesh tabclass" data-ward="kingfisher" data-tab="assessment_unit">

                    <div class="clip-caption">Kingfisher <br> Assessment<br> Unit</div>
                </a>
                <a href="#" class="clip-each clip-gradient grey">
                    <!-- <div class="clip-caption"></div> -->
                </a>
                <a href="#" class="clip-each clip-gradient bluesh">
                    <!-- <div class="clip-caption"></div> -->
                </a>
            </div> <!-- /clip-block -->


            <div class="clip-block">
                <div class="clip-each ">
                    <a href="{{ url('dashboard/patient-list/falcon') }}" class="clip-each clip-gradient bluesh">
                        <div class="clip-caption">Falcon</div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{ url('/dashboard/patient-list/kingfisher') }}"
                       class="clip-each clip-gradient skyblue tabclass" data-ward="kingfisher"
                       data-tab="ambulatory_care_unit">
                        <div class="clip-caption">Kingfisher <br> Amb<br> Care</div>
                        <!--                        <div class="clip-caption">Shalboume</div>-->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="{{ url('/dashboard/patient-list/kingfisher') }}"
                       class="clip-each clip-gradient grey tabclass" data-ward="kingfisher" data-tab="lamu">
                        <div class="clip-caption">LAMU</div>
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient skyblue">
                        <!-- <div class="clip-caption"></div> -->
                    </a>
                </div>
                <div class="clip-each ">
                    <a href="#" class="clip-each clip-gradient bluesh">
                        <!-- <div class="clip-caption"></div> -->
                    </a>
                </div>
            </div> <!-- /clip-block -->

            <div class="clip-block">
                <a href="{{ url('dashboard/patient-list/ccu') }}" data-ward="ccu" data-tab="ccu"
                   class="clip-each clip-gradient lightblue tabclass">
                    <div class="clip-caption">WCC - CCU</div>
                </a>
                <a href="{{ url('dashboard/patient-list/ccu') }}" data-ward="ccu" data-tab="cath_lab"
                   class="clip-each clip-gradient grey tabclass">
                    <div class="clip-caption">WCC <br> Cath<br> Lab</div>
                </a>

                <a href="{{ url('dashboard/patient-list/teal') }}" class="clip-each clip-gradient lightblue">
                    <div class="clip-caption">Teal</div>
                </a>

                <a href="{{ url('dashboard/patient-list/mercury') }}" class="clip-each clip-gradient lightblue">
                    <div class="clip-caption">Mercury</div>
                </a>
                <div class="clip-each clip-gradient grey">
                    <!-- <div class="clip-caption">LAMU Dummy Ward</div>  -->
                </div>
                <a href="{{ url('dashboard/patient-list/test-ward') }}" class="clip-each clip-gradient lightblue">
                    <div class="clip-caption">Test Ward</div>
                </a>
            </div> <!-- /clip-block -->

            <!-- 10 ----------->
            <svg class="clip-svg">
                <defs>
                    <clipPath id="hexagon-clip" clipPathUnits="objectBoundingBox">
                        <polygon points="0.25 0.05, 0.75 0.05, 1 0.5, 0.75 0.95, 0.25 0.95, 0 0.5"/>
                    </clipPath>
                </defs>
            </svg>

            <svg class="clip-svg">
                <defs>
                    <clipPath id="triangle-clip" clipPathUnits="objectBoundingBox">
                        <polygon points="1 0.03, 0.17 1, 1 1"/>
                    </clipPath>
                </defs>
            </svg>
        </div>
    </div>
    </body>
    </html>
@endsection

@section('footer')
    @parent

    <script>

        $(document).ready(function () {
            setTimeout("jQuery('.loader-bg').hide();", 2000);
            $(".tabclass").on('click', function (e) {
                e.preventDefault();
                var redirectUrl = $(this).attr('href');
                var ward = $(this).attr('data-ward');
                var active = $(this).attr('data-tab');
                $.ajax({
                    type: "GET",
                    dataType: "text",
                    url: "{{url('dashboard/patient-list/session/set-ward')}}",
                    data: {'ward': ward, 'tab': active},
                    success: function (data) {
                        location.href = redirectUrl;
                    }
                });
            });


        });


    </script>

@endsection