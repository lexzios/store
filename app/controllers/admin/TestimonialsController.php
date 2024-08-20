<?php

namespace admin;
use View;
use LayoutHelper;
use Redirect;

use Testimonials;
use Auth;

class TestimonialsController extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->template['page-title'] = 'Central PC Admin - Testimonials';
    $this->template['main-bar-title'] = '<i class="fa fa-envelope"></i>&nbsp; Testimonials';
    LayoutHelper::addActiveMenu('admin.testimonials');
    $this->beforeFilter('@set_testimonial', array('only' => array('show', 'update', 'destroy')));
  }

  public function index()
  {
    $testimonials = Testimonials::where('is_deleted', 0)->get();
    return View::make('admin.testimonials.index')->with('testimonials', $testimonials);
  }

  public function update($id) 
  {
    if($this->_testimonial->is_approved == '0')
    {
      $this->_testimonial->is_approved = '1';
    }
    else
    {
      $this->_testimonial->is_approved = '0';
    }
    $this->_testimonial->updated_by = Auth::user()->email;
    $this->_testimonial->save();
    // $this->_product->delete();
    return Redirect::to('/admin/testimonials')->with('message', 'Testimonials was successfully deleted.');
  }

  # DELETE /admin/testimonials/1
  public function destroy($id) 
  {
    $this->_testimonial->deleted_by = Auth::user()->email;
    $this->_testimonial->is_deleted = '1';
    $this->_testimonial->save();
    // $this->_product->delete();
    return Redirect::to('/admin/testimonials')->with('message', 'Testimonials was successfully deleted.');
  }

  public function show($id) 
  {
    return View::make('admin.testimonials.show', array('testimonial' => $this->_testimonial));
  }


  private $_testimonial;
  public function set_testimonial($route, $request)
  {
    $this->_testimonial = Testimonials::find($route->getParameter('id'));
  }


}
