@include('partials.functions')
@extends('admin.home')

@section('title', 'Dashboard Exclusion')


<style>

    .dashboards-permission td:nth-child(1), .dashboards-permission th:nth-child(1) {
        width: 14%;
    }
    .dashboards-permission td:nth-child(2), .dashboards-permission th:nth-child(2) {
        width: 14%;
    }

    .dashboards-permission td:nth-child(4), .dashboards-permission th:nth-child(4) {
        width: 5%;
    }

    .permissions_data .dashboard_name {
        padding: 1px;
    }

    .permissions_data .checkbox-data {
        padding: 9px;
    }

    .dashboard-list {
        float: left;
        margin: 0 25px 10px 0;
        padding: 5px;
    }


</style>
@section('content')
    <div id="content-wrapper" class="container">

        <div class="row" style="margin:2px  auto">
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
            <h3 class="text-center">If you are Required to Remove a Ward from a Dashboard Calculation then Please Tick the Dashboard for that Ward</h3>
            {!! Form::open(array('class' => 'inline_form','method'=>'post','url' =>'admin/dashboards-permission/dashboard-permission')) !!}
            <div class="panel panel-default ">

                <table class="table dashboards-permission table-striped table-bordered col-md-12">

                    <tr>
                        <th class="text-center">Ward</th>
                        <th class="text-center">Specialty</th>
                        <th class="text-center">Dashboards</th>

                        <th class="text-center"></th>
                    </tr>

                    @foreach($ward_list as $list)

                        <tr class="permissionclass">
                            <td class="text-center">{{$list->ward_name}}</td>
                            <td class="text-center">
                                {!! Form::select('specialty',[""=>"Choose Speciality"]+ ['Medical' => 'Medical','Surgical' => 'Surgical','Maternity' => 'Maternity','Critical Care'=>'Critical Care','Other'=>'Other'], $list->{'ward type'}, array('class' => 'form-control speciality')) !!}
                            </td>

                            <td class="text-center permissions_data">


                                @foreach($dashboard_lists as $dashboard_list)

                                    @if($list->id == $dashboard_list->ward_id)
                                        <span class="dashboard-list">
                                            @if($dashboard_list->is_set==null)
                                                {!! Form::checkbox('dashboard_name[]', $dashboard_list->dashboard_id,false, array('class' => 'dashboard_name radio-custom speciality_checkbox')) !!}
                                            @else

                                                {!! Form::checkbox('dashboard_name[]', $dashboard_list->dashboard_id,true, array('class' => 'dashboard_name radio-custom speciality_checkbox')) !!}
                                            @endif
                                            <span class="dashboard-name">{{$dashboard_list->dashboard_name}}</span>
                                    </span>
                                    @endif


                                @endforeach
                            </td>
                            <td>
                                {!! Form::hidden('ward_id', $list->id) !!}
                                {!! Form::button('UPDATE', array('class' => 'setpermission btn btn-small btn-warning btn-sm', 'id' => 'delete_all','data-ward_id'=>$list->id,'data-permissions_id'=>$dashboard_list->dashboard_id)) !!}
                            </td>


                        </tr>
                    @endforeach
                    {!!  Form::close() !!}

                </table>
            </div>
        </section>


    </div>

@endsection

@section('footer')
    @parent
    <script src="{{ url('js/wardround/bootstrap-datetimepicker.min.js') }}"></script>


    <script>

        jQuery(document).ready(function (e) {

            $(".setpermission").click(function (e) {

                $(this).html('<img src="../images/loader-small.gif">');
                var token = "{{csrf_token()}}";
                var ward_id = $(this).attr('data-ward_id');

                var dashboards_permissions_id = []
                var speciality = $(this).parent().parent().find(".speciality option:selected").val();


                $(this).parent().parent().find(("input[name='dashboard_name[]']:checked")).each(function () {
                    dashboards_permissions_id.push(parseInt($(this).val()));
                });


                $.ajax({

                    url: "<?=URL::to('/admin/dashboards-permission/dashboard-permission')  ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {"ward_id": ward_id, "_token": token, "dashboards_permissions_id": dashboards_permissions_id,"speciality":speciality},
                    success: function (data) {
                        window.location.reload();


                    }
                });
            });
        });

    </script>



@endsection