<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use DistributorProduct;
use Distributor;
use Product;
use Currency;
use Auth;

class DistributorProductController extends BaseController {

  public function __construct() {
    parent::__construct();
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_distributor_product', array('only' => array('show' ,'edit', 'update', 'destroy')));
    $this->beforeFilter('@set_product', array('only' => array('show', 'fresh','edit', 'create', 'update')));
    $this->template['page-title'] = 'Central PC Admin - Distributor Management Product';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Listing Distributor Product';
    LayoutHelper::addActiveMenu('admin.distributor');
  }

  # GET /admin/users
  public function index($room_id) {
    $distributorProducts = DistributorProduct::with(array('productName' => function($query){$query->where('is_deleted', 0);}))
    ->where('is_deleted', '0')->where('distributor_id', $room_id)->get();
    $distributor = Distributor::where('is_deleted', 0)->where('id', $room_id)->get()[0];
    $distributorProducts = $this->money_formatter($distributorProducts);
    return View::make('admin.distributor_product.index', array('distributor' => $distributor, 'distributorProducts' => $distributorProducts))->with('room_id', $room_id);
  }

  # GET /admin/users/1
  public function show($room_id, $id) {
    return View::make('admin.distributor_product.show', array('distributorProduct' => $this->_distributor_product, 'products' => $this->_product, 'currency' => $this->_currency, 'room_id' => $room_id));
  }

  # GET /admin/users/new
  public function fresh($room_id) {
    $distributorProduct = new DistributorProduct();
    return View::make('admin.distributor_product.new', array('distributorProduct' => $distributorProduct, 'room_id' => $room_id, 'products' => $this->_product, 'currency' => $this->_currency));
  }

  # GET /admin/users/1/edit
  public function edit($room_id, $id) {
    return View::make('admin.distributor_product.edit', array('distributorProduct' => $this->_distributor_product, 'room_id' => $room_id, 'products' => $this->_product, 'currency' => $this->_currency));
  }

  # POST /admin/users
  public function create($room_id) {
    $distributorProduct = DistributorProduct::fresh( $this->_distributor_product_params() );
    if( $distributorProduct->validate() )
    {
      if(strcmp(Product::where('id', $distributorProduct['product_id'])->get(array('currency_code'))->lists('currency_code')[0],  $distributorProduct['currency_code']) == 0)
      {
        $distributorProduct->save();
        return Redirect::to('/admin/distributor/'.$room_id.'/product')->with('message', 'Distributor Product was successfully created.');
      }
      else
      {
        return View::make('admin.distributor_product.new', array('distributorProduct' => $distributorProduct, 'room_id' => $room_id, 'products' => $this->_product, 'currency' => $this->_currency))->withErrors("Invalid currency for this product");
      }     
    }
    else
    {
      return View::make('admin.distributor_product.new', array('distributorProduct' => $distributorProduct, 'room_id' => $room_id, 'products' => $this->_product, 'currency' => $this->_currency));
    }
  }

  # PATCH / PUT /admin/users/1
  public function update($room_id, $id) {
    $this->_distributor_product->modify( $this->_distributor_product_params() );
    if( $this->_distributor_product->validate() )
    {
      if(strcmp(Product::where('id', $this->_distributor_product['product_id'])->get(array('currency_code'))->lists('currency_code')[0],  $this->_distributor_product['currency_code']) == 0)
      {
        $this->_distributor_product->save();
        return Redirect::to('/admin/distributor/'.$room_id.'/product')->with('message', 'Distributor Product was successfully updated.');
      }
      else
      {
        return View::make('admin.distributor_product.edit', array('distributorProduct' => $this->_distributor_product, 'room_id' => $room_id, 'products' => $this->_product, 'currency' => $this->_currency))->withErrors("Invalid currency for this product");
      } 
      
    }
    else
    {
      return View::make('admin.distributor_product.edit', array('distributorProduct' => $this->_distributor_product, 'room_id' => $room_id, 'products' => $this->_product, 'currency' => $this->_currency));
    }
  }

