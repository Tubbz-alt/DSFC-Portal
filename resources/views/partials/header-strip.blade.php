 <link rel="stylesheet" href="{{ url('css/frontend/pretty.css') }}">
<style>
 .collapse {
            display: block !important;
        }
        .navbar-inner-color{
			 background: #0072c6 none repeat scroll 0 0;
		}
		#wrap .navbar .nav > li > a{
		border-right: 1px solid #fff;
        padding-top: 8px ;
		color:#ffffff ;
		}
		#wrap .nav > li > a:focus, .nav > li > a:hover{
			background-color: #a00054;
		}
		#wrap .nav .open > a, .nav .open > a:focus, .nav .open > a:hover{
			background-color: #a00054;
		}
	 	#wrap .dropdown-menu{
			background:#A00054;
			color:white;
		}
		/*#wrap .dropdown-menu a {
		background: #0072c6 none repeat scroll 0 0;
		border-bottom: 1px solid #fff;
		} */
		#wrap .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover{
			background:#a00054;
			color:white;
		}
         a.current {
             background:#FFFFEF;
             color:#000000 !important;
         }
         a.current:hover {
             
             color: #ffffff !important;
         }
 .nav-collapse.collapse.user-nav li {
     text-align: center;
     width: 160px;
 }
</style>
<div class="header-strip">

{{--    <div class="col-md-1">
        <nav class="main-menu-button"><span></span><span></span><span></span></nav>
    </div>--}}
		<div class="col-md-1">
			<div class="logo-cover"><a href="{{ url('/dashboard') }}"><img src="{{ url('images/logo.png') }}" alt=""></a></div>
		</div>
	<div class="col-md-4">
			<div class="span8" style="margin-left: 7px;padding: 10px;">
				<h3 class="pack-title ">@yield('page-title')</h3>
			</div>
	</div>
    <div class="col-md-6">
        @yield('top-right-menu')
        <span class="user-cover pull-right">
         {{--   <h2><a href="#">{{ucfirst(strtolower(Sentinel::check()->first_name)) . " " . ucfirst(strtolower(Sentinel::check()->last_name))}}</a></h2>
            <p>Logged in as {{Sentinel::check()->username}}</p>--}}
        </span>
    </div>
    <div class="col-md-1 top-drop-down">

        <nav>
            <ul class="drop-down-menu">
               {{-- <li><a href="#">Profile</a></li>--}}

                <?php
                $user = Sentinel::getUser();
                if($user->inRole('administrator')) {
                ?>
                <li><a href="{{ url('admin') }}">Admin </a></li>
                <?php }
                ?>
                <li><a href="{{ url('user/logout') }}">Logout</a></li>
            </ul>
        </nav>
    </div>
</div>
<div class="main-menu-strip user-header">
    <div class="container">
        <nav>
            <ul>
               {{-- <li> <a href="">Trust Performance</a></li>
                <li>
                    <a href="">CCG Performance</a>
                    <ul>
                        <li><a href="{{ url('dashboard/rtt') }}">Referral to Treatment</a></li>
                    </ul>
                </li>

                <li> <a href="">Benchmarking </a>
                <li> <a href="">Scorecard </a> </li>--}}
            </ul>
         </nav>
    </div>
