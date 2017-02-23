<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Input;
use App\Models\AdmittedAdjustedTotal;
use App\Models\AdmittedAdjusted;
use App\Models\IncompleteTotal;
use App\Models\NonAdmittedTotal;
use App\Models\NonAdmitted;
use App\Models\Incomplete;

class RTTController extends Controller
{
    /*AdmittedAdjustedTotal*/
    public function getAdmittedAdjustedTotal()
    {
        $aat_list = AdmittedAdjustedTotal::paginate(5);
        return view("admin.rtt.admitted-adjusted-total", compact('aat_list'));
    }
    public function postAdmittedAdjustedTotal(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):
                $aat = new AdmittedAdjustedTotal;

                if(empty($arr['period'])){
                  $aat->period = "Unspecified";  
                }else{
                    $aat->period = $arr['period'];
                }

                if(empty($arr['provider_code'])){
                  $aat->provider_code = "Unspecified";  
                }else{
                    $aat->provider_code = $arr['provider_code'];
                }

                if(empty($arr['provider_name'])){
                  $aat->provider_name = "Unspecified";  
                }else{
                    $aat->provider_name = $arr['provider_name'];
                }


                if(empty($arr['treatment_function_code'])){
                  $aat->treatment_function_code = "Unspecified";  
                }else{
                    $aat->treatment_function_code = $arr['treatment_function_code'];
                }

                if(empty($arr['treatment_function'])){
                    $aat->treatment_function = "Unspecified";  
                }else{
                    $aat->treatment_function = $arr['treatment_function'];
                }

                if(empty($arr['0_1'])){
                    $aat->bw_0_1 = 0;
                }else{
                $aat->bw_0_1 = $arr['0_1'];
                }


                if(empty($arr['1_2'])){
                    $aat->bw_1_2 = 0;
                }else{
                $aat->bw_1_2 = $arr['1_2'];
                }

