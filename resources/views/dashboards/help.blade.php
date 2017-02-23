@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
    @parent

    <link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">
    <style>

        .tabBlock-content {

            margin-top: -71px !important;
        }
    </style>


@endsection
@section('title', 'Csv Data')
@section('content')
    <div class="file-data-loader">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading.gif') }}">
        </span>

    </div>
    <div  class="container">

        <div class="tabBlock">

            <ul class="tabBlock-tabs datachallenge-info">

                <li class="tabname tabBlock-tab set-tab is-active">Database tab </li>
                <li class="tabname tabBlock-tab set-tab ">A&E</li>
                <li class="tabname tabBlock-tab set-tab ">Inpatient </li>
                <li class="tabname tabBlock-tab set-tab ">Outpatient </li>


            </ul>
            <div class="tabBlock-content" >
                <div class="tabBlock-pane">
                    <table class="table table-striped table-bordered helpdata">
                        <thead>
                        @if(count($help_definitions_data)>0)
                            <tr>

                                <th class="text-center">Tab name</th>
                                <th class="text-center">Object Name</th>
                                <th class="text-center">Object Description</th>





                            </tr>
                        </thead>
                        <tbody id="databasfilterdata">
                        <!-- Started Loop for fetching records from DB (for loop) -->
                        @foreach($help_definitions_data as $data => $tables)


                            <tr>

                                <td class="text-center">{{ $tables->helpTabName }}</td>
                                <td class="text-center">{{ $tables->objectName }}</td>
                                <td class="text-center">{{ $tables->objectDescription }}</td>





                            </tr>
                        @endforeach
                        </tbody>
                        @else
                            <tr><h4 class="text-center">Sorry!! No records found</h4></tr>
                        @endif
                    </table>

                </div>
                <div class="tabBlock-pane"></div>
                <div class="tabBlock-pane"></div>
                <div class="tabBlock-pane"></div>


            </div>




        </div>
        </div>



        @endsection


        @section('footer')
            @parent

            <script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
            <script src="{{ url('js/users/index.js') }}"></script>
            <script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ url('js/filter/jquery.filtertable.min.js') }}"></script>
            <script src="{{ url('js/filter/jquery.hideseek.min.js') }}"></script>
            <script src="{{ url('js/filter/initializers.js') }}"></script>
            <script src="{{ url('js/jquery.validate.min.js') }}"></script>
            <script src="{{ url('js/alert.js') }}"></script>
            <script>


                $(document).ready(function () {

                    setTimeout(function () {
                        $(".file-data-loader").hide();
                    }, 3000);

                    @if(count($help_definitions_data)>0)
                      $('.helpdata').DataTable({
                        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                        "bPaginate": true,
                        "searching": true,

                        "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                        "bFilter": false,
                        "bInfo": false,
                        "bAutoWidth": false,

                        columnDefs: [{
                            targets: "_all",
                            orderable: false
                        }],
                        oLanguage: {
                            sLengthMenu: "_MENU_",
                        },






                    });
                    @endif

                });
            </script>

@endsection