  # DELETE /admin/users/1
  public function destroy($room_id, $id) {
    $this->_distributor_product->deleted_by = Auth::user()->email;
    $this->_distributor_product->is_deleted = '1';
    $this->_distributor_product->save();
    // $this->_distributor_product->delete();
    return Redirect::to('/admin/distributor/'.$room_id.'/product')->with('message', 'Distributor Product was successfully deleted.');
  }

  #money formatter
  public function money_formatter($data)
  {
    if(isset($data[0]))
    {
      for($i=0;$i<count($data);$i++)
      {
        if(isset($data[$i]->distributor_product_price))
        {
          if(strcmp($data[$i]->currency_code, 'IDR') !== 0)
          {
            $data[$i]->distributor_product_price = '$ '.number_format($data[$i]->distributor_product_price,0,".",","); 
          }
          else
          {
            $data[$i]->distributor_product_price = 'Rp '.number_format($data[$i]->distributor_product_price,0,",",".");
          }
        }
      }
    }

    return $data;
  }

  #Search
  public function search($room_id)
  {
    if(Input::get('is_csv'))
    {
      if(Input::get('search') == "")
      {
        return Redirect::to('/admin/distributor/'.$room_id.'/product/csv/exportCSV/'.Input::get('category'));
      }
      else
      {
        return Redirect::to('/admin/distributor/'.$room_id.'/product/csv/exportCSV/'.Input::get('search'));
      }
    }
    else if(Input::get('is_csv_upload'))
    {
      return Redirect::to('/admin/distributor/'.$room_id.'/product/csv/upload');
    }
    else
    {
      $distributorProducts = DistributorProduct::with(array('productName' => function($query){$query->where('is_deleted', 0);}))->where('name', 'LIKE', '%'.Input::get('search').'%')->where('is_deleted', '0')->where('distributor_id', $room_id)->get();
      $distributor = Distributor::where('is_deleted', 0)->where('id', $room_id)->get()[0];
      return View::make('admin.distributor_product.index', array('distributor' => $distributor, 'distributorProducts' => $distributorProducts, 'search' => Input::get('search')))->with('room_id', $room_id);
    }
  }

  #CSV
  public function showCSV($room_id)
  {
    return View::make('admin.distributor_product.csv_upload')->with('room_id', $room_id);
  }

  public function createCSV($room_id)
  {
    $distributorProduct = new DistributorProduct();
    //check validation with function in baseController
    if($distributorProduct->csv_upload_validate(Input::file('csv_file')))
    {
      //call csv upload function in baseController
      if($distributorProduct->csv_upload(Input::file('csv_file')))
      {
        return Redirect::to('/admin/distributor/'.$room_id.'/product')->with('message', 'Product was successfully inserted.');
      }
      else
      {
        return View::make('admin.distributor_product.csv_upload')->with('room_id', $room_id)->withErrors("Error read CSV");
      }
    }
    else
    {
      return View::make('admin.distributor_product.csv_upload')->with('room_id', $room_id)->withErrors($distributorProduct->errors);
    }
  }

  /**
   * Filter the incoming requests.
   */

  private $_product;
  private $_currency;
  public function set_product()
  {
    $this->_product = Product::where('is_deleted', 0)->get(array('id', 'name'))->lists('name', 'id');
    $this->_currency = Currency::where('is_deleted', 0)->get(array('id','code'))->lists('code', 'code');
  }

  private $_distributor_product;
  public function set_distributor_product($route, $request)
  {
    $this->_distributor_product = DistributorProduct::find($route->getParameter('id'));
  }

  # Get distributor product params
  private $_allowed_distributor_product_params = array('name', 'distributor_product_price', 'product_id', 'distributor_id', 'currency_code');

  private function _distributor_product_params()
  {
    $input_distributor_product_params = Input::get('distributorProduct');
    $distributor_product_params = array();
    foreach($input_distributor_product_params as $key => $distributor_product_param)
    {
      if( in_array($key, $this->_allowed_distributor_product_params) )
      {
        $distributor_product_params[$key] = $distributor_product_param;
      }
    }
    return $distributor_product_params;
  }
}
