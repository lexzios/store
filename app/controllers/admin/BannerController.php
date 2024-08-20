<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use Banner;
use Auth;

class BannerController extends BaseController {

  public function __construct()
  {
    parent::__construct();
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
    // Filter request first
    $this->beforeFilter('@set_banner', array('only' => array('show' ,'edit', 'update', 'destroy')));

    $this->template['page-title'] = 'Central PC Admin - Banner Management';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Banner Management';
    LayoutHelper::addActiveMenu('admin.banner');
  }

  # GET /admin/rateconversions
  public function index()
  {
    $banners = Banner::where('is_deleted','0')->get();
    return View::make('admin.banner.index', array('banners' => $banners));
  }

  # GET /admin/rateconversions/1
  public function show($id) {
    return View::make('admin.banner.show', array('banner' => $this->_banner));
  }

  # GET /admin/rateconversion/new
  public function fresh() {
    $banner = new Banner();
    return View::make('admin.banner.new', array('banner' => $banner));
  }

  # GET /admin/ConversionRate/1/edit
  public function edit($id) {
    return View::make('admin.banner.edit', array('banner' => $this->_banner));
  }

  //for image upload
  private $_destination_directory = 'images/banner/';
  private $_filename;
  # Post /admin/rateconversion
  public function create() {
    $banner = Banner::fresh( $this->_banner_params() );
    if( $banner->validate() && $banner->upload_image($this->_filename) && $banner->save())
    {
      return Redirect::to('/admin/banner/'.$banner->id)->with('message', 'Banner was successfully created.');
    }
    else
    {
      return View::make('admin.banner.new', array('banner' => $banner));
    }
  }

  # PATCH / PUT /admin/ConversionRate/1
  public function update($id) {
    $this->_banner->modify( $this->_banner_params() );
    if( $this->_banner->validate() )
    {
      if(Input::hasFile('banner'))
      {
        if($this->_banner->upload_image($this->_filename) && $this->_banner->save())
        {
          return Redirect::to('/admin/banner/'.$this->_banner->id)->with('message', 'Banner was successfully updated.');
        }
        else
        {
          return View::make('admin.banner.edit', array('banner' => $this->_banner));
        }
      }
      else
      {
        if($this->_banner->save())
        {
          return Redirect::to('/admin/banner/'.$this->_banner->id)->with('message', 'Banner was successfully updated.');
        }
        else
        {
          return View::make('admin.banner.edit', array('banner' => $this->_banner));
        }
      }

    }
    else
    {
      return View::make('admin.banner.edit', array('banner' => $this->_banner));
    }
  }

  # DELETE /admin/ConversionRate/1
  public function destroy($id)
  {
    $this->_banner->deleted_by = Auth::user()->email;
    $this->_banner->is_deleted = '1';
    $this->_banner->save();
    //$this->_banner->delete();
    return Redirect::to('/admin/banner')->with('message', 'Banner was successfully deleted.');
  }

  /**
   * Filter the incoming requests.
   */

  private $_banner;
  public function set_banner($route, $request)
  {
    $this->_banner = Banner::find($route->getParameter('id'));
  }

  # Get banner params
  private $_allowed_banner_params = array('name', 'action_url', 'image_path');

  private function _banner_params()
  {
    $input_banner_params = Input::get('banner');
    $banner_params = array();
    foreach($input_banner_params as $key => $banner_param)
    {
      if( in_array($key, $this->_allowed_banner_params) )
      {
        $banner_params[$key] = $banner_param;
      }
    }
      // check if contain some file
      if(Input::hasFile('banner')) 
      {
        //check if file valid
        if(Input::file('banner')['image_path']->isValid()) 
        {
          $this->_filename = Input::get('banner')['name'].str_random(3).'.'.Input::file('banner')['image_path']->getClientOriginalExtension();
          $banner_params['image_path'] = "/".$this->_destination_directory.$this->_filename;
        }
      }
    return $banner_params;
  }


}
