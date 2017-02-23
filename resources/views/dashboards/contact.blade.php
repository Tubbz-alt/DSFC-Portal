@extends('master')
@section('page-title', 'Reference Library Portal')
@section('title', 'Dashboards')

@section('header')
    @parent
@endsection

@section('content')
	<div id="content-wrapper" class="container-fluid">
        <div class="container">
            <div class="contact-form col-md-6 col-md-offset-3">
                <div id="success" class="col-xs-12 col-md-12" style="padding: 0px;">
                    @if (Session::has('success'))
                        <div class='alert alert-success'>{{ Session::get('success') }}</div>
                    @endif

                </div>
                {!! Form::open(array('url' => '/dashboard/contact-us/store', 'method' => 'POST')) !!}

                <div class = "form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', 'Your Name') !!}
                    {!! Form::text('name', null, array('required', 'class'=>'form-control',  'placeholder'=>trans('Your Name'))) !!}
                    @foreach($errors->get('name') as $message)
                        <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>

                <div class = "form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', 'Your E-mail Address') !!}
                    {!! Form::text('email', null,  array('required',  'class'=>'form-control',  'placeholder'=>trans('Your E-mail Address'))) !!}
                    @foreach($errors->get('email') as $message)
                        <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
                <div class="form-group">
                    {!! Form::label('message', 'Your Message') !!}
                    {!! Form::textarea('message', null,  array('required', 'class'=>'form-control', 'placeholder'=>trans('Your Message'))) !!}
                </div>
                <div class=" form-group">

                    {!! Form::submit('Contact Us!', array('class' => 'btn btn-info')) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>

	</div>

    <div id="zenbox_tab" data-toggle="modal" data-target="#myModalNorm"></div>

    <!-- Modal -->
    <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        How can we help you?
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <fieldset class="body">

                        <label for="subject">Summary<abbr title="Required">*</abbr></label><input id="subject" maxlength="150" name="subject" placeholder="Briefly describe your feedback" required="required" title="Please fill out this field." type="text"><div class="validation error" id="subject_errors">&nbsp;</div>
                        <label for="description">Details<abbr title="Required">*</abbr></label><textarea id="description" name="description" placeholder="Fill in the details here. If you're reporting a bug tell us how to recreate it." required="required" rows="6" title="Please fill out this field."></textarea><div class="validation error" id="description_errors">&nbsp;</div>
                        <div class="two_across">
                            <div>
                                <label for="name">Name<abbr title="Required">*</abbr></label><input id="name" name="name" required="required" title="Please fill out this field." type="text"><div class="validation error" id="name_errors">&nbsp;</div>
                            </div>
                            <div><label for="email">Your email address<abbr title="Required">*</abbr></label><input data-type="email" id="email" name="email" required="required" title="Please fill out this field." type="email"><div class="validation error" id="email_errors">&nbsp;</div></div>
                        </div>


                        <input id="locale_id" name="locale_id" value="1" type="hidden">
                        <input id="set_tags" name="set_tags" value="dropbox" type="hidden">
                        <input id="via_id" name="via_id" value="17" type="hidden">
                        <input id="client" name="client" value="Client: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0" type="hidden">
                        <input id="submitted_from" name="submitted_from" value="https://data.england.nhs.uk/" type="hidden">
                        <input id="ticket_from_search" name="ticket_from_search" value="" type="hidden">

                        <div id="privacy_policy_link">

                        </div>
                    </fieldset>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>

                    <button type="button" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('footer')
	@parent
@endsection
