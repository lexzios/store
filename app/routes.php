<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'api'], function() {
    Route::group(['prefix' => 'blog'], function() {
        Route::get('recent', 'PostController@recent');
    });
});

Response::macro('csv', function($data, $filename = 'data.csv', $status = 200, $delimiter = ",", $linebreak = "\n", $headers = array())
{
    return Response::stream(function () use ($data, $delimiter, $linebreak) {
      foreach ($data as $row) {
          $keys = array(); $values = array();
          $i = (isset($i)) ? $i+1 : 0;
          foreach ($row['attributes'] as $k => $v) {
              if (!$i) $keys[] = is_string($k) ? '"' . str_replace('"', '""', $k) . '"' : $k;
              $values[] = is_string($v) ? '"' . str_replace('"', '""', $v) . '"' : $v;
          }
          if (count($keys) > 0) echo implode($delimiter, $keys) . $linebreak;
          if (count($values) > 0) echo implode($delimiter, $values) . $linebreak;
      }
    }, 200, array_merge(array(
        'Content-type' => 'application/csv',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Content-Description' => 'File Transfer',
        'Content-type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=' . $filename,
        'Expires' => '0',
        'Pragma' => 'public',
    ), $headers));
});

// Route::get('/json_latest_blog', 'BaseController@latest_blog');

//user web route
Route::get('/', 'BannerController@index');
Route::post('/newsletter', 'BannerController@postNewsletter');

Route::get('/about-us', 'AboutUsController@index');
Route::post('/about-us', 'AboutUsController@postMail');

Route::get('/cara-order', 'CaraOrderController@index');

Route::get('/testimonials', 'TestimonialController@index');
Route::post('/testimonials', 'TestimonialController@postTestimonial');

Route::get('/product/{category_id}', 'ProductsController@index');
Route::get('/product/search/list/', 'ProductsController@search');
Route::get('/product/detail/{id}', 'ProductsController@show');

Route::get('/download-price-list/images/price_list/{filename}', function($filename) {
  // Check if file exists in app/storage/file folder
    $file_path = public_path() .'/images/price_list/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
});


