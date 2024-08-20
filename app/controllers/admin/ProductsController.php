<?php

namespace admin;
use Request;
use Illuminate\Support\Facades\Session;
use View;
use Input;
use Redirect;
use LayoutHelper;
use Auth;

use Product;
use Category;
use Currency;
use MarkUpFee;
use ProductImage;
use Distributor;
use DistributorProduct;
use RateConversion;

class ProductsController extends BaseController {

  public function __construct() {
    parent::__construct();

    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_product', array('only' => array('show' ,'edit', 'update', 'destroy')));
    $this->beforeFilter('@set_attribute', array('only' => array('index', 'search', 'fresh','edit', 'create', 'update')));
    $this->template['page-title'] = 'Central PC Admin - Product Management';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Listing Products';
    LayoutHelper::addActiveMenu('admin.product');
  }

  # GET /admin/users
  public function index() {
      Session::put('list_url',Request::url());
    $data = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
    ->with(array('productFormula' => function($query){$query->where('formula.is_deleted', 0);}))
    ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
    ->where('is_deleted',0)->orderBy('name', 'asc')->paginate(20);

    $products = $this->product_price_calculation($data);
    $this->_category = $this->addCategoryArray($this->_category);

    return View::make('admin.products.index', array('products' => $products, 'category' => $this->_category));
  }

  # GET /admin/users/1
  public function show($id) {
    $product = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
    ->with(array('productCategory' => function($query){$query->where('product_category.is_deleted', 0);}))
    ->with(array('productFormula' => function($query){$query->where('formula.is_deleted', 0);}))
    ->where('is_deleted',0)->find($id);

    $product = $this->money_formatter($product);
    $distributorProduct = DistributorProduct::with(array('distributor' => function($query){$query->where('distributor.is_deleted', 0);}))
    ->where('is_deleted', 0)->where('product_id', $id)->get();
    $distributorProduct = $this->money_formatter($distributorProduct);
    return View::make('admin.products.show', array('product' => $product, 'distributorProducts' => $distributorProduct));
  }

  # GET /admin/users/new
  public function fresh() {
    $product = new Product();
    return View::make('admin.products.new', array('product' => $product, 'category' => $this->_category, 'currency' => $this->_currency, 'markup' => $this->_mark_up));
  }

  # GET /admin/users/1/edit
  public function edit($id) {
    return View::make('admin.products.edit', array('product' => $this->_product, 'category' => $this->_category, 'currency' => $this->_currency, 'markup' => $this->_mark_up));
  }

  # POST /admin/users
  public function create() {
    $product = Product::fresh( $this->_product_params() );
    if( $product->validate() && $product->upload_image($this->_filename) && $product->save() )
    {
      // check if contain some file
      if(Input::hasFile('product')) 
      {
        //check if file valid
        if(Input::file('product')['image_path']->isValid()) 
        {
          $image = new ProductImage();
          $image->product_id = $product->id;
          $image->image_path = "/".$this->_destination_directory.$this->_filename;
          $image->created_by = Auth::user()->email;
          if($image->save())
          {
            return Redirect::to('/admin/products/'. $product->id)->with('message', 'Product successfully created.');
          }
          else
          {
            return Redirect::to('/admin/products/'. $product->id)->with('message', 'Product successfully created But Image upload failed.');
          }
        }
        else
        {
          return Redirect::to('/admin/products/'. $product->id)->with('message', 'Product successfully created But Image upload failed.');
        }
      }
    }
    else
    {
      return View::make('admin.products.new', array('product' => $product, 'category' => $this->_category, 'currency' => $this->_currency, 'markup' => $this->_mark_up));
    }
  }

  # PATCH / PUT /admin/users/1
  public function update($id) {
    $this->_product->modify( $this->_product_params() );
    if( $this->_product->validate() && $this->_product->save() )
    {
      return Redirect::to('/admin/products/'. $this->_product->id)->with('message', 'Product was successfully updated.');
    }
    else
    {
      return View::make('admin.products.edit', array('product' => $this->_product, 'category' => $this->_category, 'currency' => $this->_currency, 'markup' => $this->_mark_up));
    }
  }

  # DELETE /admin/products/1
  public function destroy($id) {
    $this->_product->deleted_by = Auth::user()->email;
    $this->_product->permalink = $this->_product->permalink."-deleted-".time();
    $this->_product->is_deleted = '1';
    $this->_product->save();
    // $this->_product->delete();
    return Redirect::to('/admin/products')->with('message', 'Product was successfully deleted.');
  }

