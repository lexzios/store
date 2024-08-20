<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use User;
use Auth;

class UsersController extends BaseController {

  public function __construct() {
    parent::__construct();
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_user', array('only' => array('show' ,'edit', 'update', 'destroy')));
    // Set template
    $this->template['page-title'] = 'Central PC Admin - Admin Management';
    LayoutHelper::addActiveMenu('admin');
  }

  # GET /admin/users
  public function index() {
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Listing Admin';
    LayoutHelper::addActiveMenu('admin.list');
    $users = User::where('is_deleted', 0)->get();
    return View::make('admin.users.index', array('users' => $users));
  }

  # GET /admin/users/1
  public function show($id) {
    $this->template['main-bar-title'] = '<i class="fa fa-user"></i>&nbsp; Show Admin';
    LayoutHelper::addActiveMenu('admin.show');
    return View::make('admin.users.show', array('user' => $this->_user));
  }

  # GET /admin/users/new
  public function fresh() {
    $user = new User();
    $this->template['main-bar-title'] = '<i class="fa fa-plus-square-o"></i>&nbsp; New Admin';
    LayoutHelper::addActiveMenu('admin.new');
    return View::make('admin.users.new', array('user' => $user));
  }

  # GET /admin/users/1/edit
  public function edit($id) {
    $this->template['main-bar-title'] = '<i class="fa fa-edit"></i>&nbsp; Edit Admin';
    LayoutHelper::addActiveMenu('admin.edit');
    return View::make('admin.users.edit', array('user' => $this->_user));
  }

  # POST /admin/users
  public function create() {
    $user = User::fresh( $this->_user_params() );
    if( $user->validate() && $user->save() )
    {
      return Redirect::to('/admin/users/' . $user->id)->with('message', 'Admin was successfully created.');
    }
    else
    {
      $this->template['main-bar-title'] = '<i class="fa fa-plus-square-o"></i>&nbsp; New Admin';
      LayoutHelper::addActiveMenu('admin.new');
      return View::make('admin.users.new', array('user' => $user));
    }
  }

  # PATCH / PUT /admin/users/1
  public function update($id) {
    $this->_user->modify( $this->_user_params() );
    if( $this->_user->validate() && $this->_user->save() )
    {
      return Redirect::to('/admin/users/' . $this->_user->id)->with('message', 'Admin was successfully updated.');
    }
    else
    {
      $this->template['main-bar-title'] = '<i class="fa fa-edit"></i>&nbsp; Edit Admin';
      LayoutHelper::addActiveMenu('admin.edit');
      return View::make('admin.users.edit', array('user' => $this->_user));
    }
  }

  # DELETE /admin/users/1
  public function destroy($id) {
    $this->_user->deleted_by = Auth::user()->email;
    $this->_user->is_deleted = '1';
    $this->_user->save();
    // $this->_user->delete();
    return Redirect::to('/admin/users')->with('message', 'Admin was successfully deleted.');
  }

  /**
   * Filter the incoming requests.
   */

  private $_user;
  public function set_user($route, $request)
  {
    $this->_user = User::find($route->getParameter('id'));
  }

  # Get user params
  private $_allowed_user_params = array('first_name', 'last_name', 'email', 'password', 'password_confirmation');
  private function _user_params()
  {
    $input_user_params = Input::get('user');
    $user_params = array();
    foreach($input_user_params as $key => $user_param)
    {
      if( in_array($key, $this->_allowed_user_params) )
        $user_params[$key] = $user_param;
    }
    return $user_params;
  }
}
