<link rel="stylesheet" href="{{ url('css/frontend/pretty.css') }}">
<style>
    .collapse {
        display: block !important;
    }
    .navbar-inner-color{
        background: #808080 none repeat scroll 0 0;
    }
    #wrap .navbar .nav > li > a{
        border-right: 1px solid #fff;
        padding-top: 8px !important;
        color:#ffffff !important;
    }
    #wrap .nav > li > a:focus, .nav > li > a:hover{
        background-color: #808080;
    }
    #wrap .nav .open > a, .nav .open > a:focus, .nav .open > a:hover{
        background-color: #808080;
    }
    #wrap .dropdown-menu{
        background:#808080;
        color:white;
    }
    /*#wrap .dropdown-menu a {
    background: #0072c6 none repeat scroll 0 0;
    border-bottom: 1px solid #fff;
    } */
    #wrap .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover{
        background:#808080;
        color:white;
    }
    a.current {
        background:#5bc0de;
        color:white;
    }
</style>
<div class="header-strip">

    <div class="col-md-5">
        <div class="logo-cover">
            <a href="{{ url('/') }}">
                <img src="{{ url('images/logo.png') }}" alt="">
            </a>
        </div>
    </div>
    <div class="col-md-6">
      {{--  @yield('top-right-menu')--}}
        <span class="user-cover pull-right">
      {{--      <h2><a href="#">{{ucfirst(strtolower(Sentinel::check()->first_name)) . " " . ucfirst(strtolower(Sentinel::check()->last_name))}}</a></h2>
            <p>Logged in as {{Sentinel::check()->username}}</p>--}}
        </span>
    </div>
    <div class="col-md-1 top-drop-down">
        <nav>
            <ul class="drop-down-menu">
              {{--  <li><a href="#">Profile</a></li>--}}
                <li><a href="{{ url('admin') }}">Admin</a></li>
                <li><a href="{{ url('user/logout') }}">Logout</a></li>
            </ul>
        </nav>
    </div>
</div>
<div class="main-menu-strip">
    <div class="container">
        <nav>
            <ul>
           {{--     <li>
                    <a href="#">RTT</a>
                    <ul>
                        <li><a href="{{ url('admin/rtt/admitted-adjusted') }}">Admitted(Adjusted)</a></li>
                        <li><a href="{{ url('admin/rtt/admitted-adjusted-total') }}">Admitted(Adjusted) Total</a></li>
                        <li><a href="{{ url('admin/rtt/non-admitted') }}">Non Admitted</a></li>
                        <li><a href="{{ url('admin/rtt/non-admitted-total') }}">Non Admitted Total</a></li>
                        <li><a href="{{ url('admin/rtt/incomplete') }}">Incomplete</a></li>
                        <li><a href="{{ url('admin/rtt/incomplete-total') }}">Incomplete Total</a></li>
                    </ul>
                </li>--}}

               {{-- <li><a href="{{ url('admin/reference-data') }}">Reference Data</a></li>

                <li><a href="{{ url('admin/users') }}">Users</a></li>--}}
               {{-- <li><a href="{{ url('admin/groups') }}">Groups</a></li>--}}
            </ul>
         </nav>
    </div>
</div>
<div id="wrap">
    <div class="container-fluid">
        <div class="container row">
            {{--     <div class="span4">
                     <img src="{{url('images/logo.png')}}"/>
                 </div>--}}
            {{--<div class="span8" >
                <h3 class="pack-title ">DSfC Reference Data</h3>
            </div>--}}
        </div>
        <div class="navbar">
            <div class="navbar-inner navbar-inner-color">
                <div class="">

                    <div class="nav-collapse collapse">
                        <p class="navbar-text pull-right" style="margin: 10px;color: white;">
                            <b>Version: </b>0.1; <b>Status: </b>Draft</p>
                        <ul class="nav">
                            <li class="dropdown">

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{url('/dashboard')}}">About</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Change History</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Glossary</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ url('admin/users') }}">Users</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/reference-data') }}">Imported</a>
                            </li>
                            <li>
                                <a href="{{url('admin/reference-data/datatypes')}}">Data Types</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/reference-data/data-item') }}">Data Items</a>
                            </li>
                            <li>
                                <a href="{{url('admin/reference-data/mapping')}}">Mapping</a>
                            </li>

                            <li>
                                <a href="{{url('admin/reference-data/grouping')}}">Group</a>
                            </li>

                            <li>
                                <a href="{{url('admin/reference-data/tnr')}}">TNR</a>
                            </li>
                            <li>
                                <a href="{{url('admin/reference-data/national-data')}}">National Data</a>
                            </li>

                            <li>
                                <a href="{{url('admin/reference-data/change-request')}}">Change Request</a>
                            </li>
                            <li>
                                <a href="{{url('admin/reference-data/feedback')}}">Feedback</a>
                            </li>
                            <li>
                                <a href="{{url('admin/reference-data/help-data')}}">Help</a>
                            </li>
                            <li>
                                <a href="{{url('admin/reference-data/export-data')}}">Export</a>
                            </li>

                            <li>
                                <a href="{{ url('/dashboard') }}">Back to Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script>
    $(function(){
        $('a').each(function() {
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('current');
            }
        });
    });
</script>