Route::group(array('prefix' => 'admin'), function() {

  Route::get('/login', 'admin\SessionsController@fresh');
  Route::post('/sessions', 'admin\SessionsController@create');
  Route::delete('/sessions', 'admin\SessionsController@destroy');

  Route::get('/', 'admin\DashboardController@index');

  Route::get('/users', 'admin\UsersController@index');
  Route::get('/users/new', 'admin\UsersController@fresh');
  Route::get('/users/{id}', 'admin\UsersController@show');
  Route::get('/users/{id}/edit', 'admin\UsersController@edit');
  Route::post('/users', 'admin\UsersController@create');
  Route::patch('/users/{id}', 'admin\UsersController@update');
  Route::put('/users/{id}', 'admin\UsersController@update');
  Route::delete('/users/{id}', 'admin\UsersController@destroy');

  Route::get('/products', 'admin\ProductsController@index');
  Route::get('/products/new', 'admin\ProductsController@fresh');
  Route::get('/products/search', 'admin\ProductsController@search');
  Route::get('/products/{id}', 'admin\ProductsController@show');
  Route::get('/products/{id}/edit', 'admin\ProductsController@edit');
  Route::post('/products', 'admin\ProductsController@create');
  Route::patch('/products/{id}', 'admin\ProductsController@update');
  Route::put('/products/{id}', 'admin\ProductsController@update');
  Route::delete('/products/{id}', 'admin\ProductsController@destroy');
  Route::get('/products/csv/upload', 'admin\ProductsController@showCSV');
  Route::post('/products/csv/upload', 'admin\ProductsController@createCSV');

  Route::get('/products/csv/exportCSV/{category}', function($category) {
    if($category == 0)
    {
      $data = Product::where('is_deleted',0)->get(array('id', 'product_category_id', 'currency_code', 'formula_id', 'permalink', 'name', 'short_description', 'long_description', 'base_price', 'is_sale', 'streak_price', 'is_call_for_best_price'));
    }
    else
    {
      $data = Product::where('product_category_id',$category)->where('is_deleted',0)->get(array('id', 'product_category_id', 'currency_code', 'formula_id', 'permalink', 'name', 'short_description', 'long_description', 'base_price', 'is_sale', 'streak_price', 'is_call_for_best_price'));
    }
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "product_category_id" => "", "currency_code" => "", "formula_id" => "", "permalink" => "", "name" => "", "short_description" => "", "long_description" => "", "base_price" => "", "is_sale" => "", "streak_price" => "", "is_call_for_best_price" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });
  Route::get('/products/csv/exportCSV/{category}/{name}', function($category, $name) {

    if($category == 0)
    {
      $data = Product::where('name', 'LIKE', '%'.$name.'%')->where('is_deleted',0)->get(array('id', 'product_category_id', 'currency_code', 'formula_id', 'permalink', 'name', 'short_description', 'long_description', 'base_price', 'is_sale', 'streak_price', 'is_call_for_best_price'));
    }
    else
    {
      $data = Product::where('product_category_id',$category)->where('name', 'LIKE', '%'.$name.'%')->where('is_deleted',0)->get(array('id', 'product_category_id', 'currency_code', 'formula_id', 'permalink', 'name', 'short_description', 'long_description', 'base_price', 'is_sale', 'streak_price', 'is_call_for_best_price'));
    }
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "product_category_id" => "", "currency_code" => "", "formula_id" => "", "permalink" => "", "name" => "", "short_description" => "", "long_description" => "", "base_price" => "", "is_sale" => "", "streak_price" => "", "is_call_for_best_price" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });


  Route::get('/distributor', 'admin\DistributorController@index');
  Route::get('/distributor/new', 'admin\DistributorController@fresh');
  // Route::get('/distributor/{id}', 'admin\DistributorController@show');
  Route::get('/distributor/{id}/edit', 'admin\DistributorController@edit');
  Route::post('/distributor', 'admin\DistributorController@create');
  Route::patch('/distributor/{id}', 'admin\DistributorController@update');
  Route::put('/distributor/{id}', 'admin\DistributorController@update');
  Route::delete('/distributor/{id}', 'admin\DistributorController@destroy');
  Route::post('/distributor/search', 'admin\DistributorController@search');
  Route::get('/distributor/csv/upload', 'admin\DistributorController@showCSV');
  Route::post('/distributor/csv/upload', 'admin\DistributorController@createCSV');

  Route::get('/distributor/csv/exportCSV', function() {
    $data = Distributor::where('is_deleted',0)->get(array('id', 'name', 'address'));
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "name" => "", "address" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });
  Route::get('/distributor/csv/exportCSV/{name}', function($name) {
    $data = Distributor::where('name', 'LIKE', '%'.$name.'%')->where('is_deleted',0)->get(array('id', 'name', 'address'));
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "name" => "", "address" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });


  Route::get('/distributor/{room_id}/product', 'admin\DistributorProductController@index');
  Route::get('/distributor/{room_id}/product/new', 'admin\DistributorProductController@fresh');
  Route::get('/distributor/{room_id}/product/{id}', 'admin\DistributorProductController@show');
  Route::get('/distributor/{room_id}/product/{id}/edit', 'admin\DistributorProductController@edit');
  Route::post('/distributor/{room_id}/product', 'admin\DistributorProductController@create');
  Route::patch('/distributor/{room_id}/product/{id}', 'admin\DistributorProductController@update');
  Route::put('/distributor/{room_id}/product/{id}', 'admin\DistributorProductController@update');
  Route::delete('/distributor/{room_id}/product/{id}', 'admin\DistributorProductController@destroy');
  Route::get('/distributor/{room_id}/product/csv/upload', 'admin\DistributorProductController@showCSV');
  Route::post('/distributor/{room_id}/product/csv/upload', 'admin\DistributorProductController@createCSV');
  Route::post('/distributor/{room_id}/product/search', 'admin\DistributorProductController@search');

  Route::get('/distributor/{room_id}/product/csv/exportCSV', function() {
    $data = DistributorProduct::where('is_deleted',0)->get(array('id', 'distributor_id', 'name', 'product_id', 'currency_code', 'distributor_product_price'));
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "distributor_id" => "", "name" => "", "product_id" => "", "currency_code" => "", "distributor_product_price" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });
  Route::get('/distributor/{room_id}/product/csv/exportCSV/{name}', function($room_id, $name) {
    $data = DistributorProduct::where('name', 'LIKE', '%'.$name.'%')->where('is_deleted',0)->get(array('id', 'distributor_id', 'name', 'product_id', 'currency_code', 'distributor_product_price'));
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "distributor_id" => "", "name" => "", "product_id" => "", "currency_code" => "", "distributor_product_price" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });

  Route::get('/rateconversion', 'admin\RateConversionController@index');
  Route::get('/rateconversion/new', 'admin\RateConversionController@fresh');
  Route::get('/rateconversion/{id}', 'admin\RateConversionController@show');
  Route::post('/rateconversion', 'admin\RateConversionController@create');
  Route::get('/rateconversion/{id}/edit', 'admin\RateConversionController@edit');
  Route::patch('/rateconversion/{id}', 'admin\RateConversionController@update');
  Route::put('/rateconversion/{id}', 'admin\RateConversionController@update');
  Route::delete('/rateconversion/{id}', 'admin\RateConversionController@destroy');

  Route::get('/markupfee', 'admin\MarkUpFeeController@index');
  Route::get('/markupfee/new', 'admin\MarkUpFeeController@fresh');
  Route::get('/markupfee/{id}', 'admin\MarkUpFeeController@show');
  Route::post('/markupfee', 'admin\MarkUpFeeController@create');
  Route::get('/markupfee/{id}/edit', 'admin\MarkUpFeeController@edit');
  Route::patch('/markupfee/{id}', 'admin\MarkUpFeeController@update');
  Route::put('/markupfee/{id}', 'admin\MarkUpFeeController@update');
  Route::delete('/markupfee/{id}', 'admin\MarkUpFeeController@destroy');
  Route::post('/markupfee/search', 'admin\MarkUpFeeController@search');
  Route::get('/markupfee/csv/upload', 'admin\MarkUpFeeController@showCSV');
  Route::post('/markupfee/csv/upload', 'admin\MarkUpFeeController@createCSV');

  Route::get('/markupfee/csv/exportCSV', function() {
    $data = MarkUpFee::where('is_deleted',0)->get(array('id', 'name', 'float_fee', 'fixed_fee'));
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "name" => "", "float_fee" => "", "fixed_fee" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });
  Route::get('/markupfee/csv/exportCSV/{name}', function($name) {
    $data = MarkUpFee::where('name', 'LIKE', '%'.$name.'%')->where('is_deleted',0)->get(array('id', 'name', 'float_fee', 'fixed_fee'));
    if( count($data) == 0 )
    {
       $data['attributes'] = array("id" => "", "name" => "", "float_fee" => "", "fixed_fee" => "");
       $data = array($data);
    }
    return Response::csv($data);
  });


  Route::get('/banner', 'admin\BannerController@index');
  Route::get('/banner/new', 'admin\BannerController@fresh');
  Route::get('/banner/{id}', 'admin\BannerController@show');
  Route::get('/banner/{id}/edit', 'admin\BannerController@edit');
  Route::post('/banner', 'admin\BannerController@create');
  Route::patch('/banner/{id}', 'admin\BannerController@update');
  Route::put('/banner/{id}', 'admin\BannerController@update');
  Route::delete('/banner/{id}', 'admin\BannerController@destroy');


  Route::get('/product/{productId}/image/new', 'admin\ProductImageController@fresh');
  Route::get('/product/{productId}/image/{id}', 'admin\ProductImageController@show');
  Route::get('/product/{productId}/image/{id}/edit', 'admin\ProductImageController@edit');
  Route::post('/product/{productId}/image/new', 'admin\ProductImageController@create');
  Route::patch('/product/{productId}/image/{id}', 'admin\ProductImageController@update');
  Route::delete('/product/{productId}/image/{id}', 'admin\ProductImageController@destroy');

  Route::get('/testimonials', 'admin\TestimonialsController@index');
  Route::get('/testimonials/{id}', 'admin\TestimonialsController@show');
  Route::patch('/testimonials/{id}', 'admin\TestimonialsController@update');
  Route::delete('/testimonials/{id}', 'admin\TestimonialsController@destroy');

  Route::get('/category', 'admin\CategoryController@index');
  Route::get('/category/management-sorting-category/{id}', 'admin\CategoryController@getCategoryRoot');
  Route::get('/category/new-category', 'admin\CategoryController@fresh');
  Route::get('/category/{id}', 'admin\CategoryController@show');
  Route::get('/category/{id}/edit', 'admin\CategoryController@edit');
  Route::post('/category', 'admin\CategoryController@create');
  Route::patch('/category/{id}/edit', 'admin\CategoryController@update');

  Route::delete('/category/{id}', 'admin\CategoryController@destroy');
  Route::post('/category/management-sorting-category', 'admin\CategoryController@manageCategory');

});

