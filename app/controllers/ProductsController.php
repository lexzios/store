<?php

class ProductsController extends BaseController {

  public function __construct()
  {
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_products', array('only' => array('index')));
    $this->beforeFilter('@set_search_products', array('only' => array('search')));
    $this->beforeFilter('@set_product', array('only' => array('show')));
  }


  # GET /products
  public function index($category_id)
  {
    $categories = Category::where('is_deleted', 0)->orderBy('sorting_id', 'DESC')->get();
    $tdk_seo = Category::where('permalink', $category_id)->get()[0];
    if($this->_has_header == 0)
    {
      return View::make('userweb.products', array('categories' => $categories, 'products' => $this->_products))->withTitle($tdk_seo);
    }
    else
    {
      return View::make('userweb.products', array('categories' => $categories, 'products' => $this->_products, 'is_has_header' => 'true'))->withTitle($tdk_seo);
    }
  }

  public function show($id) 
  {
    $category = Category::where('id', $this->_product->product_category_id)->where('is_deleted', 0)->get();
    return View::make('userweb.product_detail', array('product' => $this->_product, 'random_product' => $this->_random_product, 'category' => $category));
  }

  # GET /products by Search
  public function search()
  {
    $categories = Category::where('is_deleted', 0)->get();
    return View::make('userweb.product_search', array('categories' => $categories, 'products' => $this->_search_products))->withTitle(Input::get("name"))->with('name', Input::get("name"));
  }



  /**
   * Filter the incoming requests.
   */
  private $_product;
  private $_random_product;
  public function set_product($route, $request)
  {
  	$id = $route->getParameter('id');
    // $this->_product = Product::find($id);
    $data = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
    ->with(array('productCurrency' => function($query){$query->where('currency.is_deleted', 0);}))
    ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
    ->where('is_deleted', 0)->where('permalink', $id)->get();
    $this->_product = $this->product_price_calculation($data);
    $this->_product = $this->_product[0];

    $randomData = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
    ->with(array('productCurrency' => function($query){$query->where('currency.is_deleted', 0);}))
    ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
    ->where('id', '<>', $this->_product->id)->where('product_category_id', $this->_product->product_category_id)->where('is_deleted', 0)->orderByRaw('RAND()')->take('4')->get();
    $this->_random_product = $this->product_price_calculation($randomData);
    // dd($randomData);
  }

  private $_products;
  private $_has_header;
  public function set_products($route, $request)
  {
  	$id = $route->getParameter('category_id');
    // $this->_products = Product::where('product_category_id', $id)->paginate(9);
    $category = Category::where('permalink', $id)->get()[0];
    if($category->is_header == 0)
    {
      $data = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
      ->with(array('productCurrency' => function($query){$query->where('currency.is_deleted', 0);}))
      ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
      ->where('product_category_id', $category->id)->where('is_deleted',0)->orderBy('name', 'asc')->paginate(10000);

      // $data = Product::with('productImage')->with('productCurrency')->with('productDistributor')->where('product_category_id', $category_id)->where('is_deleted',0)->get();
      $this->_has_header = 0;
      $this->_products = $this->product_price_calculation($data);
    }
    else
    {
      $this->_has_header = 1;
      $data = Category::with(array('product' => function($query) {
        $query->with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
      ->with(array('productCurrency' => function($query){$query->where('currency.is_deleted', 0);}))
      ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
      ->where('is_deleted',0)->orderBy('name', 'asc');
      }))->where('parent_id', $category->id)->where('is_deleted', 0)->orderBy('sorting_id', 'desc')->paginate(10000);
      $this->_products = $this->product_price_calculation_data_with_header($data);
    }
  }

  private $_search_products;
  public function set_search_products($route, $request)
  {
    $name = Input::get("name");
    // $this->_products = Product::where('product_category_id', $id)->paginate(9);
    $data = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
    ->with(array('productCurrency' => function($query){$query->where('currency.is_deleted', 0);}))
    ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
    ->where('name', 'LIKE', '%'.$name.'%')->where('is_deleted',0)->orderBy('name', 'asc')->paginate(100);

    // $data = Product::with('productImage')->with('productCurrency')->with('productDistributor')->where('product_category_id', $category_id)->where('is_deleted',0)->get();
    $this->_search_products = $this->product_price_calculation($data);
  }

  //calculation
    public function product_price_calculation_data_with_header($data) {
      for($i=0;$i<count($data);$i++)
      {
        for($j=0;$j<count($data[$i]->product);$j++)
        {
          //if from distributor
          if(isset($data[$i]->product[$j]->productDistributor[0]))
          {
            $data[$i]->product[$j]->base_price = $data[$i]->product[$j]->productDistributor[0]->distributor_product_price;
            for($k=0;$k<count($data[$i]->product[$j]->productDistributor);$k++)
            {
              if($data[$i]->product[$j]->base_price > $data[$i]->product[$j]->productDistributor[$k]->distributor_product_price)
              {
                $data[$i]->product[$j]->base_price = $data[$i]->product[$j]->productDistributor[$k]->distributor_product_price;
              }
            }
          }

          //if not rupiah //1=IDR ->rupiah flag from db
          if(strcmp($data[$i]->product[$j]->currency_code, 'IDR') !== 0)
          {
            $rateConversion = RateConversion::where('is_deleted', 0)->where('from_currency_code', $data[$i]->product[$j]->currency_code)->where('to_currency_code', 'IDR')->get();
            if(isset($rateConversion[0]))
            {
              $rateConversion = $rateConversion[0];
              $data[$i]->product[$j]->base_price = $data[$i]->product[$j]->base_price*$rateConversion->rate;
            }
          }
          if($data[$i]->product[$j]->base_price != 0)
          {
            if($data[$i]->product[$j]->formula_id != 0)
            {
              $formula = MarkUpFee::where('is_deleted', 0)->where('id', $data[$i]->product[$j]->formula_id)->get();
              if(isset($formula[0]))
              {
                $formula = $formula[0];
                $data[$i]->product[$j]->base_price = ($data[$i]->product[$j]->base_price + ($data[$i]->product[$j]->base_price*($formula->float_fee/100))) + $formula->fixed_fee;
              }       
            }
            if($data[$i]->product[$j]->is_sale == 1)
            {
              if($data[$i]->product[$j]->streak_price > $data[$i]->product[$j]->base_price)
              {
                $data[$i]->product[$j]->discount = '-'.ceil((($data[$i]->product[$j]->streak_price - $data[$i]->product[$j]->base_price)/$data[$i]->product[$j]->streak_price)*100) .'%';
                $data[$i]->product[$j]->streak_price = 'Rp. '.number_format($data[$i]->product[$j]->streak_price,0,",",".");
              }
              else
              {
                $data[$i]->product[$j]->streak_price = "";
              }
            }
            $data[$i]->product[$j]->base_price = 'Rp. '.number_format($this->_roundNearestThousandUp($data[$i]->product[$j]->base_price),0,",",".");
            if($data[$i]->product[$j]->is_call_for_best_price == 1)
            {
              $data[$i]->product[$j]->streak_price = 'Call For Best Price';
            }
          }
          else
          {
            $data[$i]->product[$j]->streak_price = 'call';
            $data[$i]->product[$j]->base_price = 'CALL';
          }
        }
      }
      return $data;
    }

}
