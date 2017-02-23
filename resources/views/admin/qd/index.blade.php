@extends('admin.home')

@section('title', 'QD Dropdown')

@section('content')
    <div id="content-wrapper" class="container">
        <section class="col-sm-12">
            <div class="section-header">
                <h1>QD Dropdown</h1><br>
            </div>
            <a id="btn_style" href="{{url('admin/qddropdown/create')}}" class='btn btn-primary btn-sm'>Create New</a>
        </section>
        <!-- error or success message -->
        <div class="row">
            <div class="col-xs-12 col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div id="success">
                    @if (Session::has('success'))
                        <div class='alert alert-success'>{{ Session::get('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <section class="col-xs-12 table-responsive">
            <div class="panel panel-default row">
                <table class="table table-striped table-bordered col-md-12">
                    @if(count($qd)>0)
                        <thead class="thead-inverse">
                        <tr>
                            <th style="width: 8%; font-size: 1.2em;"><label id="select_all">
                                    {!! Form::checkbox('check_all_groups', 'value', null, ['id' => 'check_all_groups'])!!}
                                    SELECT ALL
                                </label>
                            </th>
                            <th class="text-center" style=" width: 76%;  font-size: 1.2em;">QD Name</th>
                            <th class="text-center" style=" font-size: 1.2em;"> Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($qd as $data => $value)
                            <tr>
                                <th scope="row"> <!-- checkbox to each group (to select the purticular records -->
                                    {!! Form::checkbox('group_list[]', $value->id, null, ['class' => 'group_list'])!!}

                                    <span style="padding: 0 0 0 37px; ">{{$i}}</span></th>
                                <td>{{ $value->qd_dropdown_name }}</td>
                                <td><a class="btn btn-small btn-info btn-sm"
                                       href="{{ URL::to('admin/qddropdown/'.$value->id.'/edit') }}">Edit</a>

                                    <!-- delete the group (uses the destroy method DESTROY /group/{id} -->
                                    {!! Form::open(array('class' => 'inline_form','method'=>'DELETE','url' =>'admin/qddropdown/'.$value->id)) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-small btn-warning btn-sm')) !!}
                                    {!!  Form::close() !!}
                                </td>

                            </tr>
                            <?php $i++;?>
                        @endforeach
                        <tr>
                            <td colspan="4">
                                {!! Form::open(array('method'=>'POST', 'url' =>'admin/qddropdown/delete-all','id' => 'delete_wrapper_form')) !!}
                                {!! Form::submit('Delete All', array('class' => 'btn btn-small btn-warning btn-sm', 'id' => 'delete_all_items')) !!}
                                {!!  Form::close() !!}
                            </td>
                        </tr>
                        </tbody>

                        <!-- endfor loop -->

                @else<!-- else if here -->
                    <!-- put a tr with a message called "Sorry no records found!" -->
                    <tr><h4 class="text-center">"Sorry no records found!"</h4></tr>
                @endif<!-- end if here -->
                </table>


            </div>
        </section>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        jQuery(document).ready(function ($) {
            $('#delete_all_items').click(function (evnt) {
                evnt.preventDefault();
                var ids = [];
                var token_element = document.getElementsByName('_token');
                var form_token = $(token_element).val();
                if ($('.group_list:checked').length > 0) {
                    $('.group_list:checked').each(function (index, value) {
                        ids[index] = $(value).val();
                    });
                    //****************** ajax code started ******************//
                    $.ajax({
                        method: "POST",
                        url: "qddropdown/delete-all",
                        data: {'ids': ids, '_token': form_token}
                    })
                            .done(function (msg) {
                                if (msg == "true") {
                                    location.reload();
                                }
                            });
                }
                else {
                    alert("Please select a row")
                }


            });
        });
    </script>
    <script src="{{ url('js/groups/index.js') }}"></script>
    <script src="{{ url('js/common.js') }}"></script>

@endsection