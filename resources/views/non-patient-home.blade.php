@extends('master_home')

@section('title', 'Dashboards')

@section('header')
    @parent
    <link rel="stylesheet" href="#{{ url('css/bedmetrix/matrix.css') }}">
    <link rel="stylesheet" href="#{{ url('css/floorplan/floor.css') }}">
    <link rel="stylesheet" href="#{{ url('css/wardperformance.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Dosis:400,600,700,500' rel='stylesheet' type='text/css'>

    @endsection

    @section('title', ' Dashboards')
                      @section('flash_message')
                          @if(!empty($flash_message))
                          {{-- */  $flash_message=$flash_message;/* --}}
                          @else
                          @endif
                      @stop
    @section('content')

<div id="content-wrapper" class="dashboard-strip non-patient-home">
          <div class="container">
            <div class="dash-board-cover">
                <div class="dash-link link-1 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <div class="dash-link link-2 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <a href="{{ url('dashboard/diagnostic/commissioner') }}"> <div class="dash-link link-3 width-1 dash-link-shadow-1 font-1"><label>Diagnostic <br>Commissioner</label></div></a>
                <div class="dash-link link-4 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <a href="{{ url('dashboard/benchmark/rtt-benchmark') }}"> <div class="dash-link link-5 width-2 dash-link-shadow-2 font-2"><label>RTT <br>Commissioner</label></div></a>
                <a href="{{ url('dashboard/rttprovider/rtt-benchmark') }}"><div class="dash-link link-6 width-3 dash-link-shadow-3 font-3"><label>RTT <br> Provider</label></div></a>
                <div class="dash-link link-7 width-2 dash-link-shadow-2 font-3"><label></label></div>
                <div class="dash-link link-8 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <div class="dash-link link-9 width-4 dash-link-shadow-1 font-4"><label></label></div>
                <a href="{{ url('dashboard/cancer-commissioner/cc-benchmark') }}">  <div class="dash-link link-10 width-2 dash-link-shadow-2 font-2"><label>Cancer <br>Commissioner</label></div></a>
                <div class="dash-link link-11 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <a href="{{ url('dashboard/ane-datamagnified/datamagnified') }}"> <div class="dash-link link-12 width-3 dash-link-shadow-3 font-3"><label>A&E</label></div></a>
                <div class="dash-link link-14 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <div class="dash-link link-15 width-4 dash-link-shadow-4 font-4"><label></label></div>
                <div class="dash-link link-22 width-2 dash-link-shadow-2 font-2"><label></label></div>
                <a href="{{ url('dashboard/diagnostic/provider') }}"> <div class="dash-link link-17 width-3 dash-link-shadow-3 font-3"><label>Diagnostic <br>Provider</label></div></a>
                <a href="{{ url('dashboard/dtoc-magnified') }}"> <div class="dash-link link-18 width-4 dash-link-shadow-4 font-4"><label>Dtoc </label></div></a>
                 <a href="{{ url('dashboard/patient-fft') }}"> <div class="dash-link link-19 width-1 dash-link-shadow-1 font-1"><label>Patient FFT</label></div></a>
                <a href="{{ url('dashboard/operation/urgent-operation') }}"> <div class="dash-link link-20 width-2 dash-link-shadow-2 font-2"><label>Urgent <br> Operation</label></div></a>
                <div class="dash-link link-21 width-3 dash-link-shadow-3 font-3"><label></label></div>
                <a href="{{ url('dashboard/cancer-provider') }}">  <div class="dash-link link-16 width-2 dash-link-shadow-2 font-2"><label>Cancer <br>Provider</label></div></a>
                <div class="dash-link link-23 width-1 dash-link-shadow-1 font-1"><label></label></div>
                <div class="dash-link link-24 width-3 dash-link-shadow-3 font-3"><label></label></div>
                <div class="dash-link link-25 width-4 dash-link-shadow-4 font-4"><label></label></div>
           </div>
          </div>          
  </div>  
    
    @endsection
    
    @section('footer')
    @parent


@endsection