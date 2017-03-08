<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserSignupRequest;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Sentinel;
use Redirect;
use DB;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = DB::table('users')
            ->select('users.permissions','users.id','users.email','users.username','role_users.role_id','users.first_name','users.last_name','activations.completed','users.last_login','users.updated_at','user_details.organisation')
            ->leftjoin('activations', 'users.id', '=', 'activations.user_id')
            ->leftjoin('role_users', 'users.id', '=', 'role_users.user_id')
            ->leftjoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->groupBy('users.id')
            ->get();



         return view('users.index', compact('user','user_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function activation(Request $request)
    {
        $info = $request->all();
        $id=$info['user_id'];

        $users_info = User::where('id','=',$id)->first();
        $credentials = array(
            'username'     => $users_info->username,
            'email'        => $users_info->email,
            'first_name'   => $users_info->first_name,
            'last_name'    => $users_info->last_name,
            'password'     => $users_info->password,
        );
        if($info['status']=="activate"){
            Sentinel::Activate($credentials);
            return redirect('/admin/users');

        }
        else{

           DB::table('activations')->where('user_id', '=', $id)->delete();
            return redirect('/admin/users');
        }



    }


    public function makeadmin(Request $request)
    {
        $info = $request->all();
        $id=$info['user_id'];

        if($info['status']=="addadmin"){
            DB::table('role_users')->insert([
                'user_id' => $id,
                'role_id' => 1,
            ]);
        }else{

            DB::table('role_users')->where('user_id',$id)->delete();

        }







    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $credentials = array(                           
                            'username'     => $request->username,
                            'first_name'   => $request->firstname,
                            'last_name'    => $request->lastname,
                            'email'        => $request->email,
                            'password'     => $request->password,

                        );
        if($user=Sentinel::registerAndActivate($credentials)){
            DB::table('user_details')->insert([
                'user_id' => $user->id,
                'organisation' => $request->nhs_organisation,

            ]);
            Session::flash('success','Created Successfully!!');
            return redirect('admin/user');
            
        }else{
            return redirect('user/signup');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user_details = DB::table('user_details')->where('user_id', $id)->value('organisation');
        return view('users.show', compact('user','user_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user_details = DB::table('user_details')->where('user_id', $id)->value('organisation');
        return view('users.edit', compact('user','id','user_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = Sentinel::findById($id);

        $credentials = [
            'first_name'    => $request->firstname,
            'last_name'     => $request->lastname,
            'email'         => $request->email,
            'username'      => $request->username,
        ];

        if($request->has("password")){
            $credentials['password'] = $request->password;
        }

        $user = Sentinel::update($user, $credentials);
        if($user){
        DB::table('user_details') ->where('user_id',$user->id)->update(array('organisation' => $request->nhs_organisation));
        }
        Session::flash('success','Updated Successfully!!');
        return redirect('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if($user){
            DB::table('user_details')->where('user_id',$id)->delete();
        }
        Session::flash('success','Deleted Successfully!!');
        return redirect('admin/user');
    }  

    public function delete_all(Request $request)
    {
        $all_params = $request->all();
        foreach($all_params['ids'] as $id):
            $user = User::find($id);
            $user->delete();
        endforeach;
        Session::flash('success','Deleted Successfully!!');
        return 'true';
    }

    public function login(){
        return view('users.login');
    }

    public function loginCheck(UserLoginRequest $request){
        try {
            $credentials = array();
            $credentials['login'] = $request->login;
            $credentials['password'] = $request->password;
            if ($request->remember) {
                $remember = $request->remember;
            } else {
                $remember = false;
            }
            if (Sentinel::authenticate($credentials, $remember)) {
                return redirect('dashboard');
            } else {
                return back()->withInput($request->only('login'))->withErrors(['errors' => "Please check your credentials"]);
            }
        }
        catch (NotActivatedException $e) {


            return back()->withInput($request->only('login'))->withErrors(['errors' => "This account is not active yet"]);

        }
    }

    public function logout(){
        Sentinel::logout(null, true);
        return redirect("/");
    }

    public function signup(UserSignupRequest $request){
        $credentials = array(                           
                          'username'     => $request->username,
                          'email'        => $request->email,
                          'first_name'   => $request->first_name,
                          'last_name'    => $request->last_name,
                          'password'     => $request->password,
                        );
        $user = Sentinel::register($credentials);
        if($user){
            $role_name = Role::where('default','=','true')->select('name')->first();
            $role = Sentinel::findRoleByName($role_name['name']);
            $role->users()->attach($user);
            Session::flash('success', 'Your account has been created successfully. Please Login');
            return redirect('user/login');
        }else{
            return redirect('user/signup');
        }
    }
}