<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE html><html xmlns:pack="urn:pack" xmlns:xhtml="http://www.w3.org/1999/xhtml"
      xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <title>NHS England Reference Data - Commissioning Reference Data</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link href="../../Template/css/bootstrap/bootstrap.min.css" rel="stylesheet"
            media="screen"/>
      <link href="../../Template/css/base.css" rel="stylesheet" media="screen"/>
      <link href="../../Template/css/google-code-prettify/prettify.css" rel="stylesheet"
            media="screen"/>
   </head>
   <body>
      <div id="wrap">
         <div class="container">
            <div class="row">
               <div class="span4">
                  <img src="../../Template/images/logo.png"/>
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
                                    <a href="{{url('/changehistory')}}">Change History</a>
                                 </li>
                                 <li>
                                    <a href="{{url('/glossary')}}">Glossary</a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="{{url('/reference-data')}}">Reference Data</a>
                           </li>
                           <li>
                              <a href="{{url('/mapping')}}">Mappings</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div id="content" class="row">
               <div class="span12">
                  <h3 xmlns="">Commissioning Reference Data</h3>
                  <table xmlns="" class="table table-condensed table-striped">
                     <thead>
                        <tr>
                           <th width="40%" style="text-align: left;">Vocabulary Name</th>
                           <th width="15%" style="text-align: right;">Version</th>
                           <th width="15%" style="text-align: right;">Member Count</th>
                           <th width="15%" style="text-align: center;">HTML</th>
                           <th width="15%" style="text-align:center;">XML</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td width="40%" style="text-align: left;">First Attendance</td>
                           <td width="15%" style="text-align: right;">1.0</td>
                           <td width="15%" style="text-align: right;">6</td>
                           <td width="15%" style="text-align: center;">
                              <a href="HTML/First Attendance-v1.0.html">HTML</a>
                           </td>
                           <td width="15%" style="text-align: center;">
                              <a href="XML/First Attendance-v1.0.xml" target="_xml">XML</a>
                           </td>
                        </tr>
                        <tr>
                           <td width="40%" style="text-align: left;">Long Term Condition</td>
                           <td width="15%" style="text-align: right;">1.0</td>
                           <td width="15%" style="text-align: right;">2</td>
                           <td width="15%" style="text-align: center;">
                              <a href="HTML/Long Term Condition-v1.0.html">HTML</a>
                           </td>
                           <td width="15%" style="text-align: center;">
                              <a href="XML/Long Term Condition-v1.0.xml" target="_xml">XML</a>
                           </td>
                        </tr>
                        <tr>
                           <td/>
                           <td width="15%" style="text-align: right;">2.0</td>
                           <td width="15%" style="text-align: right;">4</td>
                           <td width="15%" style="text-align: center;">
                              <a href="HTML/Long Term Condition-v2.0.html">HTML</a>
                           </td>
                           <td width="15%" style="text-align: center;">
                              <a href="XML/Long Term Condition-v2.0.xml" target="_xml">XML</a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
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
      <script src="../../Template/js/jquery/jquery-1.8.3.js"> </script>
      <script src="../../Template/js/bootstrap/bootstrap.min.js"> </script>
      <script src="../../Template/js/google-code-prettify/prettify.js"> </script>
      <script>
				!function ($){$(function(){window.prettyPrint && prettyPrint()})}(window.jQuery)
        debugger;
			</script>
   </body>
</html>
