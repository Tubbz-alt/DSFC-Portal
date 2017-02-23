@extends('admin.home')
@section('title', 'Create QD Dropdown')
@section('content')
    <div id="content-wrapper" class="container">
        <div class="section-header">
            <h1>Create QD Dropdown Field</h1>
        </div>
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
        <div class="col-md-6" style="padding: 20px;">
            {!! Form::open(array('method'=>'post','url' => 'admin/qddropdown')) !!}
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    @if (Session::has('message'))
                        <div class='alert alert-warning'>{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 col-xs-12" style="padding: 10px 65px;">
                    {!! Form::label('name', 'Name') !!}
                </div>
                <div class="col-md-10 col-xs-12">
                    {!! Form::text('name', '', array('class' => 'form-control','autocomplete' => 'off')) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12 text-right">
                    {!! Form::submit('CREATE', array('class' => 'btn btn-primary btn-sm')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footer')
    @parent
@endsection
