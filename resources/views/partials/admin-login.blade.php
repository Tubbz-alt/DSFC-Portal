<ul class="nav nav-pills pull-right">
  {{-- <li><a href="#">Profile</a></li>--}}
  <span class="user-cover pull-right">
   {{--   <h2><a href="#">{{ucfirst(strtolower(Sentinel::check()->first_name)) . " " . ucfirst(strtolower(Sentinel::check()->last_name))}}</a></h2>
      <p>Logged in as {{Sentinel::check()->username}}</p>--}}
  </span>

   <?php
   $user = Sentinel::getUser();
   if($user->inRole('administrator')) {
   ?>
   <li><a href="{{ url('admin') }}">Admin </a></li>
   <?php }
   ?>
   <li><a href="{{ url('user/logout') }}">Logout</a></li>
</ul>
