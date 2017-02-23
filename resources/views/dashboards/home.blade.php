@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
    @parent
    <style>
        .margin-top-57{
            margin-top: -57px;
        }


    </style>
@endsection
@section('title', 'Dashboards')
@section('content')
    <div  class="container">
        <div class="tabBlock">

            <ul class="tabBlock-tabs datachallenge-info">

                <li class="tabname tabBlock-tab set-tab is-active">Home page</li>
                <li class="tabname tabBlock-tab set-tab ">About us </li>
                <li class="tabname tabBlock-tab set-tab ">Site Map </li>


            </ul>
            <div class="tabBlock-content" >
                <div class="tabBlock-pane margin-top-57">
                    <div class="container">
                    <p>The Data Services for Commissioners Reference Library Portal provides a central point for all definitions of data items held within the NHS England temporary National Repository (tNR).  The Portal has been developed for use by analysts with access to the tNR to further, or confirm, their understanding of the data in order to promote high quality analyses.
                        The Reference Library Portal is maintained and published by the Data Services for Commissioners (DSfC) Team.  All changes are governed by internal review processes, with further assurance received from subject matter experts in the wider analytical teams in NHS England.  This is enabled via the Data Prioritisation & Definitions tNR Sub Group.
                        If you would like any help using the Data Services for Commissioners Reference Library Portal, please contact us.
                    </p>
                     </div>
                </div>
                <div class="tabBlock-pane margin-top-57">
                    <div class="container">
                    <p>The Reference Library Portal is owned and managed by Data Services for Commissioners (DSfC).  DSfC is a joint NHS England and NHS Digital programme that is being managed as part of the wider National Data Services Development (NDSD) programme.
                        The DSfC service was established to improve NHS commissioning by ensuring that commissioning decisions, and the insights that support them, are based upon robust, standardised data that has been processed efficiently and is accessed legally.
                        The Data Services for Commissioners (DSfC) vision is;
                        “Delivering better commissioning insight with consistent, high quality data processed once and accessed appropriately by all commissioners”
                        Our intention is that all staff and organisations carrying out or supporting NHS commissioning activities will be fully and demonstrably compliant with the requirements of the information governance toolkit and applicable law and mandatory guidance in line with the requirements of the Health and Social Care Act 2012 and the Care Act 2014.  Patient identifiable data (PID) must only be used when there is a clear need and stated legal basis to do so.
                        While achieving these objectives will provide the required legally compliant data, it is necessary for each data item to be fully and consistently understood by users to guarantee high quality analyses.  The goal of the Data Services for Commissioners Reference Library Portal is an essential tool that will enable consistency and understanding of the definitions of data being utilised by the tNR users.
                        If you would like to know any more about the objectives of our programme or who we are, please contact us.
                        While all data definitions on the Reference Library Portal have been thoroughly quality assured internally before publication, however, we would appreciate any input from users to further improve the product.
                        If you have any queries about how a data item is defined, or require further datasets to be included on the Reference Library Portal, please complete the following form and email it to england.dsfc-support@nhs.net When we have reviewed the form we will discuss your thoughts and consider making the suggested changes.
                    </p>
                    </div>
                </div>
                <div class="tabBlock-pane margin-top-57">
                    <div class="container">
                    <h3>tNR Data Definition</h3>
                    <p>The tNR Data Definition tab provides the user the ability to select a specific database and a table name.   This allows the user the ability to find detailed definitions information relating to all the data items within the tNR.  The chosen database and table names correspond directly with the setup within the tNR. </p>
                    <h3>Reference Data</h3>
                    <p>The Reference Data tab provides details of all data items within the tNR.  This is irrespective of the tables within which these data items are stored.  The users also have the ability to view any codes and values that may form part of the reference data item.</p>
                    <h3>Mapping </h3>
                    <p>The Mapping tab allows the ability to map data items irrespective of the dataset they form part of.  Also datasets may be national or local depending on user requirements.   Mapping can be done at two levels, first of all from one data item to another and secondly mapping may be done based on the values within data items, for example, a value “1” in first data item  means “male” and a value “m” in the second data items also means “male”.</p>
                    <h3>Group</h3>
                    <p>The Group tab provides details of any groups that have been set up that help the user community with enhancing analytical capability.  For example, a group could be set up that provides the detailed information to enable you to identify long term conditions patients or disease specific, for example, cancer patients.  The groups to be set up will be according to user needs and priorities.  Please contact the DSfC team if you have specific requirements that you wish to discuss.</p>
                    </div>

                </div>


            </div>




        </div>





    </div>




@endsection
@section('footer')
    @parent
    <script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
@endsection
