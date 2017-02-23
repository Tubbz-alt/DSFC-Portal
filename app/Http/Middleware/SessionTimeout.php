<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Sentinel;
use DB;
use Session;
use Illuminate\Session\Store;
class SessionTimeout {
    protected $session;
    protected $timeout=120;
    public function __construct(Store $session){
        $this->session=$session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->session->has('lastActivityTime'))
            $this->session->put('lastActivityTime',time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->getTimeOut()){
            $this->session->forget('lastActivityTime');
            $user = Sentinel::getUser();
            if($user)
            {
                DB::table('active_users')->where('user_id', '=', $user->id)->delete();
            }
            Sentinel::logout($user, true);
            Session::flush('patient_id');
            Session::flush('patient_king_id');
            Session::flush('patient_name_id');
            Session::flush('userWardName');
            return redirect("/")->withErrors(['You had not activity in 15 minutes']);
           // Auth::logout();
            //return redirect('auth/login')
        }
        $this->session->put('lastActivityTime',time());
        return $next($request);
    }

    protected function getTimeOut()
    {
        return (env('TIMEOUT')) ?: $this->timeout;
    }
}