// Route for OLD URL Redirect
// Route::get('product-category/komputer-rakitan-home-office', function() {
//     return Redirect::to('/product/komputer-rakitan', 301);
// });
// Route::get('product-category/rakitan-gaming-design', function() {
//     return Redirect::to('/product/komputer-rakitan', 301);
// });
// Route::get('product-category/gadget', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/gadget/apple', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/gadget/samsung', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/hdd-external', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('product-category/hdd-external/silicon-power', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('product-category/hdd-external/seagate', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('product-category/hdd-externall/western-digital', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('product-category/notebook', function() {
//     return Redirect::to('/product/sub-notebook', 301);
// });
// Route::get('product-category/accessories', function() {
//     return Redirect::to('/other-accessories', 301);
// });
// Route::get('product-category/rakitan-gaming-design/page/{id}', function() {
//     return Redirect::to('/komputer-rakitan', 301);
// });
// Route::get('product-category/gadget/page/{id}', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/gadget/samsung/page/{id}', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/hdd-external/a-data', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('product-category/hdd-external/page/{id}', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('product-category/notebook/page/{id}', function() {
//     return Redirect::to('/product/sub-notebook', 301);
// });
// Route::get('product-category/cctv/paket-cctv', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('product-category/scanner', function() {
//     return Redirect::to('/product/scanner', 301);
// });
// Route::get('product-category/networking', function() {
//     return Redirect::to('/product/networking', 301);
// });
// Route::get('product-category/projector', function() {
//     return Redirect::to('/product/projector', 301);
// });
// Route::get('product-category/casing', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('product-category/casing/casing-mini-atx', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('product-category/casing/casing-atx', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('product-category/casing/page/{id}', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('product-category/power-supply', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('product-category/nanopc', function() {
//     return Redirect::to('/product/mini-pc', 301);
// });


