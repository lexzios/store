<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use User;
use Auth;

class SessionsController extends \BaseController {

  public function __construct() {
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
  }

  public function fresh()
  {
    if( Auth::check() ) return Redirect::to('/admin');
    return View::make('admin.sessions.new');
  }

  public function create()
  {
    if( Auth::check() ) return Redirect::to('/admin');
    $session_params = $this->_session_params();
    if( Auth::attempt(array(
      'email' => $session_params['email'],
      'password' => $session_params['password']
    ), $session_params['remember_check'] == 1) ) {
      $user = User::find(Auth::user()->id);
      $user->current_sign_in_at = \Carbon\Carbon::now()->toDateTimeString();
      $user->save();
      return Redirect::to('/admin');
    } else {
      return View::make('admin.sessions.new', array('error' => 'Invalid email or password!'));
    }
  }

  public function destroy()
  {
    if( Auth::check() )
    {
      $user = User::find(Auth::user()->id);
      $user->last_sign_in_at = Auth::user()->current_sign_in_at;
      $user->save();
      Auth::logout();
    }
    return Redirect::to('/admin/login');
  }

  # Get session params
  private $_allowed_session_params = array('email', 'password', 'remember_check');
  private function _session_params()
  {
    $input_session_params = Input::get('session');
    $session_params = array();
    $session_params['remember_check'] = 0;
    foreach($input_session_params as $key => $session_param)
    {
      if( in_array($key, $this->_allowed_session_params) )
        $session_params[$key] = $session_param;
    }
    return $session_params;
  }

}
