@include('partials.functions')
@extends('admin.home')

@section('title', 'Board Round')


<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">


<style>

    .contactus {
        background: #ffffff none repeat scroll 0 0;
        box-shadow: 0 20px 11px -6px #ccc;
        float: left;
        margin-bottom: 60px;
        margin-top: 20px;
        padding: 20px 20px 10px;
    }

    .loader-bg {
        background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
        height: 100%;
        position: absolute;
        width: 100%;
        z-index: 1000;

    }
</style>
@section('content')
    <div id="content-wrapper" class="container">




        <div class="row" style="margin:50px  auto">
            <div class="col-xs-12 col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div id="success" class="col-xs-12 col-md-12">
            @if (Session::has('success'))
                <div class='alert alert-success'>{{ Session::get('success') }}</div>
            @endif
        </div>
        <section class="col-sm-12 table-responsive">
            <div class="panel panel-default ">
                <table class="table table-striped table-bordered col-md-12">
                    @if(count($ward_round_data)>0)
                        <tr>


                            <th class="text-center">User Name</th>
                            <th class="text-center">Ward Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Role</th>
                            <th class="text-center col-md-3">Visited Time</th>
                            <th class="text-center"></th>
                            <th class="text-center" colspan="2">Set Timer(Hours)</th>
                            <th class="text-center"></th>


                        </tr>
                        <!-- Started Loop for fetching records from DB (for loop) -->
                        @foreach($ward_round_data as $value)
                            <tr>

                                <td>{{ $value->username }}</td>
                                <td>{{ ward_value($value->ward_name)}}</td>
                                @if($value->status==0)
                                    <td>Completed</td>
                                @else
                                    <td>Reset</td>

                                @endif
                                <td>{{ $value->role }}</td>
                                <td>{{date("j F-  h:i A", strtotime($value->updated_at))}}</td>

                                <td class="col-md-1">
                                @if($value->status==0)
                                        <div id="ward_round_data" class="btn btn-danger"
                                             onclick="ward_round(0,'{{csrf_token()}}','{{ $value->id}}','{{$value->ward_name}}')">Reset

                                        </div>
                                @else

                                @endif

                                <td class="col-md-1">
                                    <div id="datetimepicker"  class="input-append time datetimepicker">

                                        <input type="number" class="col-md-8 set_timer form-control" size="20"
                                               style="font-size:13px;height:30px;width: 55px;" value="{{ $value->set_time }}"></input>

                                    </div>
                                </td>
                                <td> <a class="btn btn-primary btn-sm settime" data-ward-name="{{ $value->ward_name }}" data-wardid="{{ $value->id}}">Set</a></td>

                                </td>

                                <td class="text-center">
                                    <a class="btn btn-primary view-more" data-ward-name="{{ $value->ward_name }}" >View History
                                    </a>
                                </td>



                            </tr>
                        @endforeach

                    @else
                        <tr><h4 class="text-center">Sorry!! No records found</h4></tr>
                    @endif
                </table>
            </div>
        </section>


    </div>
    <!-- Modal -->
    <div id="ward-clicks" class="modal fade col-md-6 col-md-offset-3" role="dialog" style="background-color:transparent;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header commentstitlebox">
                </div>
                <div class="modal-body" id="wardlist">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
   <script src="{{ url('js/wardround/bootstrap-datetimepicker.min.js') }}"></script>


    <script>

        jQuery('.settime').on('click', function(e) {
            var set_time =  $(this).parent().parent().find('.set_timer').val();

            if(set_time==''){
                alert("Please Set Time")
            }
            else{


            var ward_id =   $(this).attr('data-wardid');
            var ward_name =   $(this).attr('data-ward-name');
            var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: '{{url("/admin/ward-round/set-timer")}}',
                    data: {"set_time": set_time,"ward_id": ward_id,"ward_name":ward_name,"_token": token},
                    cache: false,
                    success: function (msg) {

                    }
                });
            }

            });



        $(function() {
            $('.datetimepicker').datetimepicker({
                clearBtn: true,
                pickDate: false,
                pickSeconds: false,
                pickMinutes: false,
                format: 'hh',
                language: 'pt-BR'
            });
        });



        function ward_round(str, token, id,ward_name) {
            var token = token;
            var status = str;
            var id = id;
            var ward_name = ward_name;
            $.ajax({
                url: '{{url("/admin/ward-round/ward-round-status")}}',
                type: 'POST',
                data: {"status": status, "_token": token, "id": id,"ward_name":ward_name},
                success: function (data) {

                    /*   if(data==1){
                     $('#ward_round_data').removeClass("btn-primary").addClass("btn-warning");


                     }else{
                     $('#ward_round_data').removeClass("btn-warning").addClass("btn-primary");


                     }*/
                    window.location.reload();
                }
            });
        }
        jQuery('.view-more').on('click', function(e) {
            var ward_name = $(this).attr('data-ward-name');
            var element=$(this);
            $(this).html('<img src="../images/loader-small.gif">');
            $.ajax({
                url: '{{url("/admin/ward-round/ward-click")}}',
                type: 'GET',
                data: {"status": ward_name},
                success: function (data) {
                    element.html('View history');
                    $('#wardlist').html(data);
                    $("#ward-clicks").modal('show');
                }
            });
        });

    </script>



@endsection