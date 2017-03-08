<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdmittedAdjusted;
use App\Models\AdmittedAdjustedTotal;
use App\Models\Incomplete;
use App\Models\IncompleteTotal;
use App\Models\NonAdmitted;
use App\Models\NonAdmittedTotal;
use DB;

class RTTDashboardController extends Controller
{
    function getIndex(){
        return view('dashboards.rtt');
    }
    function getAdmittedAdjusted(){
        $admitted_adjusted = AdmittedAdjusted::all();
        return $admitted_adjusted;
    }
    function getAdmittedAdjustedValues(){
        $current_date = date("Y-m-d");
        $previous_date = date("Y-m-d",strtotime("-2 year"));

        $current_financial_year = $this->getDateRangeData($previous_date, $current_date);

        $year_3 = date("Y-m-d",strtotime("-2 year"));
        $year_4 = date("Y-m-d",strtotime("-1 year"));

        $last_financial_year = $this->getDateRangeData($year_3, $year_4);

        dd(json_encode($current_financial_year));
        dd(json_encode($last_financial_year));
    }
    function getAdmittedAdjustedTotal(){
        $admitted_adjusted_total = AdmittedAdjustedTotal::all();
        return $admitted_adjusted_total;
    }
    function getIncomplete(){
        $incomplete = Incomplete::all();
        return $incomplete;
    }
    function getIncompleteValues(){
        $current_date = date("Y-m-d");
        $previous_date = date("Y-m-d",strtotime("-2 year"));

        $current_financial_year = $this->getDateRangeData($previous_date, $current_date);

        $year_3 = date("Y-m-d",strtotime("-2 year"));
        $year_4 = date("Y-m-d",strtotime("-1 year"));

        $last_financial_year = $this->getDateRangeData($year_3, $year_4);

        dd(json_encode($current_financial_year));
        dd(json_encode($last_financial_year));
    }
    function getIncompleteTotal(){
        $incomplete_total = IncompleteTotal::all();
        return $incomplete_total;
    }
    function getNonAdmitted(){
        $non_admitted = NonAdmitted::all();
        return $non_admitted;
    }
    function getNonAdmittedValues(){
        $current_date = date("Y-m-d");
        $previous_date = date("Y-m-d",strtotime("-2 year"));

        $current_financial_year = $this->getDateRangeData($previous_date, $current_date);

        $year_3 = date("Y-m-d",strtotime("-2 year"));
        $year_4 = date("Y-m-d",strtotime("-1 year"));

        $last_financial_year = $this->getDateRangeData($year_3, $year_4);

        dd(json_encode($current_financial_year));
        dd(json_encode($last_financial_year));
    }

    function getNonAdmittedTotal(){
        $non_admitted_total = NonAdmittedTotal::all();
        return $non_admitted_total;
    }
    function getYtdComparison()
    {
        $YtdComparison = array(
                            "2014 - 2015" => "0.2",
                            "2015 - 2016" => "0.8"
                    );
        return $YtdComparison;
    }
    function getRttSearch(Request $request){
        $start_date = explode(" ",$request['start_date']);
        $end_date = explode(" ",$request['end_date']);
        echo $start_date_y = date_format(date_create($start_date[0]),"Y");
        echo $start_date_m = date_format(date_create($start_date[0]),"m");
        echo $end_date_y = date_format(date_create($end_date[0]),"Y");
        echo $end_date_m = date_format(date_create($end_date[0]),"m");
    }
    function getDateRangeData($start_year, $end_year, $type = 'incomplete', $provider_code = 'RGD', $treatment_code = NULL)
    { 
        switch ($type) {
            case 'admitted_adjusted':
                
                $query = " SELECT MONTHNAME( period ) AS month, SUM(within_18_weeks) AS percentage
                FROM `admitted_adjusted`
                WHERE DATE_FORMAT( period, '%Y%m' ) >= DATE_FORMAT('".$start_year."', '%Y%m' )
                AND DATE_FORMAT( period, '%Y%m' ) <= DATE_FORMAT( '".$end_year."', '%Y%m' )
                AND provider_code = '".$provider_code."' GROUP BY month" ;
            break;

            case 'non_admitted':
                $query =  "SELECT MONTHNAME( period ) AS
                            MONTH , SUM( within_18_weeks ) AS percentage
                            FROM `non_admitted`
                            WHERE DATE_FORMAT( period, '%Y%m' ) >= DATE_FORMAT( '". $start_year ."', '%Y%m' )
                            AND DATE_FORMAT( period, '%Y%m' ) <= DATE_FORMAT( '". $end_year ."', '%Y%m' )
                            AND provider_code = '". $provider_code ."'
                            GROUP BY MONTH";
            break;

            case 'incomplete':
               
               $query =  "SELECT MONTHNAME( period ) AS
                            MONTH , SUM( within_18_weeks ) AS percentage
                            FROM `incomplete`
                            WHERE DATE_FORMAT( period, '%Y%m' ) >= DATE_FORMAT( '". $start_year ."', '%Y%m' )
                            AND DATE_FORMAT( period, '%Y%m' ) <= DATE_FORMAT( '". $end_year ."', '%Y%m' )
                            AND provider_code = '". $provider_code ."'
                            GROUP BY MONTH";
            break;
        }
        $result = DB::select($query);
        return $result;   
    }
     
}