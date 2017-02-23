@extends('master')

@section('title', 'NHS England Reference Data')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/mainhome.css') }}">
    <link rel="stylesheet" href="{{ url('Template/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('Template/css/base.css') }}">
    <link rel="stylesheet" href="{{ url('Template/css/google-code-prettify/prettify.css') }}">

    <style>
        .collapse {
            display: block !important;

        }

    </style>
@endsection

@section('content')

    <div>


            <div id="wrap">
                <div class="container">
                    <div class="row">
                        <div class="span4">
                            <img src="{{url('images/logo_nhs.png')}}"/>
                        </div>
                        <div class="span8">
                            <h3 class="pack-title text-right">NHS England Reference Data</h3>
                        </div>
                    </div>
                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container">
                                <button type="button" class="btn btn-navbar" data-toggle="collapse"
                                        data-target=".nav-collapse">
                                    <span class="icon-bar"/>
                                    <span class="icon-bar"/>
                                    <span class="icon-bar"/>
                                </button>
                                <div class="nav-collapse collapse">
                                    <p class="navbar-text pull-right">
                                        <b>Version: </b>0.1; <b>Status: </b>Draft</p>
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Overview <b class="caret"> </b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="./index.html">About</a>
                                                </li>
                                                <li>

                                                    <a href="./Core/changehistory.html">Change History</a>
                                                </li>
                                                <li>
                                                    <a href="./Core/glossary.html">Glossary</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="./Vocabulary/HL7v2/HL7v2.html">Reference Data</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/mapping')}}">Mappings</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="content" class="row">
                        <div class="span12">
                            <h3>About</h3>
                            <p>The NHS England Reference data is the publication consisting of the following:</p>
                            <ul>
                                <li>
                                    <b>NHS England Reference Vocabularies:</b> These vocabularies are extensions to support commissioning flows for values which are not present in NHS data dicionary.</li>
                                <li>
                                    <b>NHS England Mappings to Reference Vocabularies:</b> These mappings are created to support the consumption of the local data from providers for commissioning purposes.</li>
                            </ul>
                            <p>
                                <b>Note:</b> These scope of this reference data is only limited to provide support to commissioning anayltics.</p>
                        </div>
                    </div>

                </div>
                <div id="push"/>
            </div>



    </div>




@endsection
<footer>
    <div class="footer-strip">
        <div class="container">
            <div class="text-left">
                <p>&copy; 2016 Intelligent Health UK Limited. All Rights Reserved. </p>

            </div>

        </div>
    </div>
</footer>
@section('footer')
    @parent
    <script src="{{url('Template/js/jquery/jquery-1.8.3.js')}}"></script>
    <script src="{{url('Template/js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{url('Template/js/google-code-prettify/prettify.js')}}"></script>

    <script>
        !function ($){$(function(){window.prettyPrint && prettyPrint()})}(window.jQuery)
    </script>

@endsection