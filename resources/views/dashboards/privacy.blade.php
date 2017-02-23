@extends('master')
@section('page-title', 'Reference Library Portal')
@section('title', 'Dashboards')

@section('header')
    @parent
@endsection

@section('content')
	<div id="content-wrapper" class="container-fluid">
        <div class="container">
            <div>
                <h2>Cookie Information What is a cookie?</h2>
                <div class="row">
                    <!--<div class="col-md-4 cookie-diagram">
                        <img src="{{url('images/cookie.jpg')}}" height="260px">
                    </div>-->
                    <div class="col-md-8">
                        <p align="justify">Most websites you visit will use cookies in order to improve your user experience by enabling that website to ‘remember’ you, either for the duration of your visit (using a ‘session cookie’) or for repeat visits (using a ‘persistent cookie’).Cookies do lots of different jobs, like letting you navigate between pages efficiently, storing your preferences, and generally improving your experience of a website.</p><p align="justify">Cookies make the interaction between you and the website faster and easier. If a website doesn’t use cookies, it will think you are a new visitor every time you move to a new page on the site &ndash; for example, when you enter your login details and move to another page it won’t recognize you and it won’t be able to keep you logged in.</p><p align="justify"> Some websites will also use cookies to enable them to target their advertising or marketing messages based for example, on your location and/or browsing habits.Cookies may be set by the website you are visiting (‘first party cookies’) or they may be set by other websites who run content on the page you are viewing (‘third party cookies’).</p>
                    </div>
                </div>
                <h4>What is in a cookie?</h4><div><p align="justify">A cookie is a simple text file that is stored on your computer or mobile device by a website’s server and only that server will be able to retrieve or read the contents of that cookie. Each cookie is unique to your web browser. It will contain some anonymous information such as a unique identifier and the site name and some digits and numbers. It allows a website to remember things like your preferences or what’s in your shopping basket.</p></div><h4>What to do if you don’t want cookies to be set</h4><div><p align="justify">Some people find the idea of a website storing information on their computer or mobile device a bit intrusive, particularly when this information is stored and used by a third party without them knowing. Although this is generally quite harmless you may not, for example, want to see advertising that has been targeted to your interests. If you prefer, it is possible to block some or all cookies, or even to delete cookies that have already been set; but you need to be aware that you might lose some functions of that website.</p></div>
                <a href="{{url('dashboard/privacy/more')}}" style="background: #ffff3d;text-decoration: none;font-weight: bold;"> Find out more.</a>
                <h4>First party cookies</h4><div><p align="justify">First party cookies are set by the website, you are visiting and they can only be read by that site.</p></div><h4>Third party cookies</h4><div><p align="justify">Third party cookies are set by a different organization to the owner of the website you are visiting. For example, the website might use a third party analytics company who will set their own cookie to perform this service. The website you are visiting may also contain content embedded from, for example YouTube or Flickr, and these sites may set their own cookies. More significantly, a website might use a third party advertising network to deliver targeted advertising on their website. These may also have the capability to track your browsing across different sites.</p></div><h4>Session cookies</h4><div><p align="justify">Session Cookies are stored only temporarily during a browsing session and are deleted from the user’s device when the browser is closed.</p></div><h4>Persistent cookies</h4><div><p align="justify">This type of cookie is saved on your computer for a fixed period (usually a year or longer) and is not deleted when the browser is closed. Persistent cookies are used where we need to know who you are for more than one browsing session. For example, we use this type of cookie to store your preferences, so that they are remembered for the next visit.</p></div><h4>Flash cookies</h4><div><p align="justify">Many websites use Adobe Flash Player to deliver video and game content to their users. Adobe utilize their own cookies, which are not manageable through your browser settings but are used by the Flash Player for similar purposes, such as storing preferences or tracking users. Flash Cookies work in a different way to web browser cookies (the cookie types listed above are all set via your browser); rather than having individual cookies for particular jobs, a website is restricted to storing all data in one cookie. You can control how much data can be stored in that cookie but you cannot choose what type of information is allowed to be stored</p></div>
                <a href="{{url('dashboard/privacy/more')}}" style="background: #ffff3d;text-decoration: none;font-weight: bold;"> Find out how to manage cookies.</a>
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