  #money formatter
  public function money_formatter($data)
  {
    if(isset($data[0]))
    {
      for($i=0;$i<count($data);$i++)
      {
        if(isset($data[$i]->base_price))
        {
          if(strcmp($data[$i]->currency_code, 'IDR') !== 0)
          {
            $data[$i]->base_price = '$ '.number_format($data[$i]->base_price,0,".",","); 
          }
          else
          {
            $data[$i]->base_price = 'Rp '.number_format($data[$i]->base_price,0,",",".");
          }
        }
        else if(isset($data[$i]->distributor_product_price))
        {
          if(strcmp($data[$i]->currency_code, 'IDR') !== 0)
          {
            $data[$i]->distributor_product_price = '$ '.number_format($data[$i]->distributor_product_price,0,".",","); 
          }
          else
          {
            $data[$i]->distributor_product_price = 'Rp '.number_format($data[$i]->distributor_product_price ,0,",",".");
          }
        }

      }
    }
    else
    {
      if(isset($data->base_price))
      {
        if(strcmp($data->currency_code, 'IDR') !== 0)
        {
          $data->base_price = '$ '.number_format($data->base_price,0,".",","); 
        }
        else
        {
          $data->base_price = 'Rp '.number_format($data->base_price,0,",",".");
        }
      }
      if(isset($data->streak_price))
      {
        if(strcmp($data->currency_code, 'IDR') !== 0)
        {
          $data->streak_price = '$ '.number_format($data->streak_price,0,".",","); 
        }
        else
        {
          $data->streak_price = 'Rp '.number_format($data->streak_price,0,",",".");
        }
      }
      if(isset($data->distributor_product_price))
      {
        if(strcmp($data->currency_code, 'IDR') !== 0)
        {
          $data->distributor_product_price = '$ '.number_format($data->distributor_product_price,0,".",","); 
        }
        else
        {
          $data->distributor_product_price = 'Rp '.number_format($data->distributor_product_price,0,",",".");
        }
      }
    }
    return $data;
  }

  #Search
  public function search()
  {
      $param_url='?';
      $xx=0;
      foreach(Input::get() as $key =>$value){
          if($xx>0){
              $param_url .='&';
          }
          $param_url .=$key.'='.$value;
          $xx++;
      }
      Session::put('list_url',Request::url().$param_url);

    if(Input::get('is_csv'))
    {
      if(Input::get('search') == "")
      {
        return Redirect::to('/admin/products/csv/exportCSV/'.Input::get('category'));
      }
      else
      {
        return Redirect::to('/admin/products/csv/exportCSV/'.Input::get('category').'/'.Input::get('search'));
      }
    }
    else if(Input::get('is_csv_upload'))
    {
      return Redirect::to('/admin/products/csv/upload');
    }
    else
    {
      if(Input::get('category') == 0 )
      {
        $data = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
        ->with(array('productFormula' => function($query){$query->where('formula.is_deleted', 0);}))
        ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
        ->where('name', 'LIKE', '%'.Input::get('search').'%')->where('is_deleted',0)->orderBy('name', 'asc')->paginate(20);
      }
      else
      {
        $data = Product::with('productImage')
        ->with(array('productFormula' => function($query){$query->where('formula.is_deleted', 0);}))
        ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
        ->where('product_category_id', Input::get('category'))->where('name', 'LIKE', '%'.Input::get('search').'%')->where('is_deleted',0)->orderBy('name', 'asc')->paginate(20);
      }
      $products = $this->product_price_calculation($data);
      $this->_category = $this->addCategoryArray($this->_category);

      return View::make('admin.products.index', array('products' => $products, 'category' => $this->_category, 'category_choosen' => Input::get('category')))->with('search', Input::get('search'));
    }
  }

  public function addCategoryArray($data)
  {
    $category = array();
    $category[0] = 'ALL';
    foreach($data as $key => $category_param)
    {
      $category[$key] = $category_param;
    }
    return $category;
  }

  public function showCSV()
  {
    return View::make('admin.products.csv_upload');
  }

  public function createCSV()
  {
    $product = new Product();
    //check validation with function in baseController
    if($product->csv_upload_validate(Input::file('csv_file')))
    {
      //call csv upload function in baseController
      if($product->csv_upload(Input::file('csv_file')))
      {
        return Redirect::to('/admin/products')->withErrors('Product was successfully inserted.');
      }
      else
      {
        return View::make('admin.products.csv_upload')->withErrors("Error read CSV");
      }
    }
    else
    {
      return View::make('admin.products.csv_upload')->withErrors($product->errors);
    }
  }
  
  /**
   * Filter the incoming requests.
   */

  private $_category;
  private $_currency;
  private $_mark_up;
  public function set_attribute()
  {
    $this->setCategory();
    $this->_currency = Currency::where('is_deleted', 0)->get(array('id', 'code'))->lists('code', 'code');
    $this->_mark_up = MarkUpFee::where('is_deleted', 0)->get(array('id', 'name'))->lists('name', 'id');
  }

  //generate category as group
  private function setCategory()
  {
    $dataChild = array();
    $this->_category = Category::where('is_deleted', 0)->get(array('id', 'name'))->lists('name', 'id');
    $data = Category::where('is_deleted', 0)->get();
    for($i=0;$i<count($data);$i++)
    {
      for($j=0;$j<count($data);$j++)
      {
        $child = 1;
        if($data[$i]->id != $data[$j]->parent_id)
        {
          $child = 1;
        }
        else
        {
          $child = 0;
          break;
        }
      }
      if($child == 1)
        {
          $dataChild[$data[$i]->id] = $data[$i]->name;
        }
    }
    // dd($dataChild);
    $this->_category = $dataChild;
  }

