<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Testimonials extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'testimonials';
	protected $primaryKey = "id";

	public static function saveToDB() 
	{
		$input = Input::all();
		$testimonial = new Testimonials();
		$testimonial->name = $input['name'];
		$testimonial->email = $input['email'];
		$testimonial->country = $input['country'];
		$testimonial->testimonial = $input['testimonial'];
		$testimonial->created_by = $input['email'];
		$testimonial->save();
	
		return true;
	}
}
