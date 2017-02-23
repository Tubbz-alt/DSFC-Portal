<style>
    #myModalNorm .modal-footer {

        margin-top: -35px !important;

    }
</style>

   <div id="zenbox_tab" data-toggle="modal" data-target="#myModalNorm"></div>
   
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
                    <div id="success" class="col-xs-12 col-md-12" style="padding: 0px;">
                        @if (Session::has('success'))
                            <div class='alert alert-success'>{{ Session::get('success') }}</div>
                        @endif

                    </div>
                    {!! Form::open(array('url' => '/dashboard/contact-us/store-feedback', 'method' => 'POST')) !!}
                    <fieldset class="body">

                        <label for="subject">Summary</label>
                        <input id="subject" maxlength="150" name="subject" placeholder="Briefly describe your feedback" required="required" title="Please fill out this field." type="text"><div class="validation error" id="subject_errors">&nbsp;</div>
                        <label for="description">Details</label>
                        <textarea id="description" name="description" placeholder="Fill in the details here. If you're reporting a bug tell us how to recreate it." required="required" rows="6" title="Please fill out this field."></textarea><div class="validation error" id="description_errors">&nbsp;</div>

                        <label for="title">Title</label>
                        <input id="title" maxlength="150" name="title" value="@yield('page-title')" placeholder="@yield('page-title')" required="required" title="Please fill out this field." type="text" readonly>
                        <div class="validation error" id="title_errors">&nbsp;</div>
                        <label for="url">URL</label>
                        <input id="url" maxlength="150" name="url" value="{{Request::url()}}" placeholder=" {{Request::url()}}" required="required" title="Please fill out this field." type="text" readonly>
                        <div class="validation error" id="url_errors">&nbsp;</div>


                        <div class="two_across">
                        <div>
                         <label for="name">Name</label>
                            <input id="name" name="name" required="required" title="Please fill out this field." type="text"><div class="validation error" id="name_errors">&nbsp;</div>
                        </div>

                        <div>
                            <label for="email">Your email address</label>
                            <input data-type="email" id="email" name="email" required="required" title="Please fill out this field." type="email"><div class="validation error" id="email_errors">&nbsp;</div></div>
                        </div>



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

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>	