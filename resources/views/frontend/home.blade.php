@extends('frontend-master')

@section('title', 'Home Page')

@section('header')
	@parent
	<link rel="stylesheet" href="{{ url('css/frontend/home.css') }}">
@endsection

@section('content')
	<div id="header_outer">
		<header class="clearfix">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-md-7">
						<h2>A Data Catalogue for <span>DSFC</span></h2>
					</div><!--col-sm-9-->
					<div class="col-sm-2 col-md-2 pull-right">
						<h1 id="logo" class="pull-right"><a href=""><img src="images/logo_home.png" alt="" class="img-responsive"></a></h1>
					</div><!--col-md-3-->
				</div><!--row-->
			</div><!--container-->
		</header><!--header-->

		<div id="nav_outer" class="clearfix">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- Docs master nav -->
						<div class="navbar bs-docs-nav navbar-static-top" id="top">
							<div class="navbar-header">
								<button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle" data-target="javascript:void(0)bs-navbar" data-toggle="collapse" type="button">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<p class="navbar-brand visible-xs">Navigation</p>
							</div>

							<nav class="collapse navbar-collapse" id="bs-navbar">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.html">Home</a></li>
									<li><a href="javascript:void(0)">Datasets</a></li>
									<li><a href="javascript:void(0)">Publishers</a></li>
									<li><a href="javascript:void(0)">Collections</a></li>
									<li><a href="javascript:void(0)">About</a></li>
									<li><a href="javascript:void(0)">Howto</a></li>
									<li><a href="javascript:void(0)">Directory</a></li>
									<li><a href="javascript:void(0)">Help</a></li>
								</ul>
								<ul class="nav navbar-nav navbar-right">
									<li><a href="{{url('user/login')}}">Log in</a></li>
									<li><a href="{{url('user/signup')}}">Register</a></li>
								</ul>
							</nav>
						</div>
					</div><!--col-sm-12-->
				</div><!--row-->
			</div><!--container-->
		</div><!--nav_outer-->
	</div><!--header_outer-->


	<div class="container">
		<div id="banner">
			<div class="row">
				<div class="col-md-12">
					<h2>Find and explore the data used by DSfC to conduct its core business</h2>
					<div id="search_block">
						<form action="" method="get">
							<input name="" type="search" value="" placeholder="Search 1260 datasets..."/>
							<input name="" type="submit" value="Search">
						</form>
					</div><!--search_block-->

					<div id="banner_tag" class="clearfix">
						<h6>Popular Tags</h6>
						<ul>
							<li><a href="javascript:void(0)">Statistics</a></li>
							<li><a href="javascript:void(0)">prescibing</a></li>
							<li><a href="javascript:void(0)">statistics</a></li>
						</ul>
					</div><!--banner_tag-->
				</div><!--col-sm-12-->
			</div><!--row-->
		</div><!--banner-->

		<div id="home_content" class="clearfix">
			<div class="row">
				<div class="col-sm-9 col-md-9">
					<div class="content_box_block clearfix">
						<h2>Featured Datasets</h2>
						<div class="row">
							<div class="col-md-4">
								<div class="featured_data">
									<h6>HSCIC</h6>
									<h3><a href="javascript:void(0)">QOF - Quality Outcomes Framework - 2013-14</a></h3>
									<p>Quality and Outcomes Framework (QOF) recorded prevalence, achievement and exceptions data 2013-14.</p>
									<a href="javascript:void(0)" class="view">View this dataset</a>
								</div><!--featured_data-->
							</div><!--col-md-4-->
							<div class="col-md-4">
								<div class="featured_data">
									<h6>Organization Data Service</h6>
									<h3><a href="javascript:void(0)">ODS - NHS Trusts and Sites</a></h3>
									<p>Current and closed DSfC Trusts, including code, name, address, Health Authority code, and start and end dates.</p>
									<a href="javascript:void(0)" class="view">View this dataset</a>
								</div><!--featured_data-->
							</div><!--col-md-4-->
							<div class="col-md-4">
								<div class="featured_data">
									<h6>HSCIC</h6>
									<h3><a href="javascript:void(0)">NHSOF - 5.1 Patient safety incidents</a></h3>
									<p>For each of a CCG's five main providers, this indicator shows the rate of patient safety incidents per 1,000 total provider bed days.</p>
									<a href="javascript:void(0)" class="view">View this dataset</a>
								</div><!--featured_data-->
							</div><!--col-md-4-->
						</div><!--row-->
					</div><!--content_box_block-->

					<div class="content_box_block clearfix">
						<h2>Featured Collections</h2>
						<div class="row">
							<div class="col-md-4">
								<div class="featured_data">
									<h6>56 datasets</h6>
									<h3><a href="javascript:void(0)">A&E Attendances and Emergency Admissions</a></h3>
									<p>The Weekly A&E Attendances and Emergency Admissions collection collects the total number discharged, admitted or transferred within four hours of arrival.</p>
									<a href="javascript:void(0)" class="view">View this collection</a>
								</div><!--featured_data-->
							</div><!--col-md-4-->
							<div class="col-md-4">
								<div class="featured_data">
									<h6>29 datasets</h6>
									<h3><a href="javascript:void(0)">Cancer Waiting Times</a></h3>
									<p>National statistics on the waiting times of people referred by their GP with suspected cancer or breast symptoms and those subsequently diagnosed with and treated for cancer by the DSfC.</p>
									<a href="javascript:void(0)" class="view">View this collection</a>
								</div><!--featured_data-->
							</div><!--col-md-4-->
							<div class="col-md-4">
								<div class="featured_data">
									<h6>87 datasets</h6>
									<h3><a href="javascript:void(0)">DSfC Outcomes Framework</a></h3>
									<p>The DSfC Outcomes Framework indicators form part of the DSfC Outcomes Framework. These indicators have been designed to provide national-level accountability.</p>
									<a href="javascript:void(0)" class="view">View this collection</a>
								</div><!--featured_data-->
							</div><!--col-md-4-->
						</div><!--row-->
					</div><!--content_box_block-->

				</div><!--col-md-9-->
				<div class="col-sm-3 col-md-3">
					<div id="home_right_block">
						<h5>Publishers</h5>
						<div id="Publish_list">
							<ul>
								<li><a href="javascript:void(0)">DSfC Digital</a></li>
								<li><a href="javascript:void(0)">DSfC></li>
								<li><a href="javascript:void(0)">ONS</a></li>
								<li><a href="javascript:void(0)">See all publishers</a></li>
							</ul>
						</div><!--Publish_list-->
					</div><!--home_right_block-->
				</div><!--col-md-3-->
			</div><!--row-->
		</div><!--home_content-->
	</div><!--container-->

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="f_nav" class="clearfix">
						<ul>
							<li>&copy; DSfC 2016</li>
							<li><a href="javascript:void(0)">Terms &amp; Conditions</a></li>
							<li><a href="javascript:void(0)">Privacy &amp; Cookies</a></li>
							<li><a href="javascript:void(0)">Social Media &amp; Comment Moderation</a></li>
							<li><a href="javascript:void(0)">Accessibility</a></li>
						</ul>
					</div><!--f_nav-->
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--container-->
	</footer>
	<div id="site_footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>A Data Catalogue for DSfC</h2>
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--container-->
	</div><!--site_footer-->

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

<script src="{{ url('js/all.js') }}"></script>
<script type="text/javascript">

	$(document).ready(function () {
		$('#zenbox_tab').on('click', function (e) {


		});


	});


</script>
