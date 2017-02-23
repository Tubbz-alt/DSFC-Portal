@extends('master')

@section('title', 'Dashboards')

@section('header')
    @parent
@endsection

@section('content')
	<div id="content-wrapper" class="container-fluid">
        <div class="container">
            <div>
                <h2>
                    How can I control cookies?
                </h2>
                <h4>Web browser cookies</h4><div><p align="justify">If you don’t want to receive cookies, you can modify your browser so that it notifies you when cookies are sent to it or you can refuse cookies altogether. You can also delete cookies that have already been set. If you wish to restrict or block web browser cookies which are set on your device then you can do this through your browser settings; the Help function within your browser should tell you how. Alternatively, you may wish to visit www.aboutcookies.org, which contains comprehensive information on how to do this on a wide variety of desktop browsers.</p></div> <h4>Adobe Flash Player Cookies</h4><div><p align="justify">The Adobe Flash Player, used to provide services such as iPlayer through web browsers or web-based games, is also capable of storing information on your device. However, these cookies cannot be controlled through your web browser. Some web browser manufacturers are developing solutions to allow you to control these through your browser, but at the present time, if you wish to restrict or block Flash Cookies, then you must do this on the Adobe website. Please be aware that restricting the use of Flash Cookies may affect the features available to you, for example, the auto resume feature in BBC iPlayer.</p> </div><h4>Do Not Track (DNT) browser setting</h4><div><p align="justify"> DNT is a feature offered by some browsers which, when enabled, sends a signal to websites to request that your browsing is not tracked, such as by third party ad networks, social networks and analytic companies A uniform standard has not yet been adopted to determine how DNT requests should be interpreted and what actions should be taken by websites and third parties. Intelligent Health UK will continue to review DNT and other new technologies and may adopt a DNT standard once available.</p></div><h4>Third party cookies </h4><div><p align="justify"> We sometimes embed photos and video content from websites such as flickr and YouTube. Pages with this embedded content may present cookies from these websites. Similarly, when you use one of the share buttons on the Intelligent Health website, a cookie may be set by the service you have chosen to share content through. Intelligent Health does not control the dissemination of these cookies and this tool will not block cookies from those websites. You should check the relevant third party website for more information about these.</p></div> <h4>Mobile device and TV apps</h4> <div><p align="justify">On devices such as mobile phones, tablets and smart TVs, instead of cookies, information collected from or stored to your device may be used to ‘remember’ you or provide you with the content you have requested.</p></div><h4>Similar technologies to cookies</h4><div><p align="justify">When you view websites or emails, technologies that are similar to cookies may be set to analyze and understand how the website is used and whether the email has been read.</p></div>
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
