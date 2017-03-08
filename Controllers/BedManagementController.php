<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Input;
use App\Models\PatientList;

class BedManagementController extends Controller
{
	public function getPatientList()
    {
        $pl_list = PatientList::paginate(5);
        return view("admin.bed-management.patient-list", compact('pl_list'));
    }
    public function postPatientList(Request $request)
    {
        if ($request->hasFile('excel-data')) {
            $excelChecker = Excel::selectSheetsByIndex(0)->load(Input::file('excel-data'), function($reader){})->get()->toArray();
            foreach($excelChecker as $arr):
                $pl = new PatientList;

                $pl->room = $arr['room'];
                $pl->patient_name = $arr['patient_name'];
                $pl->bed_name = $arr['bed_name'];
                $pl->monitored_bed = $arr['monitored_bed'];
                $pl->side_room = $arr['side_room'];
                $pl->admit_dttm = $arr['admit_dttm'];
                $pl->ed_dttm = $arr['ed_dttm'];
                $pl->medfit_dttm = $arr['medfit_dttm'];
                $pl->patient_hosp_id = $arr['patient_hosp_id'];
                $pl->ip_spell_id = $arr['ip_spell_id'];
                $pl->disch_dttm = $arr['disch_dttm'];
                $pl->curr_spec_desc = $arr['curr_spec_desc'];
                $pl->curr_bay_desc = $arr['curr_bay_desc'];
                $pl->curr_bed_desc = $arr['curr_bed_desc'];
                $pl->ward_start_dttm = $arr['ward_start_dttm'];
                $pl->ward_stay = $arr['ward_stay'];
                $pl->disch_delay_rsn_desc = $arr['disch_delay_rsn_desc'];
                $pl->hfq_proforma_ext_id = $arr['hfq_proforma_ext_id'];
                $pl->proforma_type = $arr['proforma_type'];
                $pl->proforma_name = $arr['proforma_name'];
                $pl->proforma_dttm = $arr['proforma_dttm'];
                $pl->news = $arr['news'];
                $pl->date_time = $arr['date_time'];
                $pl->actual_ward_pending = $arr['actual_ward_pending'];
                $pl->preferred_ward = $arr['preferred_ward'];
                
                $pl->save();
            endforeach;
            return redirect('admin/bed-management/patient-list');
        }
        else{
            return redirect('admin/bed-management/patient-list')->withErrors(['errors' =>"Please choose a file"]);
        }
    }
     public function getPatientDetailsView($id){

       $p_view =  PatientList::where('id', $id)->first();


        return view("admin.bed-management.patient-details-view", compact('p_view'));


    }
    public function getSearchList(Request $request)
    {
        $keyword = $request['search']; 
        $query = PatientList::where('room', 'LIKE','%'.$keyword.'%')
                ->orWhere('patient_name', 'LIKE','%'.$keyword.'%')
                ->orWhere('monitored_bed', 'LIKE','%'.$keyword.'%')
                ->orWhere('bed_name', 'LIKE','%'.$keyword.'%')
                ->paginate(5);
        return view('admin/bed-management/search-list', compact('query'));
    
    }

}