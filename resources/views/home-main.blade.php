
   <head>
      <title>NHS England Reference Data - About</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link href="./Template/css/bootstrap/bootstrap.min.css" rel="stylesheet"
            media="screen"/>
      <link href="./Template/css/base.css" rel="stylesheet" media="screen"/>
      <link href="./Template/css/google-code-prettify/prettify.css" rel="stylesheet"
            media="screen"/>
   </head>
   <body>
      <div id="wrap">
         <div class="container">
            <div class="row">
               <div class="span4">
                  <img src="./Template/images/logo.png"/>
               </div>
               <div class="span8">
                  <h3 class="pack-title text-right">NHS England Reference Data</h3>
               </div>
            </div>
            <div class="navbar">
               <div class="navbar-inner">
                  <div class="container">
                     <button type="button" class="btn btn-navbar" data-toggle="collapse"
                             data-target=".nav-collapse">
                        <span class="icon-bar"/>
                        <span class="icon-bar"/>
                        <span class="icon-bar"/>
                     </button>
                     <div class="nav-collapse collapse">
                        <p class="navbar-text pull-right">
                           <b>Version: </b>0.1; <b>Status: </b>Draft</p>
                        <ul class="nav">
                           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Overview <b class="caret"> </b>
                              </a>
                              <ul class="dropdown-menu">
                                 <li>
                                    <a href="{{url('/home')}}">About</a>
                                 </li>
                                 <li>
                                    <a href="javascript:void(0)">Change History</a>
                                 </li>
                                 <li>
                                    <a href="javascript:void(0)">Glossary</a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="javascript:void(0)">Reference Data</a>
                           </li>
                           <li>
                              <a href="javascript:void(0)">Mappings</a>
                           </li>

                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div id="content" class="row">
               <div class="span12">
                  <h3>About</h3>
                  <p>The NHS England Reference data is the publication consisting of the following:</p>
                  <ul>
                     <li>
                        <b>NHS England Reference Vocabularies:</b> These vocabularies are extensions to support commissioning flows for values which are not present in NHS data dicionary.</li>
                     <li>
                        <b>NHS England Mappings to Reference Vocabularies:</b> These mappings are created to support the consumption of the local data from providers for commissioning purposes.</li>
                  </ul>
                  <p>
                     <b>Note:</b> These scope of this reference data is only limited to provide support to commissioning anayltics.</p>
               </div>
            </div>
         </div>
         <div id="push"/>
      </div>
      <div id="footer">
         <div class="container">
            <div class="row">
               <div class="span6">
                  <p class="text-left">
                     <a href="mailto:england.dsfc-support@nhs.net">Contact Us</a>
                  </p>
               </div>
               <div class="span6">
                  <p class="text-right">
                     <b>Release Date: </b>14-July-2016</p>
               </div>
            </div>
         </div>
      </div>
      <script src="./Template/js/jquery/jquery-1.8.3.js"> </script>
      <script src="./Template/js/bootstrap/bootstrap.min.js"> </script>
      <script src="./Template/js/google-code-prettify/prettify.js"> </script>
      <script>
				!function ($){$(function(){window.prettyPrint && prettyPrint()})}(window.jQuery)
				</script>
   </body>
</html>