// Route::get('product-category/rakitan-gaming-design/page/1', function() {
//     return Redirect::to('/product/komputer-rakitan', 301);
// });
// Route::get('product-category/gadget/page/1', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/gadget/samsung/page/1', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('product-category/hdd-external/page/1', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });

// Route::get('product-category/{permalink}', function() {
//     return Redirect::to('/', 301);
// });

// Route::get('list-harga', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('list-harga/casing', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('list-harga/internal-hdd-2-5', function() {
//     return Redirect::to('/product/harddisk-2-5', 301);
// });
// Route::get('list-harga/internal-hdd', function() {
//     return Redirect::to('/product/harddisk-2-5', 301);
// });
// Route::get('list-harga/server-hdd', function() {
//     return Redirect::to('/product/server', 301);
// });
// Route::get('list-harga/paket-keyboard-mouse', function() {
//     return Redirect::to('/product/keyboard-mouse', 301);
// });
// Route::get('list-harga/mouse-std', function() {
//     return Redirect::to('/product/mouse', 301);
// });
// Route::get('list-harga/keyboard-std', function() {
//     return Redirect::to('/product/keyboard', 301);
// });
// Route::get('list-harga/memory-ddr2', function() {
//     return Redirect::to('/product/ddr-1-ddr-2', 301);
// });
// Route::get('list-harga/memory-ddr3', function() {
//     return Redirect::to('/product/ddr-3', 301);
// });
// Route::get('list-harga/monitor', function() {
//     return Redirect::to('/product/monitor', 301);
// });
// Route::get('list-harga/motherboard-intel-socket-1150', function() {
//     return Redirect::to('/product/mb-intel-socket-1150', 301);
// });
// Route::get('list-harga/motherboard-intel-socket-1155', function() {
//     return Redirect::to('/product/mb-intel-socket-1155', 301);
// });
// Route::get('list-harga/motherboard-intel-socket-2011', function() {
//     return Redirect::to('/product/mb-intel-socket-2011', 301);
// });
// Route::get('list-harga/mb-amd-am3', function() {
//     return Redirect::to('/product/mb-amd-socket-am3-am3-plus', 301);
// });
// Route::get('list-harga/motherboard-amd-socket-fm1', function() {
//     return Redirect::to('/product/mb-amd-socket-fm1', 301);
// });
// Route::get('list-harga/motherboard-amd-socket-fm2', function() {
//     return Redirect::to('/product/mb-amd-socket-fm2-fm2-plus', 301);
// });
// Route::get('list-harga/amd', function() {
//     return Redirect::to('/product/processor-amd', 301);
// });
// Route::get('list-harga/intel', function() {
//     return Redirect::to('/product/processor-intel', 301);
// });
// Route::get('list-harga/amd-ati-radeon', function() {
//     return Redirect::to('/product/vga-ati', 301);
// });
// Route::get('list-harga/intel-nvidia', function() {
//     return Redirect::to('/product/vga-nvdia', 301);
// });
// Route::get('list-harga/notebook-cooler', function() {
//     return Redirect::to('/product/notebook-cooler', 301);
// });
// Route::get('list-harga/power-bank', function() {
//     return Redirect::to('/product/powerbank', 301);
// });
// Route::get('list-harga/external-hdd-2-5', function() {
//     return Redirect::to('/product/harddisk-external-2-5', 301);
// });
// Route::get('list-harga/notebook', function() {
//     return Redirect::to('/product/sub-notebook', 301);
// });
// Route::get('list-harga/projector', function() {
//     return Redirect::to('/product/projector', 301);
// });
// Route::get('list-harga/printer-dot-matrix', function() {
//     return Redirect::to('/product/printer', 301);
// });
// Route::get('list-harga/printer-inkjet', function() {
//     return Redirect::to('/product/printer', 301);
// });
// Route::get('list-harga/printer-laser', function() {
//     return Redirect::to('/product/printer', 301);
// });
// Route::get('list-harga/scanner', function() {
//     return Redirect::to('/product/scanner', 301);
// });
// Route::get('list-harga/ups', function() {
//     return Redirect::to('/product/ups', 301);
// });
// Route::get('list-harga/stabilizer', function() {
//     return Redirect::to('/product/stabilizer', 301);
// });
// Route::get('list-harga/pc-build-up', function() {
//     return Redirect::to('/product/pc-build-up', 301);
// });
// Route::get('list-harga/casing/casing-atx', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('list-harga/casing/casing-mini-atx', function() {
//     return Redirect::to('/product/casing', 301);
// });
// Route::get('list-harga/HP', function() {
//     return Redirect::to('/product/gadget-tablet', 301);
// });
// Route::get('list-harga/nanopc', function() {
//     return Redirect::to('/product/mini-pc', 301);
// });
// Route::get('list-harga/{permalink}', function() {
//     return Redirect::to('/', 301);
// });