</div>


            <div id="wrap">
                <div class="container-fluid">
                    <div class="container row">
                   {{--     <div class="span4">
                            <img src="{{url('images/logo.png')}}"/>
                        </div>--}}
                        {{--<div class="span8" >
                            <h3 class="pack-title ">DSfC Reference Data</h3>
                        </div>--}}
                    </div>
                    <div class="navbar ">
                        <div class="navbar-inner navbar-inner-color">
                            <div class="">

                                <div class="nav-collapse collapse user-nav">
                                    <p class="navbar-text pull-right" style="margin: 10px;color: white;">
                                        <a class="header_links" href="{{url('/dashboard/version')}}">
                                        <b>Version: </b>0.1;</a>
                                         <b>Status: </b>Draft</p>
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Overview <b class="caret"> </b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li >
                                                    <a href="{{url('/dashboard/overview')}}">About</a>
                                                </li>
                                                <li id="change-request" class="change-request">
                                                    <a href="{{url('/dashboard/overview/change-request') }}" >Change Request</a>
                                                </li>
                                                <li>
                                                    <a href="{{url('/dashboard/overview/glossary')}}">Glossary</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{url('/dashboard/data-wizard')}}">Reference Data</a>
                                        </li>
                                       <li>
                                            <a href="{{url('/dashboard/data-wizard/help')}}">Help </a>
                                        </li>
                                        {{--   <li>
                                              <a href="{{url('/dashboard/mapping')}}">Mappings</a>
                                          </li>
                                          <li>
                                              <a href="{{url('/dashboard/grouping')}}">Group</a>
                                          </li>--}}
                                       {{-- <li>
                                            <a href="{{url('/dashboard/data-definitions')}}">Data Definitions</a>
                                        </li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
				 </div>
        </div>


 <!-- Modal -->
 <div class="container">
     <div class="modal fade" id="myModalchangerequest" role="dialog">
         <div class="modal-dialog">

             <!-- Modal content-->
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Change Request</h4>
                 </div>
                 <div class="modal-body">
                     {!! Form::open(array('files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}
                     <div >
                         <div class="form-group ">
                             <div class="form-group">
                                 {!! Form::label('dataitem ', 'Data Item ') !!}
                                 <table class="table filtertable_request_data  table-striped table-bordered definitions-table horizontal_scroll">
                                     <thead>
                                     <tr>
                                         <th class="text-center">Select</th>
                                         <th class="text-center">Database</th>
                                         <th class="text-center">Table Name</th>
                                         <th class="text-center">Data Item Name</th>
                                         <th class="text-center">Data Type</th>
                                         <th class="text-center">Requirement</th>

                                     </tr>
                                     </thead>
                                     <tbody id="tbodyrecordsrequest">

                                     </tbody>


                                 </table>
                             </div>
                             <div class="form-group">
                                 {!! Form::label('comments', 'Comments') !!}
                                 {!! Form::text('comments', '', array('class' => 'form-control' , 'autocomplete' => 'off','required' => 'required','id'=>'comments')) !!}
                             </div>

                             {!!  Form::button('Submit', array('class' => 'btn btn-primary change_request'))  !!}

                         </div>
                     </div>
                     {!! Form::close() !!}
                 </div>

             </div>

         </div>
     </div>
 </div>

 <script src="{{ url('js/jquery.min.js') }}"></script>
<script>
    $(function(){
        $('a').each(function() {
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('current');
            }
        });
    });
    $(document).ready(function (e) {



       $(document).on('click', '.dropdown-menu  #change-request', function(e){
                e.stopPropagation();
            $.ajax({
                url: "{{ url("/dashboard/common/data-item") }}",
                type: 'GET',
                success: function (data) {
                    $('.filtertable_request_data').DataTable().destroy();
                    $('#myModalchangerequest').modal('show');


                    $('#tbodyrecordsrequest').html(data);
                    $('.filtertable_request_data').DataTable( {
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": true,
                        "bAutoWidth": false
                    } );
                }
            });
        })

       $(document).on('click', '.change_request', function(e){
           var token = "{{csrf_token()}}";
           var comments = $('#comments').val();
           var checked = []
           $("input[name='wizard_list_request[]']:checked").each(function () {
               checked.push(parseInt($(this).val()));
           });

           e.stopPropagation();
            $.ajax({
                url: "{{ url("/dashboard/common/change-request") }}",
                data: {"_token": token,'comment':comments,'checked':checked},
                type: 'POST',
                success: function (data) {
                    window.location.reload();

                }
            });
        })

    });
</script>
