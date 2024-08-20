<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use ProductImage;
use Auth;

class ProductImageController extends BaseController {

  public function __construct()
  {
    parent::__construct();

    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_product_image', array('only' => array('show' ,'edit', 'update', 'destroy')));

    $this->template['page-title'] = 'Central PC Admin - Product Image';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Product Image';
  }

  # GET /admin/markUpFee
  public function index()
  {
  }

  # GET /admin/markUpFee/1
  public function show($productId) {
    return View::make('admin.product_image.show', array('image' => $this->_productImage, 'productId' => $productId));
  }

  # GET /admin/markUpFee/new
  public function fresh($productId) {
    $image = new ProductImage();
    return View::make('admin.product_image.new', array('image' => $image, 'productId' => $productId));
  }

  # GET /admin/markUpFee/1/edit
  public function edit($productId) {
    return View::make('admin.product_image.edit', array('image' => $this->_productImage, 'productId' => $productId));
  }

  # Post /admin/markUpFee
  public function create($productId) {
    $image = ProductImage::fresh( $this->_image_params(), $productId );

    // dd($image);
    if($image->validate() && $image->image_upload($this->_filename) && $image->save())
    {
      return Redirect::to('/admin/product/'.$productId.'/image/'.$image->id)->with('message', 'Product Image was successfully created.');
    }
    else
    { 
      return View::make('admin.product_image.new', array('image' => $image, 'productId' => $productId));
    }
  }

  # PATCH / PUT /admin/markUpFee/1
  public function update($productId) {
    $this->_productImage->modify( $this->_image_params() );
    // dd($this->_productImage);
    if( $this->_productImage->validate() && $this->_productImage->image_upload($this->_filename) && $this->_productImage->save() )
    {
      return Redirect::to('/admin/product/'.$productId.'/image/'.$this->_productImage->id)->with('message', 'Product Image was successfully created.');
    }
    else
    { 
      return View::make('admin.product_image.edit', array('image' => $this->_productImage, 'productId' => $productId));
    }
  }

  # DELETE /admin/markUpFee/1
  public function destroy($productId ,$id) {
    $this->_productImage->deleted_by = Auth::user()->email;
    $this->_productImage->is_deleted = '1';
    $this->_productImage->save();
    // $this->_productImage->delete();
    return Redirect::to('/admin/products/'.$productId)->with('message', 'Product Image was successfully deleted.');
  }

  /**
   * Filter the incoming requests.
   */

  private $_productImage;
  public function set_product_image($route, $request)
  {
    $this->_productImage = ProductImage::find($route->getParameter('id'));
  }

  //for image upload
  private $_destination_directory = 'images/product/';
  private $_filename;

  private function _image_params()
  {
    $image_params = array();
    // check if contain some file
    if(Input::hasFile('image')) 
    {
      //check if file valid
      if(Input::file('image')['image_path']->isValid()) 
      {
        $this->_filename = str_random(5).'.'.Input::file('image')['image_path']->getClientOriginalExtension();
        $image_params['image_path'] = "/".$this->_destination_directory.$this->_filename;
      }
    }
    else
    {
      $image_params['image_path'] = "";
    }

    // dd($image_params);
    return $image_params;
  }


}
