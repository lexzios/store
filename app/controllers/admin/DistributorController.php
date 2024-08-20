<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use Distributor;
use DistributorProduct;
use Auth;

class DistributorController extends BaseController {

  public function __construct() 
  {
    parent::__construct();

    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_distributor', array('only' => array('show' ,'edit', 'update', 'destroy')));
    $this->template['page-title'] = 'Central PC Admin - Distributor Management';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Listing Distributor';
    LayoutHelper::addActiveMenu('admin.distributor');
  }

  # GET /admin/users
  public function index() {
    $distributors = Distributor::where('is_deleted', '0')->get();
    return View::make('admin.distributor.index', array('distributors' => $distributors));
  }

  # GET /admin/users/1
  public function show($id) {
    return View::make('admin.distributor.show', array('distributor' => $this->_distributor));
  }

  # GET /admin/users/new
  public function fresh() {
    $distributor = new Distributor();
    return View::make('admin.distributor.new', array('distributor' => $distributor));
  }

  # GET /admin/users/1/edit
  public function edit($id) {
    return View::make('admin.distributor.edit', array('distributor' => $this->_distributor));
  }

  # POST /admin/users
  public function create() {
    $distributor = Distributor::fresh( $this->_distributor_params() );
    if( $distributor->validate() && $distributor->save() )
    {
      return Redirect::to('/admin/distributor/'.$distributor->id.'/product')->with('message', 'Distributor was successfully created.');
    }
    else
    {
      return View::make('admin.distributor.new', array('distributor' => $distributor));
    }
  }

  # PATCH / PUT /admin/users/1
  public function update($id) {
    $this->_distributor->modify( $this->_distributor_params() );
    if( $this->_distributor->validate() && $this->_distributor->save() )
    {
      return Redirect::to('/admin/distributor/'.$id.'/product')->with('message', 'Distributor was successfully updated.');
    }
    else
    {
      return View::make('admin.distributor.edit', array('distributor' => $this->_distributor));
    }
  }

  # DELETE /admin/users/1
  public function destroy($id) {
    $this->_distributor->deleted_by = Auth::user()->email;
    $this->_distributor->is_deleted = '1';
    $this->_distributor->save();
    // $this->_distributor->delete();
    // DistributorProduct::where('distributor_id', $id)->delete();
    return Redirect::to('/admin/distributor')->with('message', 'Distributor was successfully deleted.');
  }

  #Search
  public function search()
  {
    if(Input::get('is_csv'))
    {
      if(Input::get('search') == "")
      {
        return Redirect::to('/admin/distributor/csv/exportCSV');
      }
      else
      {
        return Redirect::to('/admin/distributor/csv/exportCSV/'.Input::get('search'));
      }
    }
    else if(Input::get('is_csv_upload'))
    {
      return Redirect::to('/admin/distributor/csv/upload');
    }
    else
    {
      $distributors = Distributor::where('is_deleted', '0')->where('name', 'LIKE', '%'.Input::get('search').'%')->get();
      return View::make('admin.distributor.index', array('distributors' => $distributors))->with('search', Input::get('search'));
    }
  }

  #CSV
  public function showCSV()
  {
    return View::make('admin.distributor.csv_upload');
  }

  public function createCSV()
  {
    $distributor = new Distributor();
    //check validation with function in baseController
    if($distributor->csv_upload_validate(Input::file('csv_file')))
    {
      //call csv upload function in baseController
      if($distributor->csv_upload(Input::file('csv_file')))
      {
        return Redirect::to('/admin/distributor')->with('message', 'Distributor was successfully inserted.');
      }
      else
      {
        return View::make('admin.distributor.csv_upload')->withErrors("Error Read CSV");
      }
    }
    else
    {
      return View::make('admin.distributor.csv_upload')->withErrors($distributor->errors);
    }
  }


  /**
   * Filter the incoming requests.
   */

  private $_distributor;
  public function set_distributor($route, $request)
  {
    $this->_distributor = Distributor::find($route->getParameter('id'));
  }

  # Get distributor params
  private $_allowed_distributor_params = array('name', 'address');

  private function _distributor_params()
  {
    $input_distributor_params = Input::get('distributor');
    $distributor_params = array();
    foreach($input_distributor_params as $key => $distributor_param)
    {
      if( in_array($key, $this->_allowed_distributor_params) )
      {
        $distributor_params[$key] = $distributor_param;
      }
    }
    return $distributor_params;
  }
}