                if(empty($arr['2_3'])){
                    $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['2_3'])){
                        $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['3_4'])){
                        $aat->bw_3_4 = 0;
                }else{
                $aat->bw_3_4 = $arr['3_4'];
                }
                
                if(empty($arr['4_5'])){
                        $aat->bw_4_5 = 0;
                }else{
                $aat->bw_4_5 = $arr['4_5'];
                }

                if(empty($arr['5_6'])){
                        $aat->bw_5_6 = 0;
                }else{
                $aat->bw_5_6 = $arr['5_6'];
                }

                if(empty($arr['6_7'])){
                        $aat->bw_6_7 = 0;
                }else{
                $aat->bw_6_7 = $arr['6_7'];
                }
                                        
                if(empty($arr['7_8'])){
                        $aat->bw_7_8 = 0;
                }else{
                $aat->bw_7_8 = $arr['7_8'];
                }

                if(empty($arr['8_9'])){
                        $aat->bw_8_9 = 0;
                }else{
                $aat->bw_8_9 = $arr['8_9'];
                }

                if(empty($arr['9_10'])){
                        $aat->bw_9_10 = 0;
                }else{
                $aat->bw_9_10 = $arr['9_10'];
                }

                if(empty($arr['10_11'])){
                        $aat->bw_10_11 = 0;
                }else{
                $aat->bw_10_11 = $arr['10_11'];
                }

                if(empty($arr['11_12'])){
                        $aat->bw_11_12 = 0;
                }else{
                $aat->bw_11_12 = $arr['11_12'];
                }

                if(empty($arr['12_13'])){
                        $aat->bw_12_13 = 0;
                }else{
                $aat->bw_12_13 = $arr['12_13'];
                }

                if(empty($arr['13_14'])){
                        $aat->bw_13_14 = 0;
                }else{
                $aat->bw_13_14 = $arr['13_14'];
                }

                if(empty($arr['14_15'])){
                        $aat->bw_14_15 = 0;
                }else{
                $aat->bw_14_15 = $arr['14_15'];
                }

                if(empty($arr['15_16'])){
                        $aat->bw_15_16 = 0;
                }else{
                $aat->bw_15_16 = $arr['15_16'];
                }
                if(empty($arr['16_17'])){
                        $aat->bw_16_17 = 0;
                }else{
                $aat->bw_16_17 = $arr['16_17'];
                }

                if(empty($arr['17_18'])){
                        $aat->bw_17_18 = 0;
                }else{
                $aat->bw_17_18 = $arr['17_18'];
                }

                if(empty($arr['18_19'])){
                        $aat->bw_18_19 = 0;
                }else{
                $aat->bw_18_19 = $arr['18_19'];
                }
                if(empty($arr['19_20'])){
                        $aat->bw_19_20 = 0;
                }else{
                $aat->bw_19_20 = $arr['19_20'];
                }

                if(empty($arr['20_21'])){
                        $aat->bw_20_21 = 0;
                }else{
                $aat->bw_20_21 = $arr['20_21'];
                }
                if(empty($arr['21_22'])){
                        $aat->bw_21_22 = 0;
                }else{
                $aat->bw_21_22 = $arr['21_22'];
                }
                if(empty($arr['22_23'])){
                        $aat->bw_22_23 = 0;
                }else{
                $aat->bw_22_23 = $arr['22_23'];
                }
                if(empty($arr['23_24'])){
                        $aat->bw_23_24 = 0;
                }else{
                $aat->bw_23_24 = $arr['23_24'];
                }
                if(empty($arr['24_25'])){
                        $aat->bw_24_25 = 0;
                }else{
                $aat->bw_24_25 = $arr['24_25'];
                }
                if(empty($arr['25_26'])){
                        $aat->bw_25_26 = 0;
                }else{
                $aat->bw_25_26 = $arr['25_26'];
                }
                if(empty($arr['26_27'])){
                        $aat->bw_26_27 = 0;
                }else{
                $aat->bw_26_27 = $arr['26_27'];
                }
                if(empty($arr['27_28'])){
                        $aat->bw_27_28 = 0;
                }else{
                $aat->bw_27_28 = $arr['27_28'];
                }
                if(empty($arr['28_29'])){
                        $aat->bw_28_29 = 0;
                }else{
                $aat->bw_28_29 = $arr['28_29'];
                }
                if(empty($arr['29_30'])){
                        $aat->bw_29_30 = 0;
                }else{
                $aat->bw_29_30 = $arr['29_30'];
                }
                if(empty($arr['30_31'])){
                        $aat->bw_30_31 = 0;
                }else{
                $aat->bw_30_31 = $arr['30_31'];
                }
                if(empty($arr['31_32'])){
                        $aat->bw_31_32 = 0;
                }else{
                $aat->bw_31_32 = $arr['31_32'];
                }
                if(empty($arr['32_33'])){
                        $aat->bw_32_33 = 0;
                }else{
                $aat->bw_32_33 = $arr['32_33'];
                }
                if(empty($arr['33_34'])){
                        $aat->bw_33_34 = 0;
                }else{
                $aat->bw_33_34 = $arr['33_34'];
                }
                if(empty($arr['34_35'])){
                        $aat->bw_34_35 = 0;
                }else{
                $aat->bw_34_35 = $arr['34_35'];
                }
                if(empty($arr['35_36'])){
                        $aat->bw_35_36 = 0;
                }else{
                $aat->bw_35_36 = $arr['35_36'];
                }
                if(empty($arr['36_37'])){
                        $aat->bw_36_37 = 0;
                }else{
                $aat->bw_36_37 = $arr['36_37'];
                }
                if(empty($arr['37_38'])){
                        $aat->bw_37_38 = 0;
                }else{
                $aat->bw_37_38 = $arr['37_38'];
                }
                if(empty($arr['38_39'])){
                        $aat->bw_38_39 = 0;
                }else{
                $aat->bw_38_39 = $arr['38_39'];
                }
                if(empty($arr['39_40'])){
                        $aat->bw_39_40 = 0;
                }else{
                $aat->bw_39_40 = $arr['39_40'];
                }
                if(empty($arr['40_41'])){
                        $aat->bw_40_41 = 0;
                }else{
                $aat->bw_40_41 = $arr['40_41'];
                }

                if(empty($arr['41_42'])){
                        $aat->bw_41_42 = 0;
                }else{
                $aat->bw_41_42 = $arr['41_42'];
                }

                if(empty($arr['42_43'])){
                        $aat->bw_42_43 = 0;
                }else{
                $aat->bw_42_43 = $arr['42_43'];
                }
                if(empty($arr['43_44'])){
                        $aat->bw_43_44 = 0;
                }else{
                $aat->bw_43_44 = $arr['43_44'];
                }
                if(empty($arr['44_45'])){
                        $aat->bw_44_45 = 0;
                }else{
                $aat->bw_44_45 = $arr['44_45'];
                }
                if(empty($arr['45_46'])){
                        $aat->bw_45_46 = 0;
                }else{
                $aat->bw_45_46 = $arr['45_46'];
                }
                if(empty($arr['46_47'])){
                        $aat->bw_46_47 = 0;
                }else{
                $aat->bw_46_47 = $arr['46_47'];
                }

                if(empty($arr['47_48'])){
                        $aat->bw_47_48 = 0;
                }else{
                $aat->bw_47_48 = $arr['47_48'];
                }

                if(empty($arr['48_49'])){
                        $aat->bw_48_49 = 0;
                }else{
                $aat->bw_48_49 = $arr['48_49'];
                }
                if(empty($arr['49_50'])){
                        $aat->bw_49_50 = 0;
                }else{
                $aat->bw_49_50 = $arr['49_50'];
                }
                if(empty($arr['50_51'])){
                        $aat->bw_50_51 = 0;
                }else{
                $aat->bw_50_51 = $arr['50_51'];
                }
                if(empty($arr['51_52'])){
                        $aat->bw_51_52 = 0;
                }else{
                $aat->bw_51_52 = $arr['51_52'];
                }
                if(empty($arr['52_plus'])){
                        $aat->plus_52 = 0;
                }else{
                $aat->plus_52 = $arr['52_plus'];
                }

                if(empty($arr['patients_with_unknown_clock_start_date'])){
                        $aat->patients_with_unknown_clock_start_date = 0;
                }else{
                $aat->patients_with_unknown_clock_start_date = $arr['patients_with_unknown_clock_start_date'];
                }
                if(empty($arr['total_number_of_completed_pathways_all'])){
                        $aat->total_number_of_completed_pathways_all = 0;
                }else{
                $aat->total_number_of_completed_pathways_all = $arr['total_number_of_completed_pathways_all'];
                }
                if(empty($arr['total_number_of_completed_pathways_with_a_known_clock_start'])){
                        $aat->total_number_of_completed_pathways_with_a_known_clock_start = 0;
                }else{
                $aat->total_number_of_completed_pathways_with_a_known_clock_start = $arr['total_number_of_completed_pathways_with_a_known_clock_start'];
                }
                if(empty($arr['total_with_a_known_clock_start_within_18_weeks'])){
                        $aat->total_with_a_known_clock_start_within_18_weeks = 0;
                }else{
                $aat->total_with_a_known_clock_start_within_18_weeks = $arr['total_with_a_known_clock_start_within_18_weeks'];
                }
                if(empty($arr['within_18_weeks'])){
                        $aat->within_18_weeks = 0;
                }else{
                $aat->within_18_weeks = $arr['within_18_weeks'];
                }
                if(empty($arr['average_median_waiting_time_in_weeks'])){
                        $aat->average_median_waiting_time_in_weeks = 0;
                }else{
                $aat->average_median_waiting_time_in_weeks = $arr['average_median_waiting_time_in_weeks'];
                }
                if(empty($arr['95th_percentile_waiting_time_in_weeks'])){
                        $aat->ninetyfifth_percentile_waiting_time_in_weeks = 0;
                }else{
                $aat->ninetyfifth_percentile_waiting_time_in_weeks = $arr['95th_percentile_waiting_time_in_weeks'];
                }
                if(empty($arr['potential_patients_liable_to_penalty'])){
                        $aat->potential_patients_liable_to_penalty = 0;
                }else{
                $aat->potential_patients_liable_to_penalty = $arr['potential_patients_liable_to_penalty'];
                }
                if(empty($arr['indicative_penalty'])){
                        $aat->indicative_penalty = 0;
                }else{
                $aat->indicative_penalty = $arr['indicative_penalty'];
                }

                $aat->save();
            endforeach;
            return redirect('admin/rtt/admitted-adjusted-total');
        }
        else{
            return redirect('admin/rtt/admitted-adjusted-total')->withErrors(['errors' =>"Please choose a file"]);
        }
    }

    /*NonAdmittedTotal*/
    public function getNonAdmittedTotal()
    {
        $aat_list = NonAdmittedTotal::paginate(5);

        return view("admin.rtt.non-admitted-total", compact('aat_list'));
    }
    public function postNonAdmittedTotal(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):
                $aat = new NonAdmittedTotal;

                if(empty($arr['period'])){
                  $aat->period = "Unspecified";  
                }else{
                $aat->period = $arr['period'];
                }

                if(empty($arr['provider_code'])){
                  $aat->provider_code = "Unspecified";  
                }else{
                $aat->provider_code = $arr['provider_code'];
                }

                if(empty($arr['provider_name'])){
                  $aat->provider_name = "Unspecified";  
                }else{
                $aat->provider_name = $arr['provider_name'];
                }


                if(empty($arr['treatment_function_code'])){
                  $aat->treatment_function_code = "Unspecified";  
                }else{
                $aat->treatment_function_code = $arr['treatment_function_code'];
                }

                if(empty($arr['treatment_function'])){
                  $aat->treatment_function = "Unspecified";  
                }else{
                $aat->treatment_function = $arr['treatment_function'];
                }
                
                if(empty($arr['0_1'])){
                    $aat->bw_0_1 = 0;
                }else{
                $aat->bw_0_1 = $arr['0_1'];
                }


                if(empty($arr['1_2'])){
                    $aat->bw_1_2 = 0;
                }else{
                $aat->bw_1_2 = $arr['1_2'];
                }

                if(empty($arr['2_3'])){
                    $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['2_3'])){
                        $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['3_4'])){
                        $aat->bw_3_4 = 0;
                }else{
                $aat->bw_3_4 = $arr['3_4'];
                }
                
                if(empty($arr['4_5'])){
                        $aat->bw_4_5 = 0;
                }else{
                $aat->bw_4_5 = $arr['4_5'];
                }

                if(empty($arr['5_6'])){
                        $aat->bw_5_6 = 0;
                }else{
                $aat->bw_5_6 = $arr['5_6'];
                }

                if(empty($arr['6_7'])){
                        $aat->bw_6_7 = 0;
                }else{
                $aat->bw_6_7 = $arr['6_7'];
                }
                                        
                if(empty($arr['7_8'])){
                        $aat->bw_7_8 = 0;
                }else{
                $aat->bw_7_8 = $arr['7_8'];
                }

                if(empty($arr['8_9'])){
                        $aat->bw_8_9 = 0;
                }else{
                $aat->bw_8_9 = $arr['8_9'];
                }

                if(empty($arr['9_10'])){
                        $aat->bw_9_10 = 0;
                }else{
                $aat->bw_9_10 = $arr['9_10'];
                }

                if(empty($arr['10_11'])){
                        $aat->bw_10_11 = 0;
                }else{
                $aat->bw_10_11 = $arr['10_11'];
                }

                if(empty($arr['11_12'])){
                        $aat->bw_11_12 = 0;
                }else{
                $aat->bw_11_12 = $arr['11_12'];
                }

                if(empty($arr['12_13'])){
                        $aat->bw_12_13 = 0;
                }else{
                $aat->bw_12_13 = $arr['12_13'];
                }

                if(empty($arr['13_14'])){
                        $aat->bw_13_14 = 0;
                }else{
                $aat->bw_13_14 = $arr['13_14'];
                }

                if(empty($arr['14_15'])){
                        $aat->bw_14_15 = 0;
                }else{
                $aat->bw_14_15 = $arr['14_15'];
                }

                if(empty($arr['15_16'])){
                        $aat->bw_15_16 = 0;
                }else{
                $aat->bw_15_16 = $arr['15_16'];
                }
                if(empty($arr['16_17'])){
                        $aat->bw_16_17 = 0;
                }else{
                $aat->bw_16_17 = $arr['16_17'];
                }

                if(empty($arr['17_18'])){
                        $aat->bw_17_18 = 0;
                }else{
                $aat->bw_17_18 = $arr['17_18'];
                }

                if(empty($arr['18_19'])){
                        $aat->bw_18_19 = 0;
                }else{
                $aat->bw_18_19 = $arr['18_19'];
                }
                if(empty($arr['19_20'])){
                        $aat->bw_19_20 = 0;
                }else{
                $aat->bw_19_20 = $arr['19_20'];
                }

                if(empty($arr['20_21'])){
                        $aat->bw_20_21 = 0;
                }else{
                $aat->bw_20_21 = $arr['20_21'];
                }
                if(empty($arr['21_22'])){
                        $aat->bw_21_22 = 0;
                }else{
                $aat->bw_21_22 = $arr['21_22'];
                }
                if(empty($arr['22_23'])){
                        $aat->bw_22_23 = 0;
                }else{
                $aat->bw_22_23 = $arr['22_23'];
                }
                if(empty($arr['23_24'])){
                        $aat->bw_23_24 = 0;
                }else{
                $aat->bw_23_24 = $arr['23_24'];
                }
                if(empty($arr['24_25'])){
                        $aat->bw_24_25 = 0;
                }else{
                $aat->bw_24_25 = $arr['24_25'];
                }
                if(empty($arr['25_26'])){
                        $aat->bw_25_26 = 0;
                }else{
                $aat->bw_25_26 = $arr['25_26'];
                }
                if(empty($arr['26_27'])){
                        $aat->bw_26_27 = 0;
                }else{
                $aat->bw_26_27 = $arr['26_27'];
                }
                if(empty($arr['27_28'])){
                        $aat->bw_27_28 = 0;
                }else{
                $aat->bw_27_28 = $arr['27_28'];
                }
                if(empty($arr['28_29'])){
                        $aat->bw_28_29 = 0;
                }else{
                $aat->bw_28_29 = $arr['28_29'];
                }
                if(empty($arr['29_30'])){
                        $aat->bw_29_30 = 0;
                }else{
                $aat->bw_29_30 = $arr['29_30'];
                }
                if(empty($arr['30_31'])){
                        $aat->bw_30_31 = 0;
                }else{
                $aat->bw_30_31 = $arr['30_31'];
                }
                if(empty($arr['31_32'])){
                        $aat->bw_31_32 = 0;
                }else{
                $aat->bw_31_32 = $arr['31_32'];
                }
                if(empty($arr['32_33'])){
                        $aat->bw_32_33 = 0;
                }else{
                $aat->bw_32_33 = $arr['32_33'];
                }
                if(empty($arr['33_34'])){
                        $aat->bw_33_34 = 0;
                }else{
                $aat->bw_33_34 = $arr['33_34'];
                }
                if(empty($arr['34_35'])){
                        $aat->bw_34_35 = 0;
                }else{
                $aat->bw_34_35 = $arr['34_35'];
                }
                if(empty($arr['35_36'])){
                        $aat->bw_35_36 = 0;
                }else{
                $aat->bw_35_36 = $arr['35_36'];
                }
                if(empty($arr['36_37'])){
                        $aat->bw_36_37 = 0;
                }else{
                $aat->bw_36_37 = $arr['36_37'];
                }
                if(empty($arr['37_38'])){
                        $aat->bw_37_38 = 0;
                }else{
                $aat->bw_37_38 = $arr['37_38'];
                }
                if(empty($arr['38_39'])){
                        $aat->bw_38_39 = 0;
                }else{
                $aat->bw_38_39 = $arr['38_39'];
                }
                if(empty($arr['39_40'])){
                        $aat->bw_39_40 = 0;
                }else{
                $aat->bw_39_40 = $arr['39_40'];
                }
                if(empty($arr['40_41'])){
                        $aat->bw_40_41 = 0;
                }else{
                $aat->bw_40_41 = $arr['40_41'];
                }

                if(empty($arr['41_42'])){
                        $aat->bw_41_42 = 0;
                }else{
                $aat->bw_41_42 = $arr['41_42'];
                }

                if(empty($arr['42_43'])){
                        $aat->bw_42_43 = 0;
                }else{
                $aat->bw_42_43 = $arr['42_43'];
                }
                if(empty($arr['43_44'])){
                        $aat->bw_43_44 = 0;
                }else{
                $aat->bw_43_44 = $arr['43_44'];
                }
                if(empty($arr['44_45'])){
                        $aat->bw_44_45 = 0;
                }else{
                $aat->bw_44_45 = $arr['44_45'];
                }
                if(empty($arr['45_46'])){
                        $aat->bw_45_46 = 0;
                }else{
                $aat->bw_45_46 = $arr['45_46'];
                }
                if(empty($arr['46_47'])){
                        $aat->bw_46_47 = 0;
                }else{
                $aat->bw_46_47 = $arr['46_47'];
                }

                if(empty($arr['47_48'])){
                        $aat->bw_47_48 = 0;
                }else{
                $aat->bw_47_48 = $arr['47_48'];
                }

                if(empty($arr['48_49'])){
                        $aat->bw_48_49 = 0;
                }else{
                $aat->bw_48_49 = $arr['48_49'];
                }
                if(empty($arr['49_50'])){
                        $aat->bw_49_50 = 0;
                }else{
                $aat->bw_49_50 = $arr['49_50'];
                }
                if(empty($arr['50_51'])){
                        $aat->bw_50_51 = 0;
                }else{
                $aat->bw_50_51 = $arr['50_51'];
                }
                if(empty($arr['51_52'])){
                        $aat->bw_51_52 = 0;
                }else{
                $aat->bw_51_52 = $arr['51_52'];
                }
                if(empty($arr['52_plus'])){
                        $aat->plus_52 = 0;
                }else{
                $aat->plus_52 = $arr['52_plus'];
                }

                if(empty($arr['patients_with_unknown_clock_start_date'])){
                        $aat->patients_with_unknown_clock_start_date = 0;
                }else{
                $aat->patients_with_unknown_clock_start_date = $arr['patients_with_unknown_clock_start_date'];
                }
                if(empty($arr['total_number_of_completed_pathways_all'])){
                        $aat->total_number_of_completed_pathways_all = 0;
                }else{
                $aat->total_number_of_completed_pathways_all = $arr['total_number_of_completed_pathways_all'];
                }
                if(empty($arr['total_number_of_completed_pathways_with_a_known_clock_start'])){
                        $aat->total_number_of_completed_pathways_with_a_known_clock_start = 0;
                }else{
                $aat->total_number_of_completed_pathways_with_a_known_clock_start = $arr['total_number_of_completed_pathways_with_a_known_clock_start'];
                }
                if(empty($arr['total_with_a_known_clock_start_within_18_weeks'])){
                        $aat->total_with_a_known_clock_start_within_18_weeks = 0;
                }else{
                $aat->total_with_a_known_clock_start_within_18_weeks = $arr['total_with_a_known_clock_start_within_18_weeks'];
                }
                if(empty($arr['within_18_weeks'])){
                        $aat->within_18_weeks = 0;
                }else{
                $aat->within_18_weeks = $arr['within_18_weeks'];
                }
                if(empty($arr['average_median_waiting_time_in_weeks'])){
                        $aat->average_median_waiting_time_in_weeks = 0;
                }else{
                $aat->average_median_waiting_time_in_weeks = $arr['average_median_waiting_time_in_weeks'];
                }
                if(empty($arr['95th_percentile_waiting_time_in_weeks'])){
                        $aat->ninetyfifth_percentile_waiting_time_in_weeks = 0;
                }else{
                $aat->ninetyfifth_percentile_waiting_time_in_weeks = $arr['95th_percentile_waiting_time_in_weeks'];
                }
                if(empty($arr['potential_patients_liable_to_penalty'])){
                        $aat->potential_patients_liable_to_penalty = 0;
                }else{
                $aat->potential_patients_liable_to_penalty = $arr['potential_patients_liable_to_penalty'];
                }
                if(empty($arr['indicative_penalty'])){
                        $aat->indicative_penalty = 0;
                }else{
                $aat->indicative_penalty = $arr['indicative_penalty'];
                }

                $aat->save();
            endforeach;
            return redirect('admin/rtt/non-admitted-total');
        }
        else{
            return redirect('admin/rtt/non-admitted-total')->withErrors(['errors' =>"Please choose a file"]);
        }
    }

    /*IncompleteTotal*/
    public function getIncompleteTotal()
    {
        $aat_list = IncompleteTotal::paginate(5);
        return view("admin.rtt.incomplete-total", compact('aat_list'));
    }
    public function postIncompleteTotal(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):
                $aat = new IncompleteTotal;

                if(empty($arr['period'])){
                  $aat->period = "Unspecified";  
                }else{
                $aat->period = $arr['period'];
                }

                if(empty($arr['provider_code'])){
                  $aat->provider_code = "Unspecified";  
                }else{
                $aat->provider_code = $arr['provider_code'];
                }

                if(empty($arr['provider_name'])){
                  $aat->provider_name = "Unspecified";  
                }else{
                $aat->provider_name = $arr['provider_name'];
                }


                if(empty($arr['treatment_function_code'])){
                  $aat->treatment_function_code = "Unspecified";  
                }else{
                $aat->treatment_function_code = $arr['treatment_function_code'];
                }

                if(empty($arr['treatment_function'])){
                  $aat->treatment_function = "Unspecified";  
                }else{
                $aat->treatment_function = $arr['treatment_function'];
                }

                if(empty($arr['0_1'])){
                    $aat->bw_0_1 = 0;
                }else{
                $aat->bw_0_1 = $arr['0_1'];
                }


                if(empty($arr['1_2'])){
                    $aat->bw_1_2 = 0;
                }else{
                $aat->bw_1_2 = $arr['1_2'];
                }

                if(empty($arr['2_3'])){
                    $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['2_3'])){
                        $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['3_4'])){
                        $aat->bw_3_4 = 0;
                }else{
                $aat->bw_3_4 = $arr['3_4'];
                }
                
                if(empty($arr['4_5'])){
                        $aat->bw_4_5 = 0;
                }else{
                $aat->bw_4_5 = $arr['4_5'];
                }

                if(empty($arr['5_6'])){
                        $aat->bw_5_6 = 0;
                }else{
                $aat->bw_5_6 = $arr['5_6'];
                }

                if(empty($arr['6_7'])){
                        $aat->bw_6_7 = 0;
                }else{
                $aat->bw_6_7 = $arr['6_7'];
                }
                                        
                if(empty($arr['7_8'])){
                        $aat->bw_7_8 = 0;
                }else{
                $aat->bw_7_8 = $arr['7_8'];
                }

                if(empty($arr['8_9'])){
                        $aat->bw_8_9 = 0;
                }else{
                $aat->bw_8_9 = $arr['8_9'];
                }

                if(empty($arr['9_10'])){
                        $aat->bw_9_10 = 0;
                }else{
                $aat->bw_9_10 = $arr['9_10'];
                }

                if(empty($arr['10_11'])){
                        $aat->bw_10_11 = 0;
                }else{
                $aat->bw_10_11 = $arr['10_11'];
                }

                if(empty($arr['11_12'])){
                        $aat->bw_11_12 = 0;
                }else{
                $aat->bw_11_12 = $arr['11_12'];
                }

                if(empty($arr['12_13'])){
                        $aat->bw_12_13 = 0;
                }else{
                $aat->bw_12_13 = $arr['12_13'];
                }

                if(empty($arr['13_14'])){
                        $aat->bw_13_14 = 0;
                }else{
                $aat->bw_13_14 = $arr['13_14'];
                }

                if(empty($arr['14_15'])){
                        $aat->bw_14_15 = 0;
                }else{
                $aat->bw_14_15 = $arr['14_15'];
                }

                if(empty($arr['15_16'])){
                        $aat->bw_15_16 = 0;
                }else{
                $aat->bw_15_16 = $arr['15_16'];
                }
                if(empty($arr['16_17'])){
                        $aat->bw_16_17 = 0;
                }else{
                $aat->bw_16_17 = $arr['16_17'];
                }

                if(empty($arr['17_18'])){
                        $aat->bw_17_18 = 0;
                }else{
                $aat->bw_17_18 = $arr['17_18'];
                }

                if(empty($arr['18_19'])){
                        $aat->bw_18_19 = 0;
                }else{
                $aat->bw_18_19 = $arr['18_19'];
                }
                if(empty($arr['19_20'])){
                        $aat->bw_19_20 = 0;
                }else{
                $aat->bw_19_20 = $arr['19_20'];
                }

                if(empty($arr['20_21'])){
                        $aat->bw_20_21 = 0;
                }else{
                $aat->bw_20_21 = $arr['20_21'];
                }
                if(empty($arr['21_22'])){
                        $aat->bw_21_22 = 0;
                }else{
                $aat->bw_21_22 = $arr['21_22'];
                }
                if(empty($arr['22_23'])){
                        $aat->bw_22_23 = 0;
                }else{
                $aat->bw_22_23 = $arr['22_23'];
                }
                if(empty($arr['23_24'])){
                        $aat->bw_23_24 = 0;
                }else{
                $aat->bw_23_24 = $arr['23_24'];
                }
                if(empty($arr['24_25'])){
                        $aat->bw_24_25 = 0;
                }else{
                $aat->bw_24_25 = $arr['24_25'];
                }
                if(empty($arr['25_26'])){
                        $aat->bw_25_26 = 0;
                }else{
                $aat->bw_25_26 = $arr['25_26'];
                }
                if(empty($arr['26_27'])){
                        $aat->bw_26_27 = 0;
                }else{
                $aat->bw_26_27 = $arr['26_27'];
                }
                if(empty($arr['27_28'])){
                        $aat->bw_27_28 = 0;
                }else{
                $aat->bw_27_28 = $arr['27_28'];
                }
                if(empty($arr['28_29'])){
                        $aat->bw_28_29 = 0;
                }else{
                $aat->bw_28_29 = $arr['28_29'];
                }
                if(empty($arr['29_30'])){
                        $aat->bw_29_30 = 0;
                }else{
                $aat->bw_29_30 = $arr['29_30'];
                }
                if(empty($arr['30_31'])){
                        $aat->bw_30_31 = 0;
                }else{
                $aat->bw_30_31 = $arr['30_31'];
                }
                if(empty($arr['31_32'])){
                        $aat->bw_31_32 = 0;
                }else{
                $aat->bw_31_32 = $arr['31_32'];
                }
                if(empty($arr['32_33'])){
                        $aat->bw_32_33 = 0;
                }else{
                $aat->bw_32_33 = $arr['32_33'];
                }
                if(empty($arr['33_34'])){
                        $aat->bw_33_34 = 0;
                }else{
                $aat->bw_33_34 = $arr['33_34'];
                }
                if(empty($arr['34_35'])){
                        $aat->bw_34_35 = 0;
                }else{
                $aat->bw_34_35 = $arr['34_35'];
                }
                if(empty($arr['35_36'])){
                        $aat->bw_35_36 = 0;
                }else{
                $aat->bw_35_36 = $arr['35_36'];
                }
                if(empty($arr['36_37'])){
                        $aat->bw_36_37 = 0;
                }else{
                $aat->bw_36_37 = $arr['36_37'];
                }
                if(empty($arr['37_38'])){
                        $aat->bw_37_38 = 0;
                }else{
                $aat->bw_37_38 = $arr['37_38'];
                }
                if(empty($arr['38_39'])){
                        $aat->bw_38_39 = 0;
                }else{
                $aat->bw_38_39 = $arr['38_39'];
                }
                if(empty($arr['39_40'])){
                        $aat->bw_39_40 = 0;
                }else{
                $aat->bw_39_40 = $arr['39_40'];
                }
                if(empty($arr['40_41'])){
                        $aat->bw_40_41 = 0;
                }else{
                $aat->bw_40_41 = $arr['40_41'];
                }

                if(empty($arr['41_42'])){
                        $aat->bw_41_42 = 0;
                }else{
                $aat->bw_41_42 = $arr['41_42'];
                }

                if(empty($arr['42_43'])){
                        $aat->bw_42_43 = 0;
                }else{
                $aat->bw_42_43 = $arr['42_43'];
                }
                if(empty($arr['43_44'])){
                        $aat->bw_43_44 = 0;
                }else{
                $aat->bw_43_44 = $arr['43_44'];
                }
                if(empty($arr['44_45'])){
                        $aat->bw_44_45 = 0;
                }else{
                $aat->bw_44_45 = $arr['44_45'];
                }
                if(empty($arr['45_46'])){
                        $aat->bw_45_46 = 0;
                }else{
                $aat->bw_45_46 = $arr['45_46'];
                }
                if(empty($arr['46_47'])){
                        $aat->bw_46_47 = 0;
                }else{
                $aat->bw_46_47 = $arr['46_47'];
                }

                if(empty($arr['47_48'])){
                        $aat->bw_47_48 = 0;
                }else{
                $aat->bw_47_48 = $arr['47_48'];
                }

                if(empty($arr['48_49'])){
                        $aat->bw_48_49 = 0;
                }else{
                $aat->bw_48_49 = $arr['48_49'];
                }
                if(empty($arr['49_50'])){
                        $aat->bw_49_50 = 0;
                }else{
                $aat->bw_49_50 = $arr['49_50'];
                }
                if(empty($arr['50_51'])){
                        $aat->bw_50_51 = 0;
                }else{
                $aat->bw_50_51 = $arr['50_51'];
                }
                if(empty($arr['51_52'])){
                        $aat->bw_51_52 = 0;
                }else{
                $aat->bw_51_52 = $arr['51_52'];
                }
                if(empty($arr['52_plus'])){
                        $aat->plus_52 = 0;
                }else{
                $aat->plus_52 = $arr['52_plus'];
                }
                if(empty($arr['total_number_of_incomplete_pathways'])){
                        $aat->total_number_of_incomplete_pathways = 0;
                }else{
                $aat->total_number_of_incomplete_pathways = $arr['total_number_of_incomplete_pathways'];
                }
                if(empty($arr['total_within_18_weeks'])){
                        $aat->total_within_18_weeks = 0;
                }else{
                $aat->total_within_18_weeks = $arr['total_within_18_weeks'];
                }
                if(empty($arr['within_18_weeks'])){
                        $aat->within_18_weeks = 0;
                }else{
                $aat->within_18_weeks = $arr['within_18_weeks'];
                }
                if(empty($arr['average_median_waiting_time_in_weeks'])){
                        $aat->average_median_waiting_time_in_weeks = 0;
                }else{
                $aat->average_median_waiting_time_in_weeks = $arr['average_median_waiting_time_in_weeks'];
                }
                if(empty($arr['95th_percentile_waiting_time_in_weeks'])){
                        $aat->ninetyfifth_percentile_waiting_time_in_weeks = 0;
                }else{
                $aat->ninetyfifth_percentile_waiting_time_in_weeks = $arr['95th_percentile_waiting_time_in_weeks'];
                }
                if(empty($arr['potential_patients_liable_to_penalty'])){
                        $aat->potential_patients_liable_to_penalty = 0;
                }else{
                $aat->potential_patients_liable_to_penalty = $arr['potential_patients_liable_to_penalty'];
                }
                if(empty($arr['indicative_penalty'])){
                        $aat->indicative_penalty = 0;
                }else{
                $aat->indicative_penalty = $arr['indicative_penalty'];
                }

                $aat->save();
            endforeach;
            return redirect('admin/rtt/incomplete-total');
        }
        else{
            return redirect('admin/rtt/incomplete-total')->withErrors(['errors' =>"Please choose a file"]);
        }
    }

    /*AdmittedAdjusted*/
    public function getAdmittedAdjusted()
    {
        $aat_list = AdmittedAdjusted::paginate(5);
        return view("admin.rtt.admitted-adjusted",compact('aat_list'));
    }
    public function postAdmittedAdjusted(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):
               $aat = new AdmittedAdjusted;

                if(empty($arr['period'])){
                  $aat->period = "Unspecified";  
                }else{
                $aat->period = $arr['period'];
                }

                if(empty($arr['provider_code'])){
                  $aat->provider_code = "Unspecified";  
                }else{
                $aat->provider_code = $arr['provider_code'];
                }

                if(empty($arr['provider_name'])){
                  $aat->provider_name = "Unspecified";  
                }else{
                $aat->provider_name = $arr['provider_name'];
                }


                if(empty($arr['treatment_function_code'])){
                  $aat->treatment_function_code = "Unspecified";  
                }else{
                $aat->treatment_function_code = $arr['treatment_function_code'];
                }

                if(empty($arr['treatment_function'])){
                  $aat->treatment_function = "Unspecified";  
                }else{
                $aat->treatment_function = $arr['treatment_function'];
                }

                if(empty($arr['0_1'])){
                    $aat->bw_0_1 = 0;
                }else{
                $aat->bw_0_1 = $arr['0_1'];
                }


                if(empty($arr['1_2'])){
                    $aat->bw_1_2 = 0;
                }else{
                $aat->bw_1_2 = $arr['1_2'];
                }

                if(empty($arr['2_3'])){
                    $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['2_3'])){
                        $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['3_4'])){
                        $aat->bw_3_4 = 0;
                }else{
                $aat->bw_3_4 = $arr['3_4'];
                }
                
                if(empty($arr['4_5'])){
                        $aat->bw_4_5 = 0;
                }else{
                $aat->bw_4_5 = $arr['4_5'];
                }

                if(empty($arr['5_6'])){
                        $aat->bw_5_6 = 0;
                }else{
                $aat->bw_5_6 = $arr['5_6'];
                }

                if(empty($arr['6_7'])){
                        $aat->bw_6_7 = 0;
                }else{
                $aat->bw_6_7 = $arr['6_7'];
                }
                                        
                if(empty($arr['7_8'])){
                        $aat->bw_7_8 = 0;
                }else{
                $aat->bw_7_8 = $arr['7_8'];
                }

                if(empty($arr['8_9'])){
                        $aat->bw_8_9 = 0;
                }else{
                $aat->bw_8_9 = $arr['8_9'];
                }

                if(empty($arr['9_10'])){
                        $aat->bw_9_10 = 0;
                }else{
                $aat->bw_9_10 = $arr['9_10'];
                }

                if(empty($arr['10_11'])){
                        $aat->bw_10_11 = 0;
                }else{
                $aat->bw_10_11 = $arr['10_11'];
                }

                if(empty($arr['11_12'])){
                        $aat->bw_11_12 = 0;
                }else{
                $aat->bw_11_12 = $arr['11_12'];
                }

                if(empty($arr['12_13'])){
                        $aat->bw_12_13 = 0;
                }else{
                $aat->bw_12_13 = $arr['12_13'];
                }

                if(empty($arr['13_14'])){
                        $aat->bw_13_14 = 0;
                }else{
                $aat->bw_13_14 = $arr['13_14'];
                }

                if(empty($arr['14_15'])){
                        $aat->bw_14_15 = 0;
                }else{
                $aat->bw_14_15 = $arr['14_15'];
                }

                if(empty($arr['15_16'])){
                        $aat->bw_15_16 = 0;
                }else{
                $aat->bw_15_16 = $arr['15_16'];
                }
                if(empty($arr['16_17'])){
                        $aat->bw_16_17 = 0;
                }else{
                $aat->bw_16_17 = $arr['16_17'];
                }

                if(empty($arr['17_18'])){
                        $aat->bw_17_18 = 0;
                }else{
                $aat->bw_17_18 = $arr['17_18'];
                }

                if(empty($arr['18_19'])){
                        $aat->bw_18_19 = 0;
                }else{
                $aat->bw_18_19 = $arr['18_19'];
                }
                if(empty($arr['19_20'])){
                        $aat->bw_19_20 = 0;
                }else{
                $aat->bw_19_20 = $arr['19_20'];
                }

                if(empty($arr['20_21'])){
                        $aat->bw_20_21 = 0;
                }else{
                $aat->bw_20_21 = $arr['20_21'];
                }
                if(empty($arr['21_22'])){
                        $aat->bw_21_22 = 0;
                }else{
                $aat->bw_21_22 = $arr['21_22'];
                }
                if(empty($arr['22_23'])){
                        $aat->bw_22_23 = 0;
                }else{
                $aat->bw_22_23 = $arr['22_23'];
                }
                if(empty($arr['23_24'])){
                        $aat->bw_23_24 = 0;
                }else{
                $aat->bw_23_24 = $arr['23_24'];
                }
                if(empty($arr['24_25'])){
                        $aat->bw_24_25 = 0;
                }else{
                $aat->bw_24_25 = $arr['24_25'];
                }
                if(empty($arr['25_26'])){
                        $aat->bw_25_26 = 0;
                }else{
                $aat->bw_25_26 = $arr['25_26'];
                }
                if(empty($arr['26_27'])){
                        $aat->bw_26_27 = 0;
                }else{
                $aat->bw_26_27 = $arr['26_27'];
                }
                if(empty($arr['27_28'])){
                        $aat->bw_27_28 = 0;
                }else{
                $aat->bw_27_28 = $arr['27_28'];
                }
                if(empty($arr['28_29'])){
                        $aat->bw_28_29 = 0;
                }else{
                $aat->bw_28_29 = $arr['28_29'];
                }
                if(empty($arr['29_30'])){
                        $aat->bw_29_30 = 0;
                }else{
                $aat->bw_29_30 = $arr['29_30'];
                }
                if(empty($arr['30_31'])){
                        $aat->bw_30_31 = 0;
                }else{
                $aat->bw_30_31 = $arr['30_31'];
                }
                if(empty($arr['31_32'])){
                        $aat->bw_31_32 = 0;
                }else{
                $aat->bw_31_32 = $arr['31_32'];
                }
                if(empty($arr['32_33'])){
                        $aat->bw_32_33 = 0;
                }else{
                $aat->bw_32_33 = $arr['32_33'];
                }
                if(empty($arr['33_34'])){
                        $aat->bw_33_34 = 0;
                }else{
                $aat->bw_33_34 = $arr['33_34'];
                }
                if(empty($arr['34_35'])){
                        $aat->bw_34_35 = 0;
                }else{
                $aat->bw_34_35 = $arr['34_35'];
                }
                if(empty($arr['35_36'])){
                        $aat->bw_35_36 = 0;
                }else{
                $aat->bw_35_36 = $arr['35_36'];
                }
                if(empty($arr['36_37'])){
                        $aat->bw_36_37 = 0;
                }else{
                $aat->bw_36_37 = $arr['36_37'];
                }
                if(empty($arr['37_38'])){
                        $aat->bw_37_38 = 0;
                }else{
                $aat->bw_37_38 = $arr['37_38'];
                }
                if(empty($arr['38_39'])){
                        $aat->bw_38_39 = 0;
                }else{
                $aat->bw_38_39 = $arr['38_39'];
                }
                if(empty($arr['39_40'])){
                        $aat->bw_39_40 = 0;
                }else{
                $aat->bw_39_40 = $arr['39_40'];
                }
                if(empty($arr['40_41'])){
                        $aat->bw_40_41 = 0;
                }else{
                $aat->bw_40_41 = $arr['40_41'];
                }

                if(empty($arr['41_42'])){
                        $aat->bw_41_42 = 0;
                }else{
                $aat->bw_41_42 = $arr['41_42'];
                }

                if(empty($arr['42_43'])){
                        $aat->bw_42_43 = 0;
                }else{
                $aat->bw_42_43 = $arr['42_43'];
                }
                if(empty($arr['43_44'])){
                        $aat->bw_43_44 = 0;
                }else{
                $aat->bw_43_44 = $arr['43_44'];
                }
                if(empty($arr['44_45'])){
                        $aat->bw_44_45 = 0;
                }else{
                $aat->bw_44_45 = $arr['44_45'];
                }
                if(empty($arr['45_46'])){
                        $aat->bw_45_46 = 0;
                }else{
                $aat->bw_45_46 = $arr['45_46'];
                }
                if(empty($arr['46_47'])){
                        $aat->bw_46_47 = 0;
                }else{
                $aat->bw_46_47 = $arr['46_47'];
                }

                if(empty($arr['47_48'])){
                        $aat->bw_47_48 = 0;
                }else{
                $aat->bw_47_48 = $arr['47_48'];
                }

                if(empty($arr['48_49'])){
                        $aat->bw_48_49 = 0;
                }else{
                $aat->bw_48_49 = $arr['48_49'];
                }
                if(empty($arr['49_50'])){
                        $aat->bw_49_50 = 0;
                }else{
                $aat->bw_49_50 = $arr['49_50'];
                }
                if(empty($arr['50_51'])){
                        $aat->bw_50_51 = 0;
                }else{
                $aat->bw_50_51 = $arr['50_51'];
                }
                if(empty($arr['51_52'])){
                        $aat->bw_51_52 = 0;
                }else{
                $aat->bw_51_52 = $arr['51_52'];
                }
                if(empty($arr['52_plus'])){
                        $aat->plus_52 = 0;
                }else{
                $aat->plus_52 = $arr['52_plus'];
                }
                if(empty($arr['patients_with_unknown_clock_start_date'])){
                        $aat->patients_with_unknown_clock_start_date = 0;
                }else{
                $aat->patients_with_unknown_clock_start_date = $arr['patients_with_unknown_clock_start_date'];
                }
                if(empty($arr['total_number_of_completed_pathways_all'])){
                        $aat->total_number_of_completed_pathways_all = 0;
                }else{
                $aat->total_number_of_completed_pathways_all = $arr['total_number_of_completed_pathways_all'];
                }
                if(empty($arr['total_number_of_completed_pathways_with_a_known_clock_start'])){
                        $aat->total_number_of_completed_pathways_with_a_known_clock_start = 0;
                }else{
                $aat->total_number_of_completed_pathways_with_a_known_clock_start = $arr['total_number_of_completed_pathways_with_a_known_clock_start'];
                }
                if(empty($arr['total_with_a_known_clock_start_within_18_weeks'])){
                        $aat->total_with_a_known_clock_start_within_18_weeks = 0;
                }else{
                $aat->total_with_a_known_clock_start_within_18_weeks = $arr['total_with_a_known_clock_start_within_18_weeks'];
                }
                if(empty($arr['within_18_weeks'])){
                        $aat->within_18_weeks = 0;
                }else{
                $aat->within_18_weeks = $arr['within_18_weeks'];
                }
                if(empty($arr['average_median_waiting_time_in_weeks'])){
                        $aat->average_median_waiting_time_in_weeks = 0;
                }else{
                $aat->average_median_waiting_time_in_weeks = $arr['average_median_waiting_time_in_weeks'];
                }
                if(empty($arr['95th_percentile_waiting_time_in_weeks'])){
                        $aat->ninetyfifth_percentile_waiting_time_in_weeks = 0;
                }else{
                $aat->ninetyfifth_percentile_waiting_time_in_weeks = $arr['95th_percentile_waiting_time_in_weeks'];
                }

                $aat->save();
            endforeach;
            return redirect('admin/rtt/admitted-adjusted');
        }
        else{
            return redirect('admin/rtt/admitted-adjusted')->withErrors(['errors' =>"Please choose a file"]);
        }
        // echo "getAdmittedAdjusted";
    }

    /*NonAdmitted*/
    public function getNonAdmitted()
    {
        $aat_list = NonAdmitted::paginate(5);

        return view("admin.rtt.non-admitted", compact('aat_list'));
    }
    public function postNonAdmitted(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):
                //dd($arr);
                $aat = new NonAdmitted;

                if(empty($arr['period'])){
                  $aat->period = "Unspecified";  
                }else{
                $aat->period = $arr['period'];
                }

                if(empty($arr['provider_code'])){
                  $aat->provider_code = "Unspecified";  
                }else{
                $aat->provider_code = $arr['provider_code'];
                }

                if(empty($arr['provider_name'])){
                  $aat->provider_name = "Unspecified";  
                }else{
                $aat->provider_name = $arr['provider_name'];
                }


                if(empty($arr['treatment_function_code'])){
                  $aat->treatment_function_code = "Unspecified";  
                }else{
                $aat->treatment_function_code = $arr['treatment_function_code'];
                }

                if(empty($arr['treatment_function'])){
                  $aat->treatment_function = "Unspecified";  
                }else{
                $aat->treatment_function = $arr['treatment_function'];
                }

                if(empty($arr['0_1'])){
                    $aat->bw_0_1 = 0;
                }else{
                $aat->bw_0_1 = $arr['0_1'];
                }


                if(empty($arr['1_2'])){
                    $aat->bw_1_2 = 0;
                }else{
                $aat->bw_1_2 = $arr['1_2'];
                }

                if(empty($arr['2_3'])){
                    $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['2_3'])){
                        $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['3_4'])){
                        $aat->bw_3_4 = 0;
                }else{
                $aat->bw_3_4 = $arr['3_4'];
                }
                
                if(empty($arr['4_5'])){
                        $aat->bw_4_5 = 0;
                }else{
                $aat->bw_4_5 = $arr['4_5'];
                }

                if(empty($arr['5_6'])){
                        $aat->bw_5_6 = 0;
                }else{
                $aat->bw_5_6 = $arr['5_6'];
                }

                if(empty($arr['6_7'])){
                        $aat->bw_6_7 = 0;
                }else{
                $aat->bw_6_7 = $arr['6_7'];
                }
                                        
                if(empty($arr['7_8'])){
                        $aat->bw_7_8 = 0;
                }else{
                $aat->bw_7_8 = $arr['7_8'];
                }

                if(empty($arr['8_9'])){
                        $aat->bw_8_9 = 0;
                }else{
                $aat->bw_8_9 = $arr['8_9'];
                }

                if(empty($arr['9_10'])){
                        $aat->bw_9_10 = 0;
                }else{
                $aat->bw_9_10 = $arr['9_10'];
                }

                if(empty($arr['10_11'])){
                        $aat->bw_10_11 = 0;
                }else{
                $aat->bw_10_11 = $arr['10_11'];
                }

                if(empty($arr['11_12'])){
                        $aat->bw_11_12 = 0;
                }else{
                $aat->bw_11_12 = $arr['11_12'];
                }

                if(empty($arr['12_13'])){
                        $aat->bw_12_13 = 0;
                }else{
                $aat->bw_12_13 = $arr['12_13'];
                }

                if(empty($arr['13_14'])){
                        $aat->bw_13_14 = 0;
                }else{
                $aat->bw_13_14 = $arr['13_14'];
                }

                if(empty($arr['14_15'])){
                        $aat->bw_14_15 = 0;
                }else{
                $aat->bw_14_15 = $arr['14_15'];
                }

                if(empty($arr['15_16'])){
                        $aat->bw_15_16 = 0;
                }else{
                $aat->bw_15_16 = $arr['15_16'];
                }
                if(empty($arr['16_17'])){
                        $aat->bw_16_17 = 0;
                }else{
                $aat->bw_16_17 = $arr['16_17'];
                }

                if(empty($arr['17_18'])){
                        $aat->bw_17_18 = 0;
                }else{
                $aat->bw_17_18 = $arr['17_18'];
                }

                if(empty($arr['18_19'])){
                        $aat->bw_18_19 = 0;
                }else{
                $aat->bw_18_19 = $arr['18_19'];
                }
                if(empty($arr['19_20'])){
                        $aat->bw_19_20 = 0;
                }else{
                $aat->bw_19_20 = $arr['19_20'];
                }

                if(empty($arr['20_21'])){
                        $aat->bw_20_21 = 0;
                }else{
                $aat->bw_20_21 = $arr['20_21'];
                }
                if(empty($arr['21_22'])){
                        $aat->bw_21_22 = 0;
                }else{
                $aat->bw_21_22 = $arr['21_22'];
                }
                if(empty($arr['22_23'])){
                        $aat->bw_22_23 = 0;
                }else{
                $aat->bw_22_23 = $arr['22_23'];
                }
                if(empty($arr['23_24'])){
                        $aat->bw_23_24 = 0;
                }else{
                $aat->bw_23_24 = $arr['23_24'];
                }
                if(empty($arr['24_25'])){
                        $aat->bw_24_25 = 0;
                }else{
                $aat->bw_24_25 = $arr['24_25'];
                }
                if(empty($arr['25_26'])){
                        $aat->bw_25_26 = 0;
                }else{
                $aat->bw_25_26 = $arr['25_26'];
                }
                if(empty($arr['26_27'])){
                        $aat->bw_26_27 = 0;
                }else{
                $aat->bw_26_27 = $arr['26_27'];
                }
                if(empty($arr['27_28'])){
                        $aat->bw_27_28 = 0;
                }else{
                $aat->bw_27_28 = $arr['27_28'];
                }
                if(empty($arr['28_29'])){
                        $aat->bw_28_29 = 0;
                }else{
                $aat->bw_28_29 = $arr['28_29'];
                }
                if(empty($arr['29_30'])){
                        $aat->bw_29_30 = 0;
                }else{
                $aat->bw_29_30 = $arr['29_30'];
                }
                if(empty($arr['30_31'])){
                        $aat->bw_30_31 = 0;
                }else{
                $aat->bw_30_31 = $arr['30_31'];
                }
                if(empty($arr['31_32'])){
                        $aat->bw_31_32 = 0;
                }else{
                $aat->bw_31_32 = $arr['31_32'];
                }
                if(empty($arr['32_33'])){
                        $aat->bw_32_33 = 0;
                }else{
                $aat->bw_32_33 = $arr['32_33'];
                }
                if(empty($arr['33_34'])){
                        $aat->bw_33_34 = 0;
                }else{
                $aat->bw_33_34 = $arr['33_34'];
                }
                if(empty($arr['34_35'])){
                        $aat->bw_34_35 = 0;
                }else{
                $aat->bw_34_35 = $arr['34_35'];
                }
                if(empty($arr['35_36'])){
                        $aat->bw_35_36 = 0;
                }else{
                $aat->bw_35_36 = $arr['35_36'];
                }
                if(empty($arr['36_37'])){
                        $aat->bw_36_37 = 0;
                }else{
                $aat->bw_36_37 = $arr['36_37'];
                }
                if(empty($arr['37_38'])){
                        $aat->bw_37_38 = 0;
                }else{
                $aat->bw_37_38 = $arr['37_38'];
                }
                if(empty($arr['38_39'])){
                        $aat->bw_38_39 = 0;
                }else{
                $aat->bw_38_39 = $arr['38_39'];
                }
                if(empty($arr['39_40'])){
                        $aat->bw_39_40 = 0;
                }else{
                $aat->bw_39_40 = $arr['39_40'];
                }
                if(empty($arr['40_41'])){
                        $aat->bw_40_41 = 0;
                }else{
                $aat->bw_40_41 = $arr['40_41'];
                }

                if(empty($arr['41_42'])){
                        $aat->bw_41_42 = 0;
                }else{
                $aat->bw_41_42 = $arr['41_42'];
                }

                if(empty($arr['42_43'])){
                        $aat->bw_42_43 = 0;
                }else{
                $aat->bw_42_43 = $arr['42_43'];
                }
                if(empty($arr['43_44'])){
                        $aat->bw_43_44 = 0;
                }else{
                $aat->bw_43_44 = $arr['43_44'];
                }
                if(empty($arr['44_45'])){
                        $aat->bw_44_45 = 0;
                }else{
                $aat->bw_44_45 = $arr['44_45'];
                }
                if(empty($arr['45_46'])){
                        $aat->bw_45_46 = 0;
                }else{
                $aat->bw_45_46 = $arr['45_46'];
                }
                if(empty($arr['46_47'])){
                        $aat->bw_46_47 = 0;
                }else{
                $aat->bw_46_47 = $arr['46_47'];
                }

                if(empty($arr['47_48'])){
                        $aat->bw_47_48 = 0;
                }else{
                $aat->bw_47_48 = $arr['47_48'];
                }

                if(empty($arr['48_49'])){
                        $aat->bw_48_49 = 0;
                }else{
                $aat->bw_48_49 = $arr['48_49'];
                }
                if(empty($arr['49_50'])){
                        $aat->bw_49_50 = 0;
                }else{
                $aat->bw_49_50 = $arr['49_50'];
                }
                if(empty($arr['50_51'])){
                        $aat->bw_50_51 = 0;
                }else{
                $aat->bw_50_51 = $arr['50_51'];
                }
                if(empty($arr['51_52'])){
                        $aat->bw_51_52 = 0;
                }else{
                $aat->bw_51_52 = $arr['51_52'];
                }
                if(empty($arr['52_plus'])){
                        $aat->plus_52 = 0;
                }else{
                $aat->plus_52 = $arr['52_plus'];
                }

                if(empty($arr['patients_with_unknown_clock_start_date'])){
                        $aat->patients_with_unknown_clock_start_date = 0;
                }else{
                $aat->patients_with_unknown_clock_start_date = $arr['patients_with_unknown_clock_start_date'];
                }

                if(empty($arr['total_number_of_completed_pathways_all'])){
                        $aat->total_number_of_completed_pathways_all = 0;
                }else{
                $aat->total_number_of_completed_pathways_all = $arr['total_number_of_completed_pathways_all'];
                }

                if(empty($arr['total_number_of_completed_pathways_with_a_known_clock_start'])){
                        $aat->total_number_of_completed_pathways_with_a_known_clock_start = 0;
                }else{
                $aat->total_number_of_completed_pathways_with_a_known_clock_start = $arr['total_number_of_completed_pathways_with_a_known_clock_start'];
                }

                if(empty($arr['total_with_a_known_clock_start_within_18_weeks'])){
                        $aat->total_with_a_known_clock_start_within_18_weeks = 0;
                }else{
                $aat->total_with_a_known_clock_start_within_18_weeks = $arr['total_with_a_known_clock_start_within_18_weeks'];
                }
                if(empty($arr['within_18_weeks'])){
                        $aat->within_18_weeks = 0;
                }else{
                $aat->within_18_weeks = $arr['within_18_weeks'];
                }
                if(empty($arr['average_median_waiting_time_in_weeks'])){
                        $aat->average_median_waiting_time_in_weeks = 0;
                }else{
                $aat->average_median_waiting_time_in_weeks = $arr['average_median_waiting_time_in_weeks'];
                }
                if(empty($arr['95th_percentile_waiting_time_in_weeks'])){
                        $aat->ninetyfifth_percentile_waiting_time_in_weeks = 0;
                }else{
                $aat->ninetyfifth_percentile_waiting_time_in_weeks = $arr['95th_percentile_waiting_time_in_weeks'];
                }
               
                $aat->save();
            endforeach;
            return redirect('admin/rtt/non-admitted');
        }
        else{
            return redirect('admin/rtt/non-admitted')->withErrors(['errors' =>"Please choose a file"]);
        }
    }

    /*Incomplete*/
    public function getIncomplete()
    {
        $aat_list = Incomplete::paginate(5);
        return view("admin.rtt.incomplete", compact('aat_list'));
    }
    public function postIncomplete(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):

                $aat = new Incomplete;

                if(empty($arr['period'])){
                  $aat->period = "Unspecified";  
                }else{
                $aat->period = $arr['period'];
                }

                if(empty($arr['provider_code'])){
                  $aat->provider_code = "Unspecified";  
                }else{
                $aat->provider_code = $arr['provider_code'];
                }

                if(empty($arr['provider_name'])){
                  $aat->provider_name = "Unspecified";  
                }else{
                $aat->provider_name = $arr['provider_name'];
                }


                if(empty($arr['treatment_function_code'])){
                  $aat->treatment_function_code = "Unspecified";  
                }else{
                $aat->treatment_function_code = $arr['treatment_function_code'];
                }

                if(empty($arr['treatment_function'])){
                  $aat->treatment_function = "Unspecified";  
                }else{
                $aat->treatment_function = $arr['treatment_function'];
                }
                if(empty($arr['0_1'])){
                    $aat->bw_0_1 = 0;
                }else{
                $aat->bw_0_1 = $arr['0_1'];
                }


                if(empty($arr['1_2'])){
                    $aat->bw_1_2 = 0;
                }else{
                $aat->bw_1_2 = $arr['1_2'];
                }

                if(empty($arr['2_3'])){
                    $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['2_3'])){
                        $aat->bw_2_3 = 0;
                }else{
                $aat->bw_2_3 = $arr['2_3'];
                }

                if(empty($arr['3_4'])){
                        $aat->bw_3_4 = 0;
                }else{
                $aat->bw_3_4 = $arr['3_4'];
                }
                
                if(empty($arr['4_5'])){
                        $aat->bw_4_5 = 0;
                }else{
                $aat->bw_4_5 = $arr['4_5'];
                }

                if(empty($arr['5_6'])){
                        $aat->bw_5_6 = 0;
                }else{
                $aat->bw_5_6 = $arr['5_6'];
                }

                if(empty($arr['6_7'])){
                        $aat->bw_6_7 = 0;
                }else{
                $aat->bw_6_7 = $arr['6_7'];
                }
                                        
                if(empty($arr['7_8'])){
                        $aat->bw_7_8 = 0;
                }else{
                $aat->bw_7_8 = $arr['7_8'];
                }

                if(empty($arr['8_9'])){
                        $aat->bw_8_9 = 0;
                }else{
                $aat->bw_8_9 = $arr['8_9'];
                }

                if(empty($arr['9_10'])){
                        $aat->bw_9_10 = 0;
                }else{
                $aat->bw_9_10 = $arr['9_10'];
                }

                if(empty($arr['10_11'])){
                        $aat->bw_10_11 = 0;
                }else{
                $aat->bw_10_11 = $arr['10_11'];
                }

                if(empty($arr['11_12'])){
                        $aat->bw_11_12 = 0;
                }else{
                $aat->bw_11_12 = $arr['11_12'];
                }

                if(empty($arr['12_13'])){
                        $aat->bw_12_13 = 0;
                }else{
                $aat->bw_12_13 = $arr['12_13'];
                }

                if(empty($arr['13_14'])){
                        $aat->bw_13_14 = 0;
                }else{
                $aat->bw_13_14 = $arr['13_14'];
                }

                if(empty($arr['14_15'])){
                        $aat->bw_14_15 = 0;
                }else{
                $aat->bw_14_15 = $arr['14_15'];
                }

                if(empty($arr['15_16'])){
                        $aat->bw_15_16 = 0;
                }else{
                $aat->bw_15_16 = $arr['15_16'];
                }
                if(empty($arr['16_17'])){
                        $aat->bw_16_17 = 0;
                }else{
                $aat->bw_16_17 = $arr['16_17'];
                }

                if(empty($arr['17_18'])){
                        $aat->bw_17_18 = 0;
                }else{
                $aat->bw_17_18 = $arr['17_18'];
                }

                if(empty($arr['18_19'])){
                        $aat->bw_18_19 = 0;
                }else{
                $aat->bw_18_19 = $arr['18_19'];
                }
                if(empty($arr['19_20'])){
                        $aat->bw_19_20 = 0;
                }else{
                $aat->bw_19_20 = $arr['19_20'];
                }

                if(empty($arr['20_21'])){
                        $aat->bw_20_21 = 0;
                }else{
                $aat->bw_20_21 = $arr['20_21'];
                }
                if(empty($arr['21_22'])){
                        $aat->bw_21_22 = 0;
                }else{
                $aat->bw_21_22 = $arr['21_22'];
                }
                if(empty($arr['22_23'])){
                        $aat->bw_22_23 = 0;
                }else{
                $aat->bw_22_23 = $arr['22_23'];
                }
                if(empty($arr['23_24'])){
                        $aat->bw_23_24 = 0;
                }else{
                $aat->bw_23_24 = $arr['23_24'];
                }
                if(empty($arr['24_25'])){
                        $aat->bw_24_25 = 0;
                }else{
                $aat->bw_24_25 = $arr['24_25'];
                }
                if(empty($arr['25_26'])){
                        $aat->bw_25_26 = 0;
                }else{
                $aat->bw_25_26 = $arr['25_26'];
                }
                if(empty($arr['26_27'])){
                        $aat->bw_26_27 = 0;
                }else{
                $aat->bw_26_27 = $arr['26_27'];
                }
                if(empty($arr['27_28'])){
                        $aat->bw_27_28 = 0;
                }else{
                $aat->bw_27_28 = $arr['27_28'];
                }
                if(empty($arr['28_29'])){
                        $aat->bw_28_29 = 0;
                }else{
                $aat->bw_28_29 = $arr['28_29'];
                }
                if(empty($arr['29_30'])){
                        $aat->bw_29_30 = 0;
                }else{
                $aat->bw_29_30 = $arr['29_30'];
                }
                if(empty($arr['30_31'])){
                        $aat->bw_30_31 = 0;
                }else{
                $aat->bw_30_31 = $arr['30_31'];
                }
                if(empty($arr['31_32'])){
                        $aat->bw_31_32 = 0;
                }else{
                $aat->bw_31_32 = $arr['31_32'];
                }
                if(empty($arr['32_33'])){
                        $aat->bw_32_33 = 0;
                }else{
                $aat->bw_32_33 = $arr['32_33'];
                }
                if(empty($arr['33_34'])){
                        $aat->bw_33_34 = 0;
                }else{
                $aat->bw_33_34 = $arr['33_34'];
                }
                if(empty($arr['34_35'])){
                        $aat->bw_34_35 = 0;
                }else{
                $aat->bw_34_35 = $arr['34_35'];
                }
                if(empty($arr['35_36'])){
                        $aat->bw_35_36 = 0;
                }else{
                $aat->bw_35_36 = $arr['35_36'];
                }
                if(empty($arr['36_37'])){
                        $aat->bw_36_37 = 0;
                }else{
                $aat->bw_36_37 = $arr['36_37'];
                }
                if(empty($arr['37_38'])){
                        $aat->bw_37_38 = 0;
                }else{
                $aat->bw_37_38 = $arr['37_38'];
                }
                if(empty($arr['38_39'])){
                        $aat->bw_38_39 = 0;
                }else{
                $aat->bw_38_39 = $arr['38_39'];
                }
                if(empty($arr['39_40'])){
                        $aat->bw_39_40 = 0;
                }else{
                $aat->bw_39_40 = $arr['39_40'];
                }
                if(empty($arr['40_41'])){
                        $aat->bw_40_41 = 0;
                }else{
                $aat->bw_40_41 = $arr['40_41'];
                }

                if(empty($arr['41_42'])){
                        $aat->bw_41_42 = 0;
                }else{
                $aat->bw_41_42 = $arr['41_42'];
                }

                if(empty($arr['42_43'])){
                        $aat->bw_42_43 = 0;
                }else{
                $aat->bw_42_43 = $arr['42_43'];
                }
                if(empty($arr['43_44'])){
                        $aat->bw_43_44 = 0;
                }else{
                $aat->bw_43_44 = $arr['43_44'];
                }
                if(empty($arr['44_45'])){
                        $aat->bw_44_45 = 0;
                }else{
                $aat->bw_44_45 = $arr['44_45'];
                }
                if(empty($arr['45_46'])){
                        $aat->bw_45_46 = 0;
                }else{
                $aat->bw_45_46 = $arr['45_46'];
                }
                if(empty($arr['46_47'])){
                        $aat->bw_46_47 = 0;
                }else{
                $aat->bw_46_47 = $arr['46_47'];
                }

                if(empty($arr['47_48'])){
                        $aat->bw_47_48 = 0;
                }else{
                $aat->bw_47_48 = $arr['47_48'];
                }

                if(empty($arr['48_49'])){
                        $aat->bw_48_49 = 0;
                }else{
                $aat->bw_48_49 = $arr['48_49'];
                }
                if(empty($arr['49_50'])){
                        $aat->bw_49_50 = 0;
                }else{
                $aat->bw_49_50 = $arr['49_50'];
                }
                if(empty($arr['50_51'])){
                        $aat->bw_50_51 = 0;
                }else{
                $aat->bw_50_51 = $arr['50_51'];
                }
                if(empty($arr['51_52'])){
                        $aat->bw_51_52 = 0;
                }else{
                $aat->bw_51_52 = $arr['51_52'];
                }
                if(empty($arr['52_plus'])){
                        $aat->plus_52 = 0;
                }else{
                $aat->plus_52 = $arr['52_plus'];
                }

                if(empty($arr['total_number_of_incomplete_pathways'])){
                        $aat->total_number_of_incomplete_pathways = 0;
                }else{
                $aat->total_number_of_incomplete_pathways = $arr['total_number_of_incomplete_pathways'];
                }
                if(empty($arr['total_within_18_weeks'])){
                        $aat->total_within_18_weeks = 0;
                }else{
                $aat->total_within_18_weeks = $arr['total_within_18_weeks'];
                }
                if(empty($arr['within_18_weeks'])){
                        $aat->within_18_weeks = 0;
                }else{
                $aat->within_18_weeks = $arr['within_18_weeks'];
                }
                if(empty($arr['average_median_waiting_time_in_weeks'])){
                        $aat->average_median_waiting_time_in_weeks = 0;
                }else{
                $aat->average_median_waiting_time_in_weeks = $arr['average_median_waiting_time_in_weeks'];
                }
                if(empty($arr['95th_percentile_waiting_time_in_weeks'])){
                        $aat->ninetyfifth_percentile_waiting_time_in_weeks = 0;
                }else{
                $aat->ninetyfifth_percentile_waiting_time_in_weeks = $arr['95th_percentile_waiting_time_in_weeks'];
                }
                
                $aat->save();
            endforeach;
            return redirect('admin/rtt/incomplete');
        }
        else{
            return redirect('admin/rtt/incomplete')->withErrors(['errors' =>"Please choose a file"]);
        }
    }
    public function getNonAdmittedTotalSearch(Request $request)
    {
        $keyword = $request['search'];
        $non_admitted_total = NonAdmittedTotal::where('provider_code', 'LIKE','%'.$keyword.'%')
                                ->orWhere('provider_name', 'LIKE','%'.$keyword.'%')
                                ->orWhere('treatment_function_code', 'LIKE','%'.$keyword.'%')
                                ->paginate(1);
        return view('admin/rtt/non-admitted-total-search', compact('non_admitted_total'));
    }
    /* InComplete search */
    public function getInCompleteSearch(Request $request)
    {
        $keyword = $request['search'];
        $incomplete_search = Incomplete::where('provider_code', 'LIKE','%'.$keyword.'%')
                                ->orWhere('provider_name', 'LIKE','%'.$keyword.'%')
                                ->orWhere('treatment_function_code', 'LIKE','%'.$keyword.'%')
                                ->paginate(1);
        return view('admin/rtt/incomplete-search', compact('incomplete_search'));
    }
    public function getInCompleteTotalSearch(Request $request)
    {
        $keyword = $request['search'];
        $incomplete_total_search = IncompleteTotal::where('provider_code', 'LIKE','%'.$keyword.'%')
                                ->orWhere('provider_name', 'LIKE','%'.$keyword.'%')
                                ->orWhere('treatment_function_code', 'LIKE','%'.$keyword.'%')
                                ->paginate(1);
        return view('admin/rtt/incomplete-total-search', compact('incomplete_total_search'));
    }
    public function getAdmittedSearch(Request $request)
    {
        $keyword = $request['search'];
        $admitted_list = AdmittedAdjusted::where('treatment_function_code', 'LIKE','%'.$keyword.'%')
                  ->orWhere('provider_code', 'LIKE','%'.$keyword.'%')
                  ->orWhere('provider_name', 'LIKE','%'.$keyword.'%')
                  ->orWhere('treatment_function', 'LIKE','%'.$keyword.'%')
                  ->paginate(5);
        return view('admin/rtt/admitted-search', compact('admitted_list'));
    }
    public function getAdmittedTotalSearch(Request $request)
    {
        $keyword = $request['search'];
        $adm_total_list = AdmittedAdjustedTotal::where('provider_name', 'LIKE','%'.$keyword.'%')
                  ->orWhere('treatment_function_code', 'LIKE','%'.$keyword.'%')
                  ->orWhere('provider_code', 'LIKE','%'.$keyword.'%')
                  ->orWhere('treatment_function', 'LIKE','%'.$keyword.'%')
                  ->paginate(5);
        return view('admin/rtt/admitted-total-search', compact('adm_total_list'));
    }
    public function getNonAdmittedSearch(Request $request)
    {
        $keyword = $request['search'];
        $non_admitted_list = NonAdmitted::where('treatment_function_code', 'LIKE','%'.$keyword.'%')
                  ->orWhere('provider_code', 'LIKE','%'.$keyword.'%')
                  ->orWhere('provider_name', 'LIKE','%'.$keyword.'%')
                  ->orWhere('treatment_function', 'LIKE','%'.$keyword.'%')
                  ->paginate(5);
        return view('admin/rtt/non-admitted-search', compact('non_admitted_list'));
    }
}