// Route::get('category/harddisk', function() {
//     return Redirect::to('/product/harddisk-2-5', 301);
// });
// Route::get('category/memory', function() {
//     return Redirect::to('/product/memory-card', 301);
// });
// Route::get('category/motherboard', function() {
//     return Redirect::to('/product/mb-intel-socket-775', 301);
// });
// Route::get('category/processor', function() {
//     return Redirect::to('/product/processor-intel', 301);
// });
// Route::get('category/vga-card', function() {
//     return Redirect::to('/product/vga-ati', 301);
// });
// Route::get('category/accessories', function() {
//     return Redirect::to('/product/other-accessories', 301);
// });
// Route::get('category/blog', function() {
//     return Redirect::to('/blog', 301);
// });
// Route::get('category/blog/feed', function() {
//     return Redirect::to('/blog/feed', 301);
// });
// Route::get('category/blog/page/{id}', function($id) {
//     return Redirect::to("/blog/page/$id", 301);
// });
// Route::get('category/{permalink}', function() {
//     return Redirect::to('/', 301);
// });

// Route::get('memori-campuran', function() {
//     return Redirect::to('/product/memory-card', 301);
// });

// Route::get('my-account', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('my-account/lost-password', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('cdn-cgi/l/', function() {
//     return Redirect::to('/', 301);
// });

// Route::get('product/{permalink}', function() {
//     return Redirect::to('/', 301);
// });

// Route::get('shop', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('shop/feed', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('shop/page/{id}', function() {
//     return Redirect::to('/', 301);
// });
// Route::get('shop/{permalink}', function() {
//     return Redirect::to('/', 301);
// });

// Route::get('tag/{permalink}', function($permalink) {
//     return Redirect::to("/blog/tag/$permalink", 301);
// });
// Route::get('tag/{permalink}/page/{id}', function($permalink, $id) {
//     return Redirect::to("/blog/tag/$permalink/page/$id", 301);
// });

// Route::get('2014', function() {
//     return Redirect::to('/blog/2014', 301);
// });
// Route::get('2014/{permalink}', function($permalink) {
//     return Redirect::to("/blog/2014/$permalink", 301);
// });
// Route::get('2013/{permalink}', function($permalink) {
//     return Redirect::to("/blog/2013/$permalink", 301);
// });
// Route::get('2012/{permalink}', function($permalink) {
//     return Redirect::to("/blog/2012/$permalink", 301);
// });

// Route::get('product-tag/{permalink}', function() {
//     return Redirect::to("/", 301);
// });
