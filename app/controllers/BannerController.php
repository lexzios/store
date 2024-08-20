<?php

class BannerController extends BaseController {
  public function __construct()
  {
    // Filter request first
    $this->beforeFilter('@set_products', array('only' => array('index')));
  }

  # GET /Banner
  public function index()
  {
  	$mainBanners = Banner::where('is_deleted', 0)->get();
  	$banners = Product::with(array('productImage' => function($query){$query->where('is_deleted', 0);}))->where('is_deleted', 0)->where('is_sale', 1)->get();
  	$categories = Category::where('is_deleted', 0)->orderBy('sorting_id', 'DESC')->get();
    $testimonials = Testimonials::where('is_deleted', '0')->where('is_approved', '1')->get();
  	return View::make('userweb.index', array('categories' => $categories, 'mainBanners' => $mainBanners, 'banners' => $banners, 'testimonials' => $testimonials, 'products' => $this->_products));
  }

  public function postNewsletter()
  {
    header("Access-Control-Allow-Origin: *");

  	$mail_rules = array('email' => 'required|email');
    $input = Input::all();
    $validate = Validator::make($input, $mail_rules);
    if($validate->passes())
    {
    	if($this->email())
	    {
	      return "success";
	    }
	    else
	    {
	      return "failed";
	    }
    }
    else
    {
    	return "inValid";
    }

  }

  public function email()
  {
    Mail::send('emails.auth.mail_newsletter_format', array('email' => $_POST['email']), function($message)
      {
        $message->from(Config::get('mail.MAIL_FROM'), $_POST['email']);
        $message->to(Config::get('mail.MAIL_TO'), Config::get('mail.MAIL_NAME'))->subject(Config::get('mail.MAIL_SUBJECT'));
      });
    return true;
  }

  private $_products;
  public function set_products($route, $request)
  {
    // $this->_products = Product::where('product_category_id', $id)->paginate(9);
    $data = Product::with(array('productImage' => function($query){$query->where('product_image.is_deleted', 0);}))
    ->with(array('productCurrency' => function($query){$query->where('currency.is_deleted', 0);}))
    ->with(array('productDistributor' => function($query){$query->where('distributor_product.is_deleted', 0);}))
    ->where('is_deleted', 0)
    ->where('is_in_editor_pick', 1)->get();

    // $data = Product::with('productImage')->with('productCurrency')->with('productDistributor')->where('product_category_id', $category_id)->where('is_deleted',0)->get();
    $this->_products = $this->product_price_calculation($data);
  }
}
