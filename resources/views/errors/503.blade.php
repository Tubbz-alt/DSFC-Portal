@extends('frontend-master')

@section('title', '503')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/frontend/home.css') }}">
@endsection
@section('content')


<style>
    body{
        background: #ffffff;
    }
    .cntblock{
        color:#60B4F8;
    }
    .msglogo{
        margin-top: 5%;
    }
</style>

    <div id="content-wrapper" class="container">
        <h1 class="margin-top-20 msglogo"><a href="{{ url('dashboard/') }}"><img src="{{ url('images/msglogo.jpg') }}" alt=""></a></h1>
<!--        <h1 class="text-lato-hairline"><a href="{{ url('dashboard/') }}">iBox Dashboards</a></h1>-->
    </div>
    <div class="">
        <div class="col-xs-12">
            <h1 class="text-lato-hairline text-center cntblock"><strong>Update is complete.
            <br><a class="btn btn-default" href="http://ibox/user/login">Click here</a> to login back to live server</strong></h1>
        </div>
    </div>

@endsection
<script>
    window.load=checkSiteisLive();
            function checkSiteisLive() {
                setInterval(function () {
                    $.ajax({
                        url:'check-site',
                        type:'GET',
                        success:function(data)
                        {
                            if(data=='success')
                            {
                                location.href= '{{ url('user/login') }}';
                            }
                        }
                    })
                }, 30000);
            }
</script>