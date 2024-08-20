<?php

class TestimonialController extends BaseController {

  # GET /CaraOrder
  public function index()
  {
	 return View::make('userweb.testimonials')->withTitle("Testimonials");  	
  }

  public function postTestimonial() 
  {
  	$input = Input::all();
  	$testimonial_rules = array(
  		'name' => 'required',
  		'email' => 'required|email',
  		'country' => 'required',
  		'testimonial' => 'required'
  		);

  	$validate = Validator::make($input, $testimonial_rules);
  	if($validate->passes())
  	{
  		if(Testimonials::saveToDB())
  		{
  			return Redirect::to('/testimonials')->withErrors('0');
  		}
  	}
  	else
  	{
  		return Redirect::to('/testimonials')->withErrors($validate)->withInput();
  	}

  }

}
