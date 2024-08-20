<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use RateConversion;
use Currency;
use Auth;

class RateConversionController extends BaseController {

  public function __construct()
  {
    parent::__construct();
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_conversion', array('only' => array('show' ,'edit', 'update', 'destroy')));
    $this->beforeFilter('@set_currency', array('only' => array('fresh', 'show' ,'edit', 'create', 'update')));
    $this->template['page-title'] = 'Central PC Admin - Conversion Rates';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Conversion Rates';
    LayoutHelper::addActiveMenu('admin.rateconversion');
  }

  # GET /admin/rateconversions
  public function index()
  {
    $conversions = RateConversion::where('is_deleted', '0')->get();
    $conversions = $this->money_formatter($conversions);
    return View::make('admin.rateconversion.index', array('conversions' => $conversions));
  }

  # GET /admin/rateconversions/1
  public function show($id) {
    return View::make('admin.rateconversion.show', array('conversion' => $this->_conversion, 'currency' => $this->_currency));
  }

  # GET /admin/rateconversion/new
  public function fresh() {
    $conversion = new RateConversion();
    return View::make('admin.rateconversion.new', array('conversion' => $conversion, 'currency' => $this->_currency));
  }

  # GET /admin/ConversionRate/1/edit
  public function edit($id) {
    return View::make('admin.rateconversion.edit', array('conversion' => $this->_conversion, 'currency' => $this->_currency));
  }

  # Post /admin/rateconversion
  public function create() {
    $conversion = RateConversion::fresh( $this->_conversion_params() );
    if( $conversion->validate() && $conversion->save() )
    {
      return Redirect::to('/admin/rateconversion/'. $conversion->id)->with('message', 'New Conversion Rates was successfully created.');
    }
    else
    {
      return View::make('admin.rateconversion.new', array('conversion' => $conversion, 'currency' => $this->_currency));
    }
  }

  # PATCH / PUT /admin/ConversionRate/1
  public function update($id) {
    $this->_conversion->modify( $this->_conversion_params() );
    if( $this->_conversion->validate() && $this->_conversion->save() )
    {
      return Redirect::to('/admin/rateconversion/'. $this->_conversion->id)->with('message', 'New Conversion Rates was successfully updated.');
    }
    else
    {
      return View::make('admin.rateconversion.edit', array('conversion' => $this->_conversion, 'currency' => $this->_currency));
    }
  }

  # DELETE /admin/ConversionRate/1
  public function destroy($id) {
    $this->_conversion->deleted_by = Auth::user()->email;
    $this->_conversion->is_deleted = '1';
    $this->_conversion->save();
    // $this->_conversion->delete();
    return Redirect::to('/admin/rateconversion')->with('message', 'New Conversion Rates was successfully deleted.');
  }

  #money formatter
  public function money_formatter($data)
  {
    if(isset($data[0]))
    {
      for($i=0;$i<count($data);$i++)
      {
        if(strcmp($data[$i]->to_currency_code, 'IDR') !== 0)
        {
          $data[$i]->rate = '$ '.number_format($data[$i]->rate,8,".",","); 
        }
        else
        {
          $data[$i]->rate = 'Rp '.number_format($data[$i]->rate,0,",",".");
        }
      }
    }
    else if(isset($data->to_currency_code))
    {
      if(strcmp($data->to_currency_code, 'IDR') !== 0)
        {
          $data->rate = number_format($data->rate,8,".",","); 
        }
        else
        {
          $data->rate = number_format($data->rate,0,".","");
        }
    }

    return $data;
  }

  /**
   * Filter the incoming requests.
   */

  private $_currency;
  public function set_currency()
  {
    $this->_currency = Currency::get(array('id', 'code'))->lists('code', 'code');
  }

  private $_conversion;
  public function set_conversion($route, $request)
  {
    $this->_conversion = RateConversion::find($route->getParameter('id'));
    $this->_conversion = $this->money_formatter($this->_conversion);
  }

  # Get RateConversion params
  private $_allowed_conversion_params = array('from_currency_code', 'to_currency_code', 'rate');

  private function _conversion_params()
  {
    $input_conversion_params = Input::get('conversion');
    $conversion_params = array();
    foreach($input_conversion_params as $key => $conversion_param)
    {
      if( in_array($key, $this->_allowed_conversion_params) )
      {
        $conversion_params[$key] = $conversion_param;
      }
    }
    return $conversion_params;
  }


}
