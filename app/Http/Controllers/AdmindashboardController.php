<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Session;
use Sentinel;

class AdmindashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {

        $userLogin = array();
        $query = "CALL `sp_admin_dashboard_user_login_30days`()";
        $userLogins = DB::select($query);

        $CurrentUserLogin = DB::select("SELECT Count(distinct user_id) as no_user_login FROM `active_users`  WHERE updated_at > TIMESTAMP(
        NOW() -  interval 5 minute )");

        foreach ($CurrentUserLogin as $Currentuser) {
            $userLogin['no_user_login'] = $Currentuser->no_user_login;
        }
        foreach ($userLogins as $user) {
            $userLogin['user_login_count'] = $user->user_login_count;
            $userLogin['total_count'] = $user->total_count;
        }
        /*$from = date('Y-m-d', strtotime('-1 month'));
        $to = date('Y-m-d');
        $logspage = DB::table('logs_page')
            ->select([
                DB::raw('page_title AS page_title'),
                DB::raw('COUNT(page_title)*100/((COUNT(*))) AS count')])

            ->whereBetween('view_time', [$from, $to])
            ->groupBy('page_title')
            ->orderBy('count', 'DESC')
            ->limit('5')
            ->get('count');*/
        $queryW = "CALL `sp_admin_dashboard_ward`()";
        $wards = DB::select($queryW);
        $graphDataforWard = array();
        foreach ($wards as $ward) {
            $graphDataforWard[] = $ward;
        }

        $query = "CALL `sp_admin_dashboard_page`()";
        $logspage = DB::select($query);
        $graphDataforPage = array();
        foreach ($logspage as $page) {
            $graphDataforPage[] = $page;
        }
         $data_title ='admin';
        $data_sub_title ='admin';
        return view('admin.home', compact('userLogin', 'graphDataforWard', 'graphDataforPage','data_title','data_sub_title'));
    }
    /**
     * Insert User Logs
     *
     *
     */

    public function userLogInsert($insertData){
        $user = Sentinel::check();
        $sessionid = Session::getId();
        foreach(array($insertData) as $key => $data){
            $user_id = $user->id;
            $created_time = date("Y-m-d H:i:s");
            $user_activity = $data['user_activity'];
            $page_title =$data['page_title'];
            $user_activity_item_id=$data['user_activity_item_id'];
            $user_activity_item=$data['user_activity_item'];
        }
        $res = DB::table('admin_user_logs')
            ->insert(['user_id' => $user_id,'user_activity'=>$user_activity,'created_at'=>$created_time,'page_title'=>$page_title,'user_activity_item_id'=>$user_activity_item_id,'user_activity_item'=>$user_activity_item]);
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
