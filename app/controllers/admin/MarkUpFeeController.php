<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use MarkUpFee;
use Auth;

class MarkUpFeeController extends BaseController {

  public function __construct()
  {
    parent::__construct();

    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_markupfee', array('only' => array('show' ,'edit', 'update', 'destroy')));

    $this->template['page-title'] = 'Central PC Admin - Mark Up Fee';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Mark Up Fee';
    LayoutHelper::addActiveMenu('admin.markupfee');
  }

  # GET /admin/markUpFee
  public function index()
  {
    $markup = MarkUpFee::where('is_deleted', '0')->get();
    $markup = $this->money_formatter($markup);
    return View::make('admin.markupfee.index', array('markup' => $markup));
  }

  # GET /admin/markUpFee/1
  public function show($id) {
    return View::make('admin.markupfee.show', array('markup' => $this->_markupfee));
  }

  # GET /admin/markUpFee/new
  public function fresh() {
    $markup = new MarkUpFee();
    return View::make('admin.markupfee.new', array('markup' => $markup));
  }

  # GET /admin/markUpFee/1/edit
  public function edit($id) {
    return View::make('admin.markupfee.edit', array('markup' => $this->_markupfee));
  }

  # Post /admin/markUpFee
  public function create() {
    $markup = MarkUpFee::fresh( $this->_markupfee_params() );
    if( $markup->validate() && $markup->save() )
    {
      return Redirect::to('/admin/markupfee/'. $markup->id)->with('message', 'Mark Up Fee was successfully created.');
    }
    else
    {
      return View::make('admin.markupfee.new', array('markup' => $markup));
    }
  }

  # PATCH / PUT /admin/markUpFee/1
  public function update($id) {
    $this->_markupfee->modify( $this->_markupfee_params() );
    if( $this->_markupfee->validate() && $this->_markupfee->save() )
    {
      return Redirect::to('/admin/markupfee/'. $this->_markupfee->id)->with('message', 'Mark Up Fee was successfully updated.');
    }
    else
    {
      return View::make('admin.markupfee.edit', array('markup' => $this->_markupfee));
    }
  }

  # DELETE /admin/markUpFee/1
  public function destroy($id) {
    $this->_markupfee->deleted_by = Auth::user()->email;
    $this->_markupfee->is_deleted = '1';
    $this->_markupfee->save();
    // $this->_markupfee->delete();
    return Redirect::to('/admin/markupfee')->with('message', 'Mark Up Fee was successfully deleted.');
  }

  #money formatter
  public function money_formatter($data)
  {
    if(isset($data[0]))
    {
      for($i=0;$i<count($data);$i++)
      {
        $data[$i]->fixed_fee = 'Rp '.number_format($data[$i]->fixed_fee,0,",","."); 
      }
    }
    else if(isset($data->fixed_fee))
    {
      $data->fixed_fee = 'Rp '.number_format($data->fixed_fee,0,",",".");
    }
    return $data;
  }

  #Search
  public function search()
  {
    if(Input::get('is_csv'))
    {
      if(Input::get('search') == "")
      {
        return Redirect::to('/admin/markupfee/csv/exportCSV');
      }
      else
      {
        return Redirect::to('/admin/markupfee/csv/exportCSV/'.Input::get('search'));
      }
    }
    else if(Input::get('is_csv_upload'))
    {
      return Redirect::to('/admin/markupfee/csv/upload');
    }
    else
    {
      $markup = MarkUpFee::where('is_deleted', '0')->where('name', 'LIKE', '%'.Input::get('search').'%')->get();
      return View::make('admin.markupfee.index', array('markup' => $markup))->with('search', Input::get('search'));
    }
  }

  #CSV
  public function showCSV()
  {
    return View::make('admin.markupfee.csv_upload');
  }

  public function createCSV()
  {
    $markUp = new MarkUpFee();
    //check validation with function in baseController
    if($markUp->csv_upload_validate(Input::file('csv_file')))
    {
      //call csv upload function in baseController
      if($markUp->csv_upload(Input::file('csv_file')))
      {
        return Redirect::to('/admin/markupfee')->with('message', 'Formula was successfully inserted.');
      }
      else
      {
        return View::make('admin.markupfee.csv_upload')->withErrors("Error Read CSV");
      }
    }
    else
    {
      return View::make('admin.markupfee.csv_upload')->withErrors($markUp->errors);
    }
  }

  /**
   * Filter the incoming requests.
   */

  private $_markupfee;
  public function set_markupfee($route, $request)
  {
    $this->_markupfee = MarkUpFee::find($route->getParameter('id'));
  }

  # Get markupfee params
  private $_allowed_markupfee_params = array('name', 'float_fee', 'fixed_fee');

  private function _markupfee_params()
  {
    $input_markupfee_params = Input::get('markup');
    $markupfee_params = array();
    foreach($input_markupfee_params as $key => $markupfee_param)
    {
      if( in_array($key, $this->_allowed_markupfee_params) )
      {
        $markupfee_params[$key] = $markupfee_param;
      }
    }
    return $markupfee_params;
  }


}