  private $_product;
  public function set_product($route, $request)
  {
    $this->_product = Product::find($route->getParameter('id'));
  }

  //for image upload
  private $_destination_directory = 'images/product/';
  private $_filename;

  # Get product params
  private $_allowed_product_params = array('product_category_id', 'currency_code', 'formula_id', 'permalink', 'name', 'image_path', 'short_description', 'long_description', 'base_price', 'is_sale', 'streak_price', 'is_call_for_best_price', 'is_in_editor_pick', 'title_seo', 'description_seo', 'keyword_seo');

  private function _product_params()
  {
    $input_product_params = Input::get('product');
    $product_params = array();
    foreach($input_product_params as $key => $product_param)
    {
      if( in_array($key, $this->_allowed_product_params) )
      {
        $product_params[$key] = $product_param;
      }
    }
    $product_params['permalink'] = $this->_seoUrl($product_params['permalink']);
      
      if(!isset($product_params['streak_price']) || $product_params['streak_price'] == '') {
          $product_params['streak_price'] = '0';
      }

      if(!isset($product_params['is_sale']))
    {
      $product_params['is_sale'] = '0';
    }
    if(!isset($product_params['is_call_for_best_price']))
    {
      $product_params['is_call_for_best_price'] = '0';
    }
    if(!isset($product_params['is_in_editor_pick']))
    {
      $product_params['is_in_editor_pick'] = '0';
    }
    // check if contain some file
      if(Input::hasFile('product')) 
      {
        //check if file valid
        if(Input::file('product')['image_path']->isValid()) 
        {
          $this->_filename = str_random(5).'.'.Input::file('product')['image_path']->getClientOriginalExtension();
          $banner_params['image_path'] = "/".$this->_destination_directory.$this->_filename;
        }
      }
    return $product_params;
  }

  //calculation
  public function product_price_calculation($data) {
    for($i=0;$i<count($data);$i++)
    {
        $data[$i]->first_base_price = $data[$i]->base_price;
        //if from distributor
        if(isset($data[$i]->productDistributor[0]))
        {
          $data[$i]->base_price = $data[$i]->productDistributor[0]->distributor_product_price;
          $data[$i]->distributor = $data[$i]->productDistributor[0]->distributor_id;
          for($j=0;$j<count($data[$i]->productDistributor);$j++)
          {
            if($data[$i]->base_price > $data[$i]->productDistributor[$j]->distributor_product_price)
            {
              $data[$i]->base_price = $data[$i]->productDistributor[$j]->distributor_product_price;
              $data[$i]->distributor = $data[$i]->productDistributor[$j]->distributor_id;
            }
          }
          $data[$i]->distributor = Distributor::find($data[$i]->distributor)->name;
        }

        if(strcmp($data[$i]->currency_code, 'IDR') !== 0 ) {
          $rateConversion = RateConversion::where('is_deleted', 0)->where('from_currency_code', $data[$i]->currency_code)->where('to_currency_code', 'IDR')->get();
          if(isset($rateConversion[0]))
          {
            $rateConversion = $rateConversion[0];
            $data[$i]->base_price = $data[$i]->base_price*$rateConversion->rate;
            $data[$i]->first_base_price = $data[$i]->first_base_price*$rateConversion->rate;
          }
        }
        if($data[$i]->base_price != 0)
        {
          if($data[$i]->formula_id != 0)
          {
            $formula = MarkUpFee::where('is_deleted', 0)->where('id', $data[$i]->formula_id)->get();
            if(isset($formula[0]))
            {
              $formula = $formula[0];
              $data[$i]->base_price = ($data[$i]->base_price + ($data[$i]->base_price*($formula->float_fee/100))) + $formula->fixed_fee;
            }
          }
          $data[$i]->base_price = 'Rp. '.number_format($this->_roundNearestThousandUp($data[$i]->base_price),0,',','.');
        }
        else
        {
          $data[$i]->base_price = 'CALL';
        }
        $data[$i]->first_base_price = 'Rp. '.number_format($this->_roundNearestThousandUp($data[$i]->first_base_price),0,',','.');
    }
    return $data;
  }

  private function _seoUrl($string) {
      //Lower case everything
      $string = strtolower($string);
      //Make alphanumeric (removes all other characters)
      $string = preg_replace("/[^a-z0-9_\s-]/", "-", $string);
      //Clean up multiple dashes or whitespaces
      $string = preg_replace("/[\s-]+/", "-", $string);
      //Convert whitespaces and underscore to dash
      $string = preg_replace("/[\s_]/", "-", $string);
      return $string;
  }

  public function _roundNearestThousandUp($number)
  {
    return ceil($number/1000)*1000;
  }

}
