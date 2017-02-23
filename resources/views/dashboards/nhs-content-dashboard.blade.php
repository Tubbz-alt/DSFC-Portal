@extends('content-master')

@section('title', 'DSfC')

@section('header')
	@parent
	<link rel="stylesheet" type="text/css" href="{{url('css/content-style.css')}}">
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="home_content_head" class="clearfix">
					<div id="avatar"><img src="../images/logo-content.png" alt="" class="img-responsive"></div>
					<h2>DSfC</h2>
					<h5>Open Source projects from DSfC</h5>
					<div id="head_location">
						<ul>
							<li class="location">England</li>
							<li class="web"><a href="http://england.nhs.uk">http://england.nhs.uk</a></li>
						</ul>
					</div>
				</div><!--home_content_head-->
			</div><!--col-md-12-->
		</div><!--row-->
	</div><!--container-->

	<div id="tab_block_outer" class="clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="tab_list" class="clearfix">
						<ul>
							<li class="active"><a href="#" class="repositories">Repositories</a></li>
							<li><a href="javascript:void(0)" class="people">People</a></li>
						</ul>
					</div><!--tab_list-->

					<div class="row">
						<div class="col-md-8">

							<div id="tab_search_outer" class="clearfix">
								<div class="tab_search_list">
									<ul>
										<li><a href="javascript:void(0)">Filters</a>
											<ul>
												<li class="sources"><a href="javascript:void(0)">Sources</a></li>
												<li class="forks"><a href="javascript:void(0)">Forks</a></li>
											</ul>
										</li>
									</ul>
								</div><!--tab_search_list-->
								<div id="tab_search">
									<form action="" method="get">
										<input name="" type="search" value="" placeholder="Find a repository…"/>
									</form>
								</div><!--tab_search-->
							</div><!--tab_search_outer-->

							<div class="content_list">
								<ul>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">publish-o-matic</a></h3>
												<p>Updated 9 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													Python
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">0</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">ckanext-nhsengland</a></h3>
												<p>DSfC CKAN skin</p>
												<p>Updated 12 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													HTML
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">3</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">iit-infrastructure</a></h3>
												<p>Deployment and infrastructure automation for data.england.nhs.uk</p>
												<p>Updated 9 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													Python
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">0</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">datadirectory</a></h3>
												<p>Source code for the DSfC Data Directory</p>
												<p>Updated 9 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													Python
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">0</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">publish-o-matic</a></h3>
												<p>Updated 9 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													Python
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">0</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="#">ICTAzureAutomation</a></h3>
												<p>For public, MIT Licensed Azure Automation scripts from DSfC</p>
												<p>Updated on May 17</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													PowerShell
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">3</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">iit-infrastructure</a></h3>
												<p>Deployment and infrastructure automation for data.england.nhs.uk</p>
												<p>Updated 9 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													Python
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">0</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
									<li class="clearfix">
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<h3><a href="javascript:void(0)">datadirectory</a></h3>
												<p>Source code for the DSfC Data Directory</p>
												<p>Updated 9 days ago</p>
											</div><!--col-md-8-->
											<div class="col-sm-4 col-md-4">
												<div class="repo_list_stats">
													Python
													<a href="javascript:void(0)" class="repo_list star">0</a>
													<a href="javascript:void(0)" class="repo_list forks">0</a>
												</div>
											</div><!--col-md-4-->
										</div><!--row-->
									</li>
								</ul>
							</div><!--content_list-->
						</div><!--col-md-8-->

						<div class="col-md-4">
							<div class="simple_box clearfix">
								<h4><a href="javascript:void(0)">People</a></h4>
								<div class="member_avatar_group">
									<a href="javascript:void(0)">
										<span class="avatar"><img src="../images/avatar.jpg" alt="" class="img-responsive"></span>
										<p><strong>davidmiller</strong></p>
										<p>David Miller</p>
									</a>
								</div><!--member_avatar_group-->
							</div><!--simple_box-->
						</div><!--col-md-4-->
					</div><!--row-->

				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--container-->
	</div><!--tab_block_outer-->

@endsection
@section('footer')
	@parent
